<?php

namespace App\Http\Controllers;

use App\Exports\PermohonanExport;
use App\Imports\PermohonanImport;
use App\Models\Perizinan;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PermohonanController extends Controller
{
    public function index()
    {
        $Permohonan = Permohonan::all();
        return view('admin.Permohonan.index', compact('Permohonan'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function cariTahunPermohonan(Request $request)
    {
        $query = Permohonan::select('perizinan_id', DB::raw("(SUM(jumlah)) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
            ->whereYear('tanggal', $request->tahun)
            ->groupBy('bulan')->groupBy('perizinan_id')
            ->with('Perizinan')->get();
        $data = null;
        foreach ($query as $item) {
            $data[$item->perizinan_id]['id'] = $item->Perizinan->id;
            $data[$item->perizinan_id]['nama_izin'] = $item->Perizinan->nama_izin;
            if ($item->bulan == 'January') {
                $data[$item->perizinan_id]['January'] = $item->jumlah;
            }
            if ($item->bulan == 'February') {
                $data[$item->perizinan_id]['February'] = $item->jumlah;
            }
            if ($item->bulan == 'March') {
                $data[$item->perizinan_id]['March'] = $item->jumlah;
            }
            if ($item->bulan == 'April') {
                $data[$item->perizinan_id]['April'] = $item->jumlah;
            }
            if ($item->bulan == 'May') {
                $data[$item->perizinan_id]['May'] = $item->jumlah;
            }
            if ($item->bulan == 'June') {
                $data[$item->perizinan_id]['June'] = $item->jumlah;
            }
            if ($item->bulan == 'July') {
                $data[$item->perizinan_id]['July'] = $item->jumlah;
            }
            if ($item->bulan == 'August') {
                $data[$item->perizinan_id]['August'] = $item->jumlah;
            }
            if ($item->bulan == 'September') {
                $data[$item->perizinan_id]['September'] = $item->jumlah;
            }
            if ($item->bulan == 'October') {
                $data[$item->perizinan_id]['October'] = $item->jumlah;
            }
            if ($item->bulan == 'November') {
                $data[$item->perizinan_id]['November'] = $item->jumlah;
            }
            if ($item->bulan == 'December') {
                $data[$item->perizinan_id]['December'] = $item->jumlah;
            }
        }
        // dd($data);
        $Permohonan = Permohonan::all();
        return view('admin.Permohonan.index', compact('Permohonan', 'data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function exportPermohonan()
    {
        return Excel::download(new PermohonanExport(), 'Permohonan.xlsx');
    }
    public function importPermohonan(Request $request)
    {
        // dd($request->file('file'));
        Excel::import(new PermohonanImport, $request->file('file'));
        return back();
    }
    public function create()
    {
        if (Auth::user()->role_id == 1) {
            $Perizinan = Perizinan::all();
        } else {
            $Perizinan = Perizinan::where('role_id', Auth::user()->role_id)->get();
        }
        //   dd($Perizinan);
        return view('admin.Permohonan.tambah', compact('Perizinan'));
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
        return redirect()->route('Permohonan.index');
    }
    public function show($id)
    {
        $Permohonan = Permohonan::where('perizinan_id', $id)->whereYear('tanggal', request()->tahun)->get();
        // dd($Permohonan);
        return view('admin.Permohonan.detail', compact('Permohonan'));
    }


    public function edit($id)
    {
        $Permohonan = Permohonan::find($id);
        if (Auth::user()->role_id == 1) {
            $Perizinan = Perizinan::all();
        } else {
            $Perizinan = Perizinan::where('role_id', Auth::user()->role_id)->get();
        }
        return view('admin.Permohonan.edit', compact('Permohonan', 'Perizinan'));
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'perizinan_id' => 'required',
        //     'tanggal' => 'required',
        //     'jumlah' => 'required',
        // ]);

        $Permohonan = Permohonan::findOrFail($id);

        $Permohonan->perizinan_id = $request->perizinan_id;
        $Permohonan->tanggal = $request->tanggal;
        $Permohonan->jumlah = $request->jumlah;
        $Permohonan->save();

        return redirect()->route('Permohonan.index')
            ->with('edit', 'Permohonan Berhasil Diedit');
    }

    public function destroy($id)
    {
        Permohonan::where('id', $id)->delete();
        return back()
            ->with('delete', 'Permohonan Berhasil Dihapus');
    }
}
