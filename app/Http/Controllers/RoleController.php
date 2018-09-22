<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use Session;

class RoleController extends Controller
{

    # The best practice for (validate request) to prevent error.
    public function __construct(Request $request){
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('manage.roles.index')->withRoles($roles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('manage.roles.create')->withPermissions($permissions);
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
            'display_name'  => 'required|max:255',
            'name'          => 'required|max:100|alpha_dash|unique:permissions,name|unique:roles,name',
            'description'   => 'sometimes|max:255'
        ]);

        $role = new Role();
        $role->display_name = $request['display_name'];
        $role->name = $request['name'];
        $role->description = $request['description'];
        $role->save();

        if ($request->permissions) {
            $role->syncPermissions(explode(',', $request->permissions));
        }
        Session::flash('success', 'Successfully Created the '. $role->display_name. ' role in the database.');
        return redirect()->route('roles.show', $role->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::with('permissions')->findOrFail($id); 
        return view('manage.roles.show')->withRole($role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::where('id', $id)->with('permissions')->first();
        $permissions = Permission::all();
        
        return view('manage.roles.edit')->withRole($role)->withPermissions($permissions);
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
            'display_name' => 'required|max:255',
            'description' => 'sometimes|max:255'
        ]);

        $role = Role::findOrFail($id);
        $role->display_name = $request['display_name'];
        $role->description = $request['description'];
        $role->save();

        if ($request->permissions) {
            $role->syncPermissions(explode(',', $request->permissions));
        }
        Session::flash('success', 'Successfully updated the '. $role->display_name. ' role in the database.');
        return redirect()->route('roles.show', $id);
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
