@extends('layouts.manage')

@section('content')
  @foreach ($posts as $post)
    <div class="flex-container m-t-20">
      <div class="columns">

        <div class="column is-two-thirds">
          <article class="media">
            <figure class="media-left">
              <p class="image is-64x64">
                <img src="https://bulma.io/images/placeholders/128x128.png">
              </p>
            </figure>
            <div class="media-content m-b-20">
              <div class="content">
                <p>
                  <strong>{{$post->user->name}}</strong> <small>({{$post->user->email}})</small> <small>{{$post->created_at}}</small> <hr>
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

                @if (Auth::user()->id == $post->author_id)
                  <div class="level-right">
                    <a href="{{route('posts.edit', $post->id)}}" class="button is-outlined is-info m-r-10">Edit</a>
                    <a href="#" class="button is-outlined is-danger">Delete</a>
                  </div>
                @endif

              </nav>
            </div>
          </article>
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
    </div>
  @endforeach
@endsection
