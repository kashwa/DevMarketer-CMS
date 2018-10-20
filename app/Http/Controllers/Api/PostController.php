<?php

namespace App\Http\Controllers\Api;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Support\Facades\Validator;

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
        $validate = Validator::make($request->all(), [
            'title'     => 'required|max:255',
            'slug'      => 'required|max:100|alpha_dash',
            'content'   => 'required|min:70'
        ]);

        if($validate->fails()){
            return $this->apiResponse(null, $validate->errors(), 422);
        }

        $title = $request->title;
        $slug = $request->slug;
        $content = $request->content;
        $author_id = $request->User()->id;
        $pure_data = strip_tags($request->content);
        $excerpt = substr($pure_data, 0, 20);
        
        $post = Post::create([
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'author_id'=> $author_id,
            'excerpt' => $excerpt
        ]);
        
        if($post){
            return $this->apiResponse(new PostResource($post), null, 201);
        } else {
            $msg = "Unknown Error!";
            return $this->apiResponse(null, $msg, 520);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post =Post::find($id);
        if($post){
            return $this->apiResponse(new PostResource($post));
        } else {
            return $this->notFoundResponse();
        }
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
      // alpha_dash doesn't allow spaces.
        $validate = Validator::make($request->all(), [
            'title'     => 'required|max:255',
            'slug'      => 'required|max:100|alpha_dash',
            'content'   => 'required|min:70'
        ]);

        if($validate->fails()){
            return $this->apiResponse(null, $validate->errors(), 422);
        }

        $post = Post::find($id);

        if(!$post){
            return $this->notFoundResponse();
        }

        $title = $request->title;
        $slug = $request->slug;
        $content = $request->content;
        $author_id = $request->User()->id;
        $pure_data = strip_tags($request->content);
        $excerpt = substr($pure_data, 0, 20);
        
        $post->update([
            'title' => $title,
            'slug' => $slug,
            'content' => $content,
            'author_id'=> $author_id,
            'excerpt' => $excerpt
        ]);
        
        if($post){
            return $this->apiResponse(new PostResource($post), null, 201);
        } else {
            $msg = "Unknown Error!";
            return $this->apiResponse(null, $msg, 520);
        }
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
}
