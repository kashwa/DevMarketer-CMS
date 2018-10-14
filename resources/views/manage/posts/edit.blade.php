@extends('layouts.manage')

@section('tinymce')
  {{-- Load WYSIWYG <Tiny mce> --}}
  <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>

  <script>
    tinymce.init({
      selector: 'textarea',
      plugins: 'link code',
      menubar: false
    });
  </script>
@endsection

@section('content')
  <div class="flex-container">
      <div class="columns m-t-10">
          <div class="column">
              <h1 class="title">Edit Your Post</h1>
          </div>
          <div class="column"></div>
      </div>
      <hr class="m-t-0">

      @foreach ($posts as $post)
        <form action="{{route('posts.update', $post->id)}}" method="post">
          {{method_field('PUT')}}
          {{ csrf_field() }}
          <div class="columns">
              <div class="column is-three-quarters-desktop">
                  <b-field>
                      <b-input type="text" name="post_title" placeholder="Post Title" size="is-large" v-model="title">
                      </b-input>
                  </b-field>
                  <b-field class="m-t-40">
                      <b-input type="textarea" name="post_body" value="{{$post->content}}" placeholder="Compose your masterpiece..." rows="17">
                      </b-input>
                  </b-field>
              </div>
              <!-- end of .column.is-three-quarters -->
              <div class="column is-one-quarter-desktop is-narrow-tablet">
                  <div class="card card-widget">
                      <div class="author-widget widget-area">
                          <div class="selected-author">
                              <img src="https://placehold.it/50x50" />
                              <div class="author">
                                  <h4>{{Auth::user()->name}}</h4>
                                  <p class="subtitle">
                                      (<small>{{Auth::user()->email}}</small>)
                                  </p>
                              </div>
                          </div>
                      </div>
                      <div class="post-status-widget widget-area">
                          <div class="status">
                              <div class="status-icon">
                                  <i class="fa fa-book fa-3x"></i>
                              </div>
                              <div class="status-details">
                                  <h4><span class="status-emphasis">Draft</span> Saved</h4>
                                  <p>A Few Minutes Ago</p>
                              </div>
                          </div>
                      </div>
                      <div class="publish-buttons-widget widget-area">
                          <div class="secondary-action-button">
                              <button class="button is-info is-outlined is-fullwidth" disabled="true" title="Comming Soon! in future plan">Save Draft</button>
                          </div>
                          <div class="primary-action-button">
                              <button class="button is-primary is-fullwidth">Save</button>
                          </div>
                      </div>
                  </div>
              </div> <!-- end of .column.is-one-quarter -->
          </div>
      </form>
      @endforeach
  </div> <!-- end of .flex-container -->
@endsection

@section('scripts')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                title: '{{$post->title}}',
                api_token: '{{Auth::user()->api_token}}'
            },
            methods: {
                updateSlug: function (val) {
                    this.slug = val;
                },
                slugCopied: function(type, msg, val){
                    notifications.toast(msg, {type : `is-${type}`});
                }
            }
        });
    </script>
@endsection
