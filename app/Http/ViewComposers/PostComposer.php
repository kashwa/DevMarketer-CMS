<?php

namespace App\Http\ViewComposers;

use App\Post;
use Illuminate\View\View;
use App\Http\Repository\PostRepository;

class PostComposer
{
  /**
     * Publish data using Post Repository.
     * @var PostRepository
     */
    protected $posts;

    /**
     * Create a new post composer.
     *
     * @param  PostRepository  $posts
     * @return void
     */
    public function __construct(PostRepository $post_repo)
    {
        // Dependencies automatically resolved by service container...
        $this->posts = $post_repo->getPosts();
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
