<?php

namespace App\Http\Controllers;

use App\Models\KategoriHelpdesk;
use Illuminate\Http\Request;

class KategoriHelpdeskController extends Controller
{
    public function index()
    {
        $KategoriHelpdesk = KategoriHelpdesk::all();
        return view('admin.KategoriHelpdesk.index', compact('KategoriHelpdesk'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        return view('admin.KategoriHelpdesk.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'required',
        ]);
        KategoriHelpdesk::create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);
        return back();
    }
    public function show($KategoriHelpdesk)
    {
      
    }


    public function edit($id)
    {
        $KategoriHelpdesk = KategoriHelpdesk::find($id);
        return view('admin.KategoriHelpdesk.edit',compact('KategoriHelpdesk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'required',
        ]);

        $KategoriHelpdesk = KategoriHelpdesk::findOrFail($id);
        $KategoriHelpdesk->nama_kategori = $request->nama_kategori;
        $KategoriHelpdesk->deskripsi = $request->deskripsi;
        $KategoriHelpdesk->save();

        return redirect()->route('KategoriHelpdesk.index')
        ->with('edit', 'KategoriHelpdesk Berhasil Diedit');
    }

    public function destroy($id)
    {
        KategoriHelpdesk::where('id',$id)->delete();
        return back()
            ->with('delete', 'KategoriHelpdesk Berhasil Dihapus');
    }
}
