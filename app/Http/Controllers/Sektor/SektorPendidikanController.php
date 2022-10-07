<?php

namespace App\Http\Controllers\Sektor;

use App\Http\Controllers\Controller;
use App\Imports\PendidikanImport;
use App\Models\NSeksi;
use App\Models\SektorPendidikan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SektorPendidikanController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $data = null;
        $query = SektorPendidikan::select('seksi_id', DB::raw("COUNT(*) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
            ->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])
            ->groupBy('bulan')->groupBy('seksi_id')
            ->with('seksi')->get();
        foreach ($query as $item) {
            $data[$item->seksi_id]['id'] = $item->seksi->id;
            $data[$item->seksi_id]['nama_seksi'] = $item->seksi->nama_seksi;
            if ($item->bulan == 'January') {
                $data[$item->seksi_id]['January'] = $item->jumlah;
            }
            if ($item->bulan == 'February') {
                $data[$item->seksi_id]['February'] = $item->jumlah;
            }
            if ($item->bulan == 'March') {
                $data[$item->seksi_id]['March'] = $item->jumlah;
            }
            if ($item->bulan == 'April') {
                $data[$item->seksi_id]['April'] = $item->jumlah;
            }
            if ($item->bulan == 'May') {
                $data[$item->seksi_id]['May'] = $item->jumlah;
            }
            if ($item->bulan == 'June') {
                $data[$item->seksi_id]['June'] = $item->jumlah;
            }
            if ($item->bulan == 'July') {
                $data[$item->seksi_id]['July'] = $item->jumlah;
            }
            if ($item->bulan == 'August') {
                $data[$item->seksi_id]['August'] = $item->jumlah;
            }
            if ($item->bulan == 'September') {
                $data[$item->seksi_id]['September'] = $item->jumlah;
            }
            if ($item->bulan == 'October') {
                $data[$item->seksi_id]['October'] = $item->jumlah;
            }
            if ($item->bulan == 'November') {
                $data[$item->seksi_id]['November'] = $item->jumlah;
            }
            if ($item->bulan == 'December') {
                $data[$item->seksi_id]['December'] = $item->jumlah;
            }
        }
        // dd($data);
        return view('admin.Sektor.Pendidikan.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    public function filterData(Request $request)
    {
        $data = null;
        $query = SektorPendidikan::select('seksi_id', DB::raw("COUNT(*) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
            ->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])
            ->groupBy('bulan')->groupBy('seksi_id')
            ->with('seksi')->get();
        foreach ($query as $item) {
            $data[$item->seksi_id]['id'] = $item->seksi->id;
            $data[$item->seksi_id]['nama_seksi'] = $item->seksi->nama_seksi;
            if ($item->bulan == 'January') {
                $data[$item->seksi_id]['January'] = $item->jumlah;
            }
            if ($item->bulan == 'February') {
                $data[$item->seksi_id]['February'] = $item->jumlah;
            }
            if ($item->bulan == 'March') {
                $data[$item->seksi_id]['March'] = $item->jumlah;
            }
            if ($item->bulan == 'April') {
                $data[$item->seksi_id]['April'] = $item->jumlah;
            }
            if ($item->bulan == 'May') {
                $data[$item->seksi_id]['May'] = $item->jumlah;
            }
            if ($item->bulan == 'June') {
                $data[$item->seksi_id]['June'] = $item->jumlah;
            }
            if ($item->bulan == 'July') {
                $data[$item->seksi_id]['July'] = $item->jumlah;
            }
            if ($item->bulan == 'August') {
                $data[$item->seksi_id]['August'] = $item->jumlah;
            }
            if ($item->bulan == 'September') {
                $data[$item->seksi_id]['September'] = $item->jumlah;
            }
            if ($item->bulan == 'October') {
                $data[$item->seksi_id]['October'] = $item->jumlah;
            }
            if ($item->bulan == 'November') {
                $data[$item->seksi_id]['November'] = $item->jumlah;
            }
            if ($item->bulan == 'December') {
                $data[$item->seksi_id]['December'] = $item->jumlah;
            }
        }
        return $data;
    }
    public function detailData(Request $request)
    {
        $data = null;

        $date = date_parse($request->bulan);


        if ($date['month'] == true) {
            $data = SektorPendidikan::where('seksi_id', $request->seksi)->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->whereMonth('tanggal', $date['month'])->get();
        } else {
            $data = SektorPendidikan::where('seksi_id', $request->seksi)->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->get();
        }

        return view('admin.Sektor.Pendidikan.show', compact('data'));
    }
    public function getSeksi($id)
    {
        $Seksi = NSeksi::where('sektor_id', $id)->get();
        return $Seksi;
    }
    public function importPendidikan(Request $request)
    {
        Excel::import(new PendidikanImport, $request->file('file'));
        return back();
    }

    public function showPendidikan($id)
    {
        // $query = Pendidikan::select('seksi_id', DB::raw("(SUM(jumlah)) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
        //     ->whereYear('tanggal', date('Y'))
        //     ->groupBy('bulan')->groupBy('seksi_id')
        //     ->with('seksi')->get();
        // dd($query);     


        // dd($data);

        $Pendidikan = SektorPendidikan::all();
        return view('admin.Sektor.Pendidikan.index', compact('Pendidikan'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
       $seksi = NSeksi::where('sektor_id',3)->get();
        return view('admin.Sektor.Pendidikan.tambah', compact('seksi'));
    }

    public function store(Request $request)
    {
       $data = SektorPendidikan::create($request->all());
       return redirect()->route('Pendidikan.index')->with('success','Data Berhasil Ditambahkan');
    }
    public function show($id)
    {
        // $Pendidikan = Pendidikan::where('seksi_id', $id)->whereYear('tanggal', request()->tahun)->get();
        // // dd($Pendidikan);
        // return view('admin.Sektor.Pendidikan.detail', compact('Pendidikan'));
    }


    public function edit($id)
    {
        // $Pendidikan = Pendidikan::find($id);
        // if (Auth::user()->role_id == 1) {
        //     $seksi = seksi::all();
        // } else {
        //     $seksi = seksi::where('role_id', Auth::user()->role_id)->get();
        // }
        // // dd($Pendidikan->tanggal->format('d/m/Y'));
        // return view('admin.Sektor.Pendidikan.edit', compact('Pendidikan', 'seksi'));
    }

    public function update(Request $request, $id)
    {
        // $Pendidikan = Pendidikan::findOrFail($id);

        // $Pendidikan->seksi_id = $request->seksi_id;
        // $Pendidikan->tanggal = $request->tanggal;
        // $Pendidikan->jumlah = $request->jumlah;
        // $Pendidikan->save();

        // return redirect()->route('Pendidikan.index')
        //     ->with('edit', 'Pendidikan Berhasil Diedit');
    }

    public function destroy($id)
    {
        // Pendidikan::where('id', $id)->delete();
        // return back()
        //     ->with('delete', 'Pendidikan Berhasil Dihapus');
    }
}
