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
        <hr class="m-t-0">

        {{-- how to access each user's post --}}
        @foreach ($posts as $post)

          @if (Auth::user()->id == $post->author_id)
            {{'Title : '.$post->title}}<br><br><br>
            {{'content : '.$post->content}}<br><br><br>
            {{'Author ID: '.$post->author_id}}
          @endif

        @endforeach


    </div> {{-- End of .flex-container --}}
@endsection
