<?php

namespace App\Http\Controllers;

use App\Imports\NDataImport;
use App\Models\NData;
use App\Models\NSeksi;
use App\Models\NSektor;
use App\Models\Perizinan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class NDataController extends Controller
{
    public function index()
    {
        $NSektor = NSektor::all();
        $NSeksi = NSeksi::all();
        $NData = NData::all();
        return view('admin.NData.index', compact('NData','NSektor','NSeksi'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function getSeksi($id)
    {
        $Seksi = NSeksi::where('sektor_id',$id)->get();
        return $Seksi;
    }
    public function importNData(Request $request)
    {
        Excel::import(new NDataImport, $request->file('file'));
        return back();
    }

    public function showNData($id)
    {
        // $query = NData::select('perizinan_id', DB::raw("(SUM(jumlah)) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
        //     ->whereYear('tanggal', date('Y'))
        //     ->groupBy('bulan')->groupBy('perizinan_id')
        //     ->with('Perizinan')->get();
        // dd($query);     


        // dd($data);

        $NData = NData::all();
        return view('admin.NData.index', compact('NData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        // if (Auth::user()->role_id == 1) {
        //     $Perizinan = Perizinan::all();
        // } else {
        //     $Perizinan = Perizinan::where('role_id', Auth::user()->role_id)->get();
        // }
        // return view('admin.NData.tambah', compact('Perizinan'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $request->validate([
        //     'perizinan_id' => 'required',
        //     'tanggal' => 'required',
        //     'jumlah' => 'required',
        // ]);

        // NData::create([
        //     'perizinan_id' => $request->perizinan_id,
        //     'tanggal' => $request->tanggal,
        //     'jumlah' => $request->jumlah,
        // ]);
        // $tanggal = explode('-', $request->tanggal);
        // return redirect('cariTahunNData?tahun=' . $tanggal[0]);
    }
    public function show($id)
    {
        // $NData = NData::where('perizinan_id', $id)->whereYear('tanggal', request()->tahun)->get();
        // // dd($NData);
        // return view('admin.NData.detail', compact('NData'));
    }


    public function edit($id)
    {
        // $NData = NData::find($id);
        // if (Auth::user()->role_id == 1) {
        //     $Perizinan = Perizinan::all();
        // } else {
        //     $Perizinan = Perizinan::where('role_id', Auth::user()->role_id)->get();
        // }
        // // dd($NData->tanggal->format('d/m/Y'));
        // return view('admin.NData.edit', compact('NData', 'Perizinan'));
    }

    public function update(Request $request, $id)
    {
        // $NData = NData::findOrFail($id);

        // $NData->perizinan_id = $request->perizinan_id;
        // $NData->tanggal = $request->tanggal;
        // $NData->jumlah = $request->jumlah;
        // $NData->save();

        // return redirect()->route('NData.index')
        //     ->with('edit', 'NData Berhasil Diedit');
    }

    public function destroy($id)
    {
        // NData::where('id', $id)->delete();
        // return back()
        //     ->with('delete', 'NData Berhasil Dihapus');
    }
}
