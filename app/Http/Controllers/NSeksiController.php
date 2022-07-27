<?php

namespace App\Http\Controllers;

use App\Models\NSeksi;
use App\Models\NSektor;
use Illuminate\Http\Request;

class NSeksiController extends Controller
{
    public function index()
    {
        $NSeksi = NSeksi::all();
        $NSektor = NSektor::all();
        return view('admin.NSeksi.index', compact('NSeksi','NSektor'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        return view('admin.NSeksi.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_seksi' => 'required',
            'sektor_id' => 'required',
            'deskripsi' => 'required',
        ]);
        NSeksi::create([
            'nama_seksi' => $request->nama_seksi,
            'sektor_id' => $request->sektor_id,
            'deskripsi' => $request->deskripsi,
        ]);
        return back();
    }
    public function show($NSeksi)
    {
      
    }


    public function edit($id)
    {
        $NSeksi = NSeksi::find($id);
        return view('admin.NSeksi.edit',compact('NSeksi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_seksi' => 'required',
            'sektor_id' => 'required',
            'deskripsi' => 'required',
        ]);

        $NSeksi = NSeksi::findOrFail($id);
        $NSeksi->nama_seksi = $request->nama_seksi;
        $NSeksi->sektor_id = $request->sektor_id;
        $NSeksi->deskripsi = $request->deskripsi;
        $NSeksi->save();

        return redirect()->route('NSeksi.index')
        ->with('edit', 'NSeksi Berhasil Diedit');
    }

    public function destroy($id)
    {
        NSeksi::where('id',$id)->delete();
        return back()
            ->with('delete', 'NSeksi Berhasil Dihapus');
    }
}
