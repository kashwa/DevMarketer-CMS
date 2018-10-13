<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Laravel'll execute PostComposer@compost each time 'dashboard' rendered.
        // {PostComposer@compost} is the default method to call.
        View::composer(
          'manage.dashboard', 'App\Http\ViewComposers\PostComposer'
        );
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
