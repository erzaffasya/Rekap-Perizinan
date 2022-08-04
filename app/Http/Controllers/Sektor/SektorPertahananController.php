<?php

namespace App\Http\Controllers\Sektor;

use App\Http\Controllers\Controller;

use App\Imports\PertahananImport;
use App\Models\SektorPertahanan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SektorPertahananController extends Controller
{
    public function index()
    {
        $Pertahanan = SektorPertahanan::all();
        return view('admin.Sektor.Pertahanan.index', compact('Pertahanan'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function importData(Request $request)
    {
        Excel::import(new PertahananImport, $request->file('file'));
        return back();
    }

    public function create()
    {
        return view('admin.Sektor.Pertahanan.tambah');
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'no_surat' => 'required',
        //     'alamat' => 'required',
        // ]);
        SektorPertahanan::create([
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
    public function show($Pertahanan)
    {
    }


    public function edit($id)
    {
        $Pertahanan = SektorPertahanan::find($id);
        return view('admin.Sektor.Pertahanan.edit', compact('Pertahanan'));
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'no_surat' => 'required',
        //     'alamat' => 'required',
        // ]);

        $Pertahanan = SektorPertahanan::findOrFail($id);
        $Pertahanan->no_surat = $request->no_surat;
        $Pertahanan->alamat = $request->alamat;
        $Pertahanan->nama_pemohon = $request->nama_pemohon;
        $Pertahanan->kecamatan = $request->kecamatan;
        $Pertahanan->tanggal = $request->tanggal;
        $Pertahanan->tujuan_opd = $request->tujuan_opd;
        $Pertahanan->keterangan = $request->keterangan;
        $Pertahanan->save();

        return redirect()->route('Pertahanan.index')
            ->with('edit', 'Pertahanan Berhasil Diedit');
    }

    public function destroy($id)
    {
        SektorPertahanan::where('id', $id)->delete();
        return back()
            ->with('delete', 'Pertahanan Berhasil Dihapus');
    }
}
