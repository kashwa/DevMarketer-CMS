<?php

namespace App\Http\ViewComposers;

use App\Post;
use Illuminate\View\View;

class PostComposer
{
  /**
     * The Post repository implementation.
     *
     * @var PostRepository
     */
    protected $posts;

    /**
     * Create a new post composer.
     *
     * @param  PostRepository  $posts
     * @return void
     */
    public function __construct()
    {
        // Dependencies automatically resolved by service container...
        $posts = Post::all();
        $this->posts = $posts;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('posts', $this->posts);
    }
}
