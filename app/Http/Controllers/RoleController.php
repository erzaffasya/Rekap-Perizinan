<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
       
        $Role = Role::all();
        return view('admin.Role.index', compact('Role'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        // $kategori = Kategori::all();
        return view('admin.Role.tambah');
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'nama_izin' => 'required',
        ]);

        // $date = date("his");
        // $extension = $request->file('gambar1')->extension();
        // $file_name = "Role_$date.$extension";
        // $path = $request->file('gambar1')->storeAs('public/Role', $file_name);
        // if($request->status == NULL){
        //     $status = false;
        // }else{
        //     $status = true;
        // }
        Role::create([
            'nama_izin' => $request->nama_izin,
        ]);
        return back();
    }
    public function show($Role)
    {
      
    }


    public function edit($id)
    {
        $Role = Role::find($id);
        // $kategori = Kategori::all();
        return view('admin.Role.edit',compact('Role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_izin' => 'required',
        ]);

        $Role = Role::findOrFail($id);
        $Role->nama_izin = $request->nama_izin;
        $Role->save();

        return redirect()->route('Role.index')
        ->with('edit', 'Role Berhasil Diedit');
    }

    public function destroy($id)
    {
        Role::where('id',$id)->delete();
        return back()
            ->with('delete', 'Role Berhasil Dihapus');
    }
}
