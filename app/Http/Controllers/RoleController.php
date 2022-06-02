<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $User = User::all();
        $Role = Role::all();
        return view('admin.Role.index', compact('Role', 'User'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        $User = User::all();
        return view('admin.Role.tambah', compact('User'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role_id' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role_id' => $request->role_id,
        ]);
        return back();
    }
    public function show($Role)
    {
    }


    public function edit($id)
    {
        $Role = Role::find($id);
        $User = User::all();
        return view('admin.Role.edit', compact('Role', 'User'));
    }

    public function update(Request $request, $id)
    {

        // dd($request->password);
        $Role = User::findOrFail($id);
        $Role->name = $request->name;
        $Role->email = $request->email;
        if ($request->password != null) {
            $Role->password = bcrypt($request->password);
        }
        $Role->role_id = $request->role_id;
        $Role->save();

        return redirect()->route('Role.index')
            ->with('edit', 'Role Berhasil Diedit');
    }

    public function destroy($id)
    {
        User::where('id', $id)->delete();
        return back()
            ->with('delete', 'User Berhasil Dihapus');
    }
}
