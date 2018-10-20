<?php

namespace App\Http\Controllers\Api;

use DB;

use Hash;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Use ApiResponse trait to make a Response Standard
     */
    use ApiResponse;

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
        $users = UserResource::collection(User::all());
        return $this->apiResponse($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // alpha_dash doesn't allow spaces.
        $validate = Validator::make($request->all(), [
            'name'  => 'required|max:255',
            'password'  => 'required|min:7',
            'email' => 'required|email|unique:users'
        ]);

        if($validate->fails()){
            return $this->apiResponse(null, $validate->errors(), 422);
        }

        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);
        $api_token = bin2hex(openssl_random_pseudo_bytes(30));
        
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'api_token'=> $api_token
        ]);
        
        if($user){
            return $this->apiResponse(new UserResource($user), null, 201);
        } else {
            $msg = "Unknown Error!";
            return $this->apiResponse(null, $msg, 520);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user =User::find($id);
        if($user){
            return $this->apiResponse(new UserResource($user));
        } else {
            $msg = "Your item might be deleted or not found!";
            return $this->apiResponse(null, $msg, 404);
        }
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
        $validate = Validator::make($request->all(), [
            'name'  => 'required|max:255',
            'password'  => 'required|min:7',
            'email' => 'required|email'
        ]);

        if($validate->fails()){
            return $this->apiResponse(null, $validate->errors(), 422);
        }

        $user = User::find($id);

        if(!$user){
            return $this->notFoundResponse();
        }

        $name = $request->name;
        $email = $request->email;
        $password = Hash::make($request->password);
        
        $user->update([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
        
        if($user){
            return $this->apiResponse(new UserResource($user), null, 201);
        } else {
            $msg = "Unknown Error!";
            return $this->apiResponse(null, $msg, 520);
        }

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
