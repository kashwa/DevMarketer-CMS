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
                    <span class="icon is-small" @click="commentspls" :text="comments">(@{{comments}})<i class="fa fa-comment m-l-5"></i></span>
                    <input type="hidden" v-model="comments" name="comment_count">
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

@section('scripts')
<script>
  var app = new Vue({
    el : '#app',
    data: {
      comments: {{$post['comment_count']}},
      url: '/api/posts/{{$post->id}}?api_token={{Auth::user()->api_token}}',
      id: {{$post['id']}},
      author_id: {{$post->user->id}},
      api_token: '{{Auth::user()->api_token}}',
      csrfToken: '{{ csrf_field() }}'
    },
    methods: {
      commentspls : function () {
        this.comments = (this.$root.comments) += 1;
        // Run ajax to increase it
        if(this.comments != 0){
         this.updateCounter();
        }
        return this.comments;
      },
      updateCounter: function () {
        let vm = this;
        axios({
          method: 'PUT',
          url: vm.url,
          headers: {
            api_token: vm.api_token
          },
          data: {
            comment_count: vm.comments,
            author_id: vm.author_id,
            id: vm.id,
          }
        }).then(function(response) {
          console.log(vm.comments)
        }).catch(function(error){
          console.log(error);
        });
      }
    }
  });

</script>
@endsection
