<?php

namespace App\Http\Controllers;

use App\Imports\IMTNImport;
use App\Models\IMTN;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class IMTNController extends Controller
{
    public function index()
    {
        $IMTN = IMTN::all();
        return view('admin.IMTN.index', compact('IMTN'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function importData(Request $request)
    {
        Excel::import(new IMTNImport, $request->file('file'));
        return back();
    }

    public function create()
    {
        return view('admin.IMTN.tambah');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'no_surat' => 'required',
        //     'alamat' => 'required',
        // ]);
        IMTN::create([
            'no_surat' => $request->no_surat,
            'alamat' => $request->alamat,
            'nama_pemohon' => $request->nama_pemohon,
            'kecamatan' => $request->kecamatan,
            'tanggal' => $request->tanggal,
            'tujuan_opd' => $request->tujuan_opd,
            'keterangan' => $request->keterangan,
        ]);
        return back();
    }
    public function show($IMTN)
    {
    }


    public function edit($id)
    {
        $IMTN = IMTN::find($id);
        return view('admin.IMTN.edit', compact('IMTN'));
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'no_surat' => 'required',
        //     'alamat' => 'required',
        // ]);

        $IMTN = IMTN::findOrFail($id);
        $IMTN->no_surat = $request->no_surat;
        $IMTN->alamat = $request->alamat;
        $IMTN->nama_pemohon = $request->nama_pemohon;
        $IMTN->kecamatan = $request->kecamatan;
        $IMTN->tanggal = $request->tanggal;
        $IMTN->tujuan_opd = $request->tujuan_opd;
        $IMTN->keterangan = $request->keterangan;
        $IMTN->save();

        return redirect()->route('IMTN.index')
            ->with('edit', 'IMTN Berhasil Diedit');
    }

    public function destroy($id)
    {
        IMTN::where('id', $id)->delete();
        return back()
            ->with('delete', 'IMTN Berhasil Dihapus');
    }
}
