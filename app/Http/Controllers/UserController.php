<?php

namespace App\Http\Controllers;

use DB;

use Hash;
use Session;
use App\Role;
use App\User;
use LaraFlash;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(7);
        return view('manage.users.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('manage.users.create')->withRoles($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|max:255',
            'email' => 'required|email|unique:users'
        ]);

        if($this->request->has('password') && !empty($request->password)){
            // entered manually
            $password = trim($request->password);

        } else {
            # SET AUTO_GENERATE
            $length = 10;
            $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
            $str = '';
            $max = mb_strlen($keyspace, '8bit') - 1;

            for ($i=0; $i < $length; ++$i) {
                $str .= $keyspace[random_int(0, $max)];
            }

            $password = $str;
        }

        // Save the user.
        $user = new User();
        $user->name     = $request['name'];
        $user->email    = $request['email'];
        $user->password = Hash::make($password);

        $user->save();
        // LaraFlash::success('Successfully, User created');

        if ($request->roles)
            $user->syncRoles(explode(',', $request->roles));


        return redirect()->route('users.show', $user->id);

        // if (!$user->save()) {
        //   LaraFlash::danger('Sorry, a problem happened while saving that user.');
        //   return redirect()->route('users.create');
        // }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->with('roles')->first();
        return view('manage.users.show')->withUsers($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::where('id', $id)->with('roles')->first();
        return view('manage.users.edit')->withUsers($user)->withRoles($roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|max:255',
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $user = User::findOrFail($id);
        $user->name = $request['name'];
        $user->email = $request['email'];

        if ($request->password_options == 'auto'){
            # auto generate password
            $length = 10;
            $keyspace = '123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ';
            $str = '';
            $max = mb_strlen($keyspace, '8bit') - 1;

            for ($i=0; $i < $length; ++$i) {
                $str .= $keyspace[random_int(0, $max)];
            }
            $user->password = Hash::make($str);

        } elseif($request->password_options == 'manual'){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $user->syncRoles(explode(',', $request->roles));

        // LaraFlash::success("Successfully User updated.")
        $notif = LaraFlash::success("Successfully User updated.");
        return redirect()->route('users.show', $id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
