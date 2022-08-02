<?php

namespace App\Http\Controllers;

use App\Models\IMTN;
use Illuminate\Http\Request;

class IMTNController extends Controller
{
    public function index()
    {
        $IMTN = IMTN::all();
        return view('admin.IMTN.index', compact('IMTN'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        return view('admin.IMTN.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_sektor' => 'required',
            'deskripsi' => 'required',
        ]);
        IMTN::create([
            'nama_sektor' => $request->nama_sektor,
            'deskripsi' => $request->deskripsi,
        ]);
        return back();
    }
    public function show($IMTN)
    {
      
    }


    public function edit($id)
    {
        $IMTN = IMTN::find($id);
        return view('admin.IMTN.edit',compact('IMTN'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_sektor' => 'required',
            'deskripsi' => 'required',
        ]);

        $IMTN = IMTN::findOrFail($id);
        $IMTN->nama_sektor = $request->nama_sektor;
        $IMTN->deskripsi = $request->deskripsi;
        $IMTN->save();

        return redirect()->route('IMTN.index')
        ->with('edit', 'IMTN Berhasil Diedit');
    }

    public function destroy($id)
    {
        IMTN::where('id',$id)->delete();
        return back()
            ->with('delete', 'IMTN Berhasil Dihapus');
    }
}
