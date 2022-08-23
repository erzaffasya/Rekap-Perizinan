<?php

namespace App\Http\Controllers\Sektor;

use App\Http\Controllers\Controller;
use App\Imports\PerdaganganImport;
use App\Models\NSeksi;
use App\Models\SektorPerdagangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SektorPerdaganganController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $data = null;
        $query = SektorPerdagangan::select('seksi_id', DB::raw("COUNT(*) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
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
        return view('admin.Sektor.Perdagangan.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    public function filterData(Request $request)
    {
        $data = null;
        $query = SektorPerdagangan::select('seksi_id', DB::raw("COUNT(*) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
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
            $data = SektorPerdagangan::where('seksi_id', $request->seksi)->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->whereMonth('tanggal', $date['month'])->get();
        } else {
            $data = SektorPerdagangan::where('seksi_id', $request->seksi)->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->get();
        }

        return view('admin.Sektor.Perdagangan.show', compact('data'));
    }
    public function getSeksi($id)
    {
        $Seksi = NSeksi::where('sektor_id', $id)->get();
        return $Seksi;
    }
    public function importPerdagangan(Request $request)
    {
        Excel::import(new PerdaganganImport, $request->file('file'));
        return back();
    }

    public function showPerdagangan($id)
    {
        // $query = Perdagangan::select('seksi_id', DB::raw("(SUM(jumlah)) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
        //     ->whereYear('tanggal', date('Y'))
        //     ->groupBy('bulan')->groupBy('seksi_id')
        //     ->with('seksi')->get();
        // dd($query);     


        // dd($data);

        $Perdagangan = SektorPerdagangan::all();
        return view('admin.Sektor.Perdagangan.index', compact('Perdagangan'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
       $seksi = NSeksi::where('sektor_id',4)->get();
        return view('admin.Sektor.Perdagangan.tambah', compact('seksi'));
    }

    public function store(Request $request)
    {
       $data = SektorPerdagangan::create($request->all());
       return redirect()->route('Perdagangan.index')->with('success','Data Berhasil Ditambahkan');
    }
    public function show($id)
    {
        // $Perdagangan = Perdagangan::where('seksi_id', $id)->whereYear('tanggal', request()->tahun)->get();
        // // dd($Perdagangan);
        // return view('admin.Sektor.Perdagangan.detail', compact('Perdagangan'));
    }


    public function edit($id)
    {
        // $Perdagangan = Perdagangan::find($id);
        // if (Auth::user()->role_id == 1) {
        //     $seksi = seksi::all();
        // } else {
        //     $seksi = seksi::where('role_id', Auth::user()->role_id)->get();
        // }
        // // dd($Perdagangan->tanggal->format('d/m/Y'));
        // return view('admin.Sektor.Perdagangan.edit', compact('Perdagangan', 'seksi'));
    }

    public function update(Request $request, $id)
    {
        // $Perdagangan = Perdagangan::findOrFail($id);

        // $Perdagangan->seksi_id = $request->seksi_id;
        // $Perdagangan->tanggal = $request->tanggal;
        // $Perdagangan->jumlah = $request->jumlah;
        // $Perdagangan->save();

        // return redirect()->route('Perdagangan.index')
        //     ->with('edit', 'Perdagangan Berhasil Diedit');
    }

    public function destroy($id)
    {
        // Perdagangan::where('id', $id)->delete();
        // return back()
        //     ->with('delete', 'Perdagangan Berhasil Dihapus');
    }
}
