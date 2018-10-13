@extends('layouts.manage')

@section('content')
  <section class="hero is-medium is-primary is-bold">
    <div class="hero-body">
      <div class="container has-text-centered">
        <h1 class="title">
          Discover what's new in your Community !
        </h1>
        <h2 class="subtitle">
          Share your thoughts.
        </h2>
      </div>
    </div>
</section> {{-- end of section--}}

  <div class="columns m-t-10">
    <div class="column is-two-thirds">
      @foreach ($posts as $post)
      <article class="media">
        <figure class="media-left">
          <p class="image is-64x64">
            <img src="https://bulma.io/images/placeholders/128x128.png">
          </p>
        </figure>
        <div class="media-content">
          <div class="content">
            <p>
              <strong>{{$post->user->name}}</strong> <small>@johnsmith</small> <small>31m</small>
              <br>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ornare magna eros, eu pellentesque tortor vestibulum ut. Maecenas non massa sem. Etiam finibus odio quis feugiat facilisis.
            </p>
          </div>
          <nav class="level is-mobile">
            <div class="level-left">
              <a class="level-item">
                <span class="icon is-small"><i class="fa fa-reply"></i></span>
              </a>
              <a class="level-item">
                <span class="icon is-small"><i class="fa fa-retweet"></i></span>
              </a>
              <a class="level-item">
                <span class="icon is-small"><i class="fa fa-heart"></i></span>
              </a>
            </div>
          </nav>
        </div>
        <div class="media-right">
          <button class="delete"></button>
        </div>
      </article>
    @endforeach
    </div>

    <div class="column">
      <label for="slug" class="label">Slug:</label>
      <div class="field">
        @foreach ($posts as $post)
          {{$post->title}}
        @endforeach
      </div>
    </div>
  </div>

@endsection
