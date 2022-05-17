<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {

        $Seksi = Role::all();
        return view('admin.Seksi.index', compact('Seksi'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        // $kategori = Kategori::all();
        return view('admin.Seksi.tambah');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama_role' => 'required',
        ]);

        Role::create($request->all());
        return back();
    }
    public function show($Role)
    {
    }


    public function edit($id)
    {
        $Seksi = Role::find($id);
        // $kategori = Kategori::all();
        return view('admin.Seksi.edit', compact('Seksi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_role' => 'required',
        ]);

        $Role = Role::findOrFail($id);
        $Role->nama_role = $request->nama_role;
        $Role->deskripsi = $request->deskripsi;
        $Role->save();

        return redirect()->route('Seksi.index')
            ->with('edit', 'Role Berhasil Diedit');
    }

    public function destroy($id)
    {
        Role::where('id', $id)->delete();
        return back()
            ->with('delete', 'Seksi Berhasil Dihapus');
    }
}
