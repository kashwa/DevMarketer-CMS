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
        <div class="media-content m-b-20">
          <div class="content">
            <p>
              <strong>{{$post->user->name}}</strong> <small>({{$post->user->email}})</small>
              <a href="{{route('posts.show', $post->id)}}">
                <small><strong>{{$post->created_at}}</strong></small>
              </a>
              <br>
              {!! $post->content !!}
            </p>
          </div>
          <nav class="level is-mobile">
            <div class="level-left">
              <a class="level-item">
                <span class="icon is-small">({{$post->comment_count}})<i class="fa fa-comment m-l-5"></i></span>
              </a>
              <a class="level-item">
                <span class="icon is-small"><i class="fa fa-heart m-l-50"></i></span>
              </a>
            </div>
          </nav>
        </div>
      </article>
    @endforeach
    </div>

    <div class="column">
      <div class="container is-fluid">
        <div class="notification">
          <label for="slug" class="label">Slug:</label>
          <div class="field">
            @foreach ($posts as $post)
              <ul>
                <li>
                  <a href="#">{{$post->slug}}</a>
                </li>
              </ul>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection
