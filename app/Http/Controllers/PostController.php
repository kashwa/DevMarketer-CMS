<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use LaraFlash;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Repository\PostRepository;

class PostController extends Controller
{

    public function __construct(Request $request)
    {
        $this->middleware('role:superadministrator|administrator|editor|author|contributor');
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PostRepository $post_repo)
    {
        $posts = $post_repo->getPosts();
        return view('manage.posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        LaraFlash::info("Write what is on your mind!");
        return view('manage.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // alpha_dash doesn't allow spaces.
        $request->validate([
          'post_title'  => 'required|max:255',
          'slug'        => 'required|max:100|alpha_dash',
          'post_body'   => 'required|min:70'
        ]);

        $timeNow = new Carbon();

        $post = new Post();
        $post->title = $request['post_title'];
        $post->slug = $request['slug'];
        $post->content = $request['post_body'];
        $post->author_id = $request->User()->id;
        $pure_data = strip_tags($request['post_body']);
        $post->excerpt = substr($pure_data, 0, 20);

        $post->save();

        LaraFlash::success('Post Created, Successfully!');
        return view('manage.posts.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::where('id', $id)->get();
        return view('manage.posts.show')->withPosts($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where('id', $id)->get();
        return view('manage.posts.edit')->withPosts($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $request->validate([
        'post_title'  => 'required|max:255',
        'post_body'   => 'required|min:70'
      ]);

      $postEd = Post::findOrFail($id);
      $postEd->title   = $request['post_title'];
      $postEd->content = $request['post_body'];
      $postEd->save();

      LaraFlash::success('Post Updated Successfully');
      $post = Post::where('id', $id)->get();
      return view('manage.posts.show')->withPosts($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::findOrFail($id);
      $post->delete();
      return redirect()->route('manage.dashboard');
    }

    /**
     * Generate api - Checks the uniqueness of
     * the newly created slug.
     *
     * @return void
     */
    public function apiCheckUnique(Request $request) {
        return json_encode(!Post::where('slug', '=', $request->slug)->exists());
    }
}
