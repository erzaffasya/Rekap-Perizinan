<?php

namespace App\Http\Controllers;

use App\Models\Perizinan;
use App\Models\Permohonan;
use Illuminate\Http\Request;

class PermohonanController extends Controller
{
    public function index()
    {
        $Permohonan = Permohonan::all();
        return view('admin.Permohonan.index', compact('Permohonan'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $Perizinan = Perizinan::all();
        return view('admin.Permohonan.tambah',compact('Perizinan'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'perizinan_id' => 'required',
            'tanggal' => 'required', 
            'jumlah' => 'required', 
        ]);

        Permohonan::create([
            'perizinan_id' => $request->perizinan_id,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
        ]);
        return back();
    }
    public function show($program,$Permohonan)
    {
    }


    public function edit($id)
    {
        $Permohonan = Permohonan::find($id);
        // $kategori = Kategori::all();
        return view('admin.Permohonan.edit',compact('Permohonan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'perizinan_id' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required',
        ]);

        $Permohonan = Permohonan::findOrFail($id);

        $Permohonan->perizinan_id = $request->perizinan_id;
        $Permohonan->tanggal = $request->tanggal;
        $Permohonan->jumlah = $request->jumlah;
        $Permohonan->save();

        return redirect()->route('Program.index')
        ->with('edit', 'Permohonan Berhasil Diedit');
    }

    public function destroy($id)
    {
        Permohonan::where('id',$id)->delete();
        return back()
            ->with('delete', 'Permohonan Berhasil Dihapus');
    }
}
