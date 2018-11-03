@extends('layouts.manage')

@section('content')
    <div class="flex-container">
        <div class="columns m-t-10">
            <div class="column">
                <h1 class="title">Posts index page</h1>
            </div>
            <div class="column">
                <a href="{{route('posts.create')}}" class="button is-primary is-pulled-right"><i class="fa fa-user-plus m-r-10"></i> Create New Post</a>
            </div>
        </div>
        <section class="hero is-success m-b-20">
          <div class="hero-body">
            <div class="container has-text-centered">
              <h1 class="title">
                DevMarketer - Posts Index
              </h1>
              <h2 class="subtitle">
                Here, you'll see All Posts of <strong>Yours</strong> ;)
              </h2>
            </div>
          </div>
        </section>
        {{-- how to access each user's post --}}
        @foreach ($posts as $post)

          @if (Auth::user()->id == $post->author_id)
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
                {{--Level, Level_left, Level_item, YOUR SPAN--}}
                <nav class="level is-mobile">
                  <div class="level-left">
                    <a class="level-item">
                      <textarea v-model="comments" @click="commentspls"></textarea>
                      <span class="icon is-small">({{$post->comment_count}})<i class="fa fa-comment m-l-5"></i></span>
                    </a>
                    <a class="level-item">
                      <span class="icon is-small"><i class="fa fa-heart m-l-50"></i></span>
                    </a>
                  </div>
                </nav>
              </div>
            </article>
          @endif

        @endforeach

    </div> {{-- End of .flex-container --}}

@endsection

@section('scripts')
<script>
  var app = new Vue({
    el : '#app',
    data: {
      comments: {{$post['comment_count']}}
    },
    methods: {
      commentspls : function () {
        return (this.comments) += 1;
      }
    }
  });
</script>
@endsection
