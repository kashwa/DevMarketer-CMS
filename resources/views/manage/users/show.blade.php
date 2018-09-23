@extends('layouts.manage')

@section('content')
    <div class="flex-container">
        <div class="columns m-t-10">
            <div class="column">
                <h1 class="title">View user details</h1>
            </div>
            <div class="column">
                <a href="{{route('users.edit', $users->id)}}" class="button is-primary is-pulled-right"> <i class="fa fa-user m-r-10"></i> Edit user</a>
            </div>
        </div>
        <hr class="m-t-0">
    </div>

    <div class="columns">
            <div class="column">
                <div class="field">
                    <label for="name" class="label">Name</label>
                    <pre>{{$users->name}}</pre>
                </div>

                <div class="field">
                    <label for="email" class="label">Email:</label>
                    <pre>{{$users->email}}</pre>
                </div>

                <div class="field">
                    <label for="email" class="label">Roles:</label>
                    <ul>
                        {{$users->roles->count() == 0 ? 'This user has no roles yet!' : ''}}
                        <pre>
                            @foreach ($users->roles as $role)
                                <li><strong>{{$role->display_name}}</strong> (<small>{{$role->description}}</small>)</li>
                            @endforeach
                        </pre>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
