<?php

namespace App\Http\Controllers;

use App\Models\Perizinan;
use App\Models\Terbit;
use Illuminate\Http\Request;

class TerbitController extends Controller
{
    public function index()
    {
        $Terbit = Terbit::all();
        return view('admin.Terbit.index', compact('Terbit'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function create()
    {
        $Perizinan = Perizinan::all();
        return view('admin.Terbit.tambah',compact('Perizinan'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'perizinan_id' => 'required',
            'tanggal' => 'required', 
            'jumlah' => 'required', 
        ]);

        Terbit::create([
            'perizinan_id' => $request->perizinan_id,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
        ]);
        return redirect()->route('Terbit.index');
    }
    public function show($program,$Terbit)
    {
    }


    public function edit($id)
    {
        $Terbit = Terbit::find($id);
        // $kategori = Kategori::all();
        return view('admin.Terbit.edit',compact('Terbit'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'perizinan_id' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required',
        ]);

        $Terbit = Terbit::findOrFail($id);

        $Terbit->perizinan_id = $request->perizinan_id;
        $Terbit->tanggal = $request->tanggal;
        $Terbit->jumlah = $request->jumlah;
        $Terbit->save();

        return redirect()->route('Program.index')
        ->with('edit', 'Terbit Berhasil Diedit');
    }

    public function destroy($id)
    {
        Terbit::where('id',$id)->delete();
        return back()
            ->with('delete', 'Terbit Berhasil Dihapus');
    }
}
