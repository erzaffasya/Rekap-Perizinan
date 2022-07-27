<?php

namespace App\Http\Controllers;

use App\Models\NSektor;
use Illuminate\Http\Request;

class NSektorController extends Controller
{
    public function index()
    {
        $NSektor = NSektor::all();
        return view('admin.NSektor.index', compact('NSektor'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        return view('admin.NSektor.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sektor' => 'required',
            'deskripsi' => 'required',
        ]);
        NSektor::create([
            'nama_sektor' => $request->nama_sektor,
            'deskripsi' => $request->deskripsi,
        ]);
        return back();
    }
    public function show($NSektor)
    {
      
    }


    public function edit($id)
    {
        $NSektor = NSektor::find($id);
        return view('admin.NSektor.edit',compact('NSektor'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_sektor' => 'required',
            'deskripsi' => 'required',
        ]);

        $NSektor = NSektor::findOrFail($id);
        $NSektor->nama_sektor = $request->nama_sektor;
        $NSektor->deskripsi = $request->deskripsi;
        $NSektor->save();

        return redirect()->route('NSektor.index')
        ->with('edit', 'NSektor Berhasil Diedit');
    }

    public function destroy($id)
    {
        NSektor::where('id',$id)->delete();
        return back()
            ->with('delete', 'NSektor Berhasil Dihapus');
    }
}
