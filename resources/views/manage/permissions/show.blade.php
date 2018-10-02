@extends('layouts.manage')

@section('content')
    <div class="flex-container">
    <div class="columns m-t-10">
      <div class="column">
        <h1 class="title">View Permission Details</h1>
      </div> <!-- end of column -->
       <div class="column">
        <a href="{{route('permissions.edit', $permission->id)}}" class="button is-primary is-pulled-right"><i class="fa fa-edit m-r-10"></i> Edit Permission</a>
      </div>
    </div>
    <hr class="m-t-0">
     <div class="columns">
      <div class="column">
        <div class="box">
          <article class="media">
            <div class="media-content">
              <div class="content">
                <p>
                  <label for="display_name">Display Name : </label><strong>{{$permission->display_name}}</strong><br><br>
                  <label for="name">Name : </label><strong>{{$permission->name}}</strong><br><br>
                  <label for="description">Description : </label><strong>{{$permission->description}}</strong>
                </p>
              </div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </div>
@endsection