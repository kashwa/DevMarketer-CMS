<?php

 namespace App\Http\Repository;

 use App\Post;

/**
 * Doing the Task using Repository.
 * [PostRepository description].
 */
class PostRepository
{
    protected $posts;

    public function getPosts(){
      $posts = Post::with('user')->get();

      return $posts;
    }
}
