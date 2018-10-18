<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Http\Resources\PostResource;

class PostController extends Controller
{

    /* Use the Trait */
    use ApiResponse;

    public function __construct(Request $request)
    {
        $this->middleware('role:superadministrator|administrator|editor|author|contributor');

        $this->request = $request;
    }

    /**
     * Display a listing of the resource api.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = PostResource::collection(Post::all());
        return $this->apiResponse($posts);
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

        $post = new Post();
        $post->title = $request['post_title'];
        $post->slug = $request['slug'];
        $post->content = $request['post_body'];
        $post->author_id = $request->User()->id;
        $pure_data = strip_tags($request['post_body']);
        $post->excerpt = substr($pure_data, 0, 20);

        $post->save();

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
        $post = new PostResource(Post::find($id));
        if($post){
            return $this->apiResponse($post);
        } else {
            $msg = "Your item might be deleted or not found!";
            return $this->apiResponse(null, $msg, 404);
        }
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
      $post = Post::where('id', $id);
      $post->delete();
      return view('manage.dashboard');
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
