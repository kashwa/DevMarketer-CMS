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
                  <strong>{{$post->title}}</strong> <br><br>
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
                      {{-- Edit --}}
                      <a href="{{ route('posts.edit', $post->id) }}" class="button is-outlined is-info m-r-10">Edit</a>

                      {{-- Delete --}}
                      <form id="DeleteBtn" action="{{ route('posts.destroy', ['id' => $post->id]) }}" method="POST">
                        <input type="submit" value="delete" style="background-color: #f2134b; color: white" 
                          class="button is-outlined" onclick="return confirm('Are you sure, You want to delete Post?')">
                            {{ method_field('DELETE') }}
                            {!! csrf_field() !!}
                      </form>

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
                <li>
                  <a href="#">{{$post->slug}}</a>
                </li>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach
@endsection
