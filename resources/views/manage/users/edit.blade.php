@extends('layouts.manage')

@section('content')
    <div class="flex-container">
        <div class="columns m-t-10">
            <div class="column">
                <h1 class="title">Edit User</h1>
            </div>
        </div>
        <hr class="m-t-0">

        <div class="columns">
            <div class="column">
                <form action="{{route('users.update', $users->id)}}" method="POST">
                    {{method_field('PUT')}}
                    {{csrf_field()}}

                    <div class="field">
                        <label for="name" class="label">Name</label>
                        <p class="controle">
                            <input type="text" class="input" name="name" id="name" value="{{$users->name}}">
                        </p>
                    </div>

                    <div class="field">
                        <label for="email" class="label">Email:</label>
                        <p class="control">
                            <input type="text" class="input" name="email" id="email" value="{{$users->email}}">
                        </p>
                    </div>

                    <div class="field">
                        <label for="password" class="label">Password</label>
                            <div class="field">
                                <b-radio v-model="password_options" name="passwordoptions" native-value="keep"> Do Not change password</b-radio>
                            </div>
                            <div class="field">
                                <b-radio v-model="password_options" name="passwordoptions" native-value="auto"> Auto-Generate new password</b-radio>
                            </div>
                            <div class="field">
                                <b-radio v-model="password_options" name="passwordoptions" native-value='manual'> Manually set new password</b-radio>
                                <p class="control">
                                    <input type="text" class="input m-t-10" name="password" id="password" v-if="password_options =='manual'" placeholder="Manually give a password to this user">
                                </p>
                            </div>
                    </div>

                    <button class="button is-primary">Edit user</button>
                </form>
            </div>
        </div>

    </div> {{-- end of .flex-container --}}
@endsection

@section('scripts')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                password_options: 'keep',
            }
        });
    </script>
@endsection