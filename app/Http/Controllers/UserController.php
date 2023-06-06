<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use function PHPUnit\Framework\isEmpty;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('user_menu');
        $roles = Role::all();

        return view('users.index',compact('roles'));
    }

    public function listUser()
    {
        $users = User::with('roles')->get()->except(auth()->user()->id);
        return response()->json([
            'message' => 'List User',
            'data' => $users,
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
        $this->authorize('user_create');
        $request->validate(
            [
                'name' => 'required',
                'username' => 'required',
                'email' => 'required|email|unique:users,email',
                'role' => 'required',
                'password' => 'required|confirmed|min:6',
                'img_profile' => 'nullable|file|max:2048',
            ]
        );
        $dataUser = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ];

        $user = User::create($dataUser);

        if(!empty($request->img_profile)){
            $img_name = $user->id.'_'.date("ymdhis").'.'.$request->file('img_profile')->getClientOriginalExtension();
            $request->file('img_profile')->storeAs('public/img_profile', $img_name);
            $user->update(['image_profile' => $img_name]);
        }
        

        $user->assignRole($request->role);


        return response()->json([
            'message' => 'User Added!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('user_read');
        $user = User::with('roles')->findOrFail($id);
        return response()->json([
            'message' => 'User Details',
            'data' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(auth()->user()->id != $id){
            abort(404); 
        }
        $user = User::findOrFail($id);
        return view('users.profile-edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('user_update');
        $request->validate(
            [
                'name' => 'required',
                'username' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
                'role' => 'required',
                'password' => 'nullable|confirmed|min:6',
                'img_profile' => 'nullable|file|max:2048',
                ]
            );
            $user = User::findOrFail($id);
                
            $dataUser = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ];

            $user->update($dataUser);

            if(!empty($request->img_profile)){
                $img_name = $user->id.'_'.date("ymdhis").'.'.$request->file('img_profile')->getClientOriginalExtension();
                $path = storage_path('app/public/img_profile/'.$user->image_profile);
                if (File::exists($path)) 
                {
                    File::delete($path);
                }
                $request->file('img_profile')->storeAs('public/img_profile', $img_name);
                $user->update(['image_profile' => $img_name]);
            }

            if(!empty($request->password)){
                $pass = bcrypt($request->password);
                $user->update(['password' => $pass]);
            }
            

            $user->assignRole($request->role);


            return response()->json([
                'message' => 'User Updated!'
            ]);
    }

    public function updateProfile(Request $request, string $id)
    {
        if(auth()->user()->id != $id){
            abort(404); 
        }
        $request->validate(
            [
                'name' => 'required',
                'username' => 'required',
                'email' => 'required|email|unique:users,email,'.$id,
                'password' => 'nullable|confirmed|min:6',
                'image_profile' => 'nullable|file|max:2048',
                ]
            );
            $user = User::findOrFail($id);
                
            $dataUser = [
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ];

            $user->update($dataUser);

            if(!empty($request->image_profile)){
                $img_name = $user->id.'_'.date("ymdhis").'.'.$request->file('image_profile')->getClientOriginalExtension();
                $path = storage_path('app/public/img_profile/'.$user->image_profile);
                if (File::exists($path)) 
                {
                    File::delete($path);
                }
                $request->file('image_profile')->storeAs('public/img_profile', $img_name);
                $user->update(['image_profile' => $img_name]);
            }

            if(!empty($request->password)){
                $pass = bcrypt($request->password);
                $user->update(['password' => $pass]);
            }

            return back()->with('success','Profile Updated!');
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
        $this->authorize('user_delete');
        for($i=0;$i<count($request->id);$i++){
            $user = User::findOrFail($request->id[$i]);
            $path = storage_path('app/public/img_profile/'.$user->image_profile);
            if (File::exists($path)) 
            {
                File::delete($path);
            }
            $user->delete();
        }

        return response()->json([
            'message' => 'Article Deleted!'
        ]);
    }
}
