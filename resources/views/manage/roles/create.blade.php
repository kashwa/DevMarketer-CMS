@extends('layouts.manage')

@section('content')
    <div class="flex-container">
    <div class="columns m-t-10">
      <div class="column">
        <h1 class="title">Create new role</h1>
      </div>
      
    </div>

    <hr class="m-t-0">
    <form action="{{route('roles.store')}}" method="POST">
        {{ csrf_field() }}
        <div class="columns">
        <div class="column">
            <div class="box">
            <article class="media">
                <div class="media-content">
                <div class="content">
                    <h2 class="title">Role Details</h2>
                    <div class="field">
                        <p class="control">
                            <label for="display_name" class="label">Name (Human Readable)</label>
                            <input type="text" class="input" name="display_name" value="{{old('display_name')}}" id="display_name">
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <label for="name" class="label">Slug (Can not be edited)</label>
                            <input type="text" class="input" name="name" value="{{old('name')}}" id="name">
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <label for="description" class="label">Description</label>
                            <input type="text" class="input" name="description" value="{{old('description')}}" id="description">
                        </p>
                    </div>
                    <input type="hidden" :value="permissionsSelected" name="permissions">
                </div>
                </div>
            </article>
            </div>
        </div>
        </div>
        
        <div class="columns">
        <div class="column">
            <div class="box">
                <article class="media">
                    <div class="media-content">
                    <div class="content">
                        <h2 class="title">Permissions allowed : </h2>
                        <ul>
                        @foreach ($permissions as $permission)
                            {{-- <li>{{$r->display_name}} <em class="m-l-15">({{$r->description}})</em></li> --}}
                            <div class="field">
                                <b-checkbox v-model="permissionsSelected" native-value="{{$permission->id}}">{{$permission->display_name}} <em>{{$permission->description}}</em></b-checkbox>
                            </div>
                        @endforeach
                        </ul>
                    </div>
                    </div>
                </article>
            </div>
            <button class="button is-primary">Create new ROLE</button>
        </div>
        </div>
    </div>    
  </form>
@endsection

@section('scripts')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                permissionsSelected: [],
            }
        });
    </script>
@endsection