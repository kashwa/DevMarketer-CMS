@extends('layouts.manage')

@section('content')
    <div class="flex-container">
        <div class="columns m-t-10">
            <div class="column">
                <h1 class="title">Create New User</h1>
            </div>
        </div>
        <hr class="m-t-0">

        <div class="columns">
            <div class="column">
                <form action="{{ route('users.store') }}" method="POST">
                    <div class="field">
                        <label for="name" class="label">Name</label>
                        <p class="controle">
                            <input type="text" class="input" name="name" id="name">
                        </p>
                    </div>

                    <div class="field">
                        <label for="email" class="label">Email:</label>
                        <p class="control">
                            <input type="text" class="input" name="email" id="email">
                        </p>
                    </div>

                    <div class="field">
                        <label for="password" class="label">Password</label>
                        <p class="control">
                            <input type="text" class="input" name="password" id="password" placeholder="Manually insert password" :disabled="auto_password" >
                            <b-checkbox class="m-t-10" name="auto_generate" v-model="auto_password">Auto Generate Password</b-checkbox>
                        </p>
                    </div>

                    <button class="button is-success">Create user</button>

                </form>
            </div>
        </div>

    </div> {{-- end of .flex-container --}}
@endsection

@section('scripts')
    <script>
        var app = new Vue({
            el : '#app',
            data: {
                auto_password: true,
            }   
        });
    </script>
@endsection
