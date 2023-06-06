<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('role_menu');
        $permissions = Permission::all();
        return view('roles.role',compact('permissions'));
    }

    public function listRole()
    {
        $roles = Role::all();
        return response()->json(
            [
                'message' => 'List Role',
                'data' => $roles
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('user_create');
        $request->validate(
            [
                'permission_name' => 'required',
                'role' => 'required|unique:roles,name',
                'slug' => 'required',
            ]
        );

        $permissions = explode(',',$request->permission_name);

        $roleData = [
            'name' => $request->role,
            'slug' => $request->slug,
        ];

        $role = Role::create($roleData);
        for($i=0;$i<count($permissions);$i++){
            $role->givePermissionTo($permissions[$i]);
        }

        return response()->json([
            'message' => 'Role Added!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('user_read');
        $role = Role::findOrFail($id);
        $permissions = $role->permissions()->get();
        return response()->json([
            'message' => 'Role Details',
            'data' => $role,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('role_update');
        $request->validate(
            [
                'permission_name' => 'required',
                'role' => 'required|unique:roles,name,'.$id,
                'slug' => 'required',
            ]
        );

        $role = Role::findOrFail($id);

        $role->syncPermissions();

        $permissions = explode(',',$request->permission_name);

        $roleData = [
            'name' => $request->role,
            'slug' => $request->slug,
        ];

        $role->update($roleData);

        for($i=0;$i<count($permissions);$i++){
            $role->givePermissionTo($permissions[$i]);
        }

        return response()->json([
            'message' => 'Role Updated!'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function deletes(Request $request)
    {
        $this->authorize('role_delete');
        for($i=0;$i<count($request->id);$i++){
            $role = Role::findOrFail($request->id[$i]);
            $role->delete();
        }

        return response()->json([
            'message' => 'Role Deleted!'
        ]);
    }
}
