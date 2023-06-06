<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('permission_menu');
        return view('roles.permission');
    }

    public function listPermission()
    {
        $permission = Permission::all();
        return response()->json([
        'massage' => 'List Article',
        'data' => $permission
        ]);
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
        $this->authorize('permission_create');
        $request->validate([
            'permission' => 'required|unique:permissions,name',
            'slug' => 'required',
        ]);

        $data = [
            'name' => $request->permission,
            'guard_name' => 'web',
            'slug' => $request->slug
        ];

        Permission::create($data);

        return response()->json([
            'message' => 'Permission Added!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('permission_read');
        $permission = Permission::findOrFail($id);
        return response()->json([
            'message' => 'Permission Detail',
            'data' => $permission
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
        $this->authorize('permission_update');
        $request->validate([
            'permission' => 'required|unique:roles,name,' . $id,
            'slug' => 'required',
        ]);

        $data = [
            'name' => $request->permission,
            'slug' => $request->slug,
        ];

        $permission = Permission::findOrFail($id);

        $update = $permission->update($data);

        return response()->json([
            'code' => 200,
            'message' => 'Permission Updated!',
            'data' => $update
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
        $this->authorize('permission_delete');
        for($i=0;$i<count($request->id);$i++){
            $permission = Permission::findOrFail($request->id[$i]);
            $permission->delete();
        }

        return response()->json([
            'message' => 'Permission Deleted!'
        ]);
    }
}
