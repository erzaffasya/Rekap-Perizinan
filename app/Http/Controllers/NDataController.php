<?php

namespace App\Http\Controllers;

use App\Imports\NDataImport;
use App\Models\NData;
use App\Models\NSeksi;
use App\Models\NSektor;
use App\Models\seksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class NDataController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $data = null;
        $query = NData::select('seksi_id', DB::raw("COUNT(*) as jumlah"), DB::raw("MONTHNAME(izin_terbit) as bulan"))
            ->whereBetween('izin_terbit', [$request->tanggal_awal, $request->tanggal_akhir])
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
        return view('admin.NData.index', compact('data'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function filterData(Request $request)
    {
        $data = null;
        $query = NData::select('seksi_id', DB::raw("COUNT(*) as jumlah"), DB::raw("MONTHNAME(izin_terbit) as bulan"))
            ->whereBetween('izin_terbit', [$request->tanggal_awal, $request->tanggal_akhir])
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
            $data = NData::where('seksi_id', $request->seksi)->whereBetween('izin_terbit', [$request->tanggal_awal, $request->tanggal_akhir])->whereMonth('izin_terbit', $date['month'])->get();
        } else {
            $data = NData::where('seksi_id', $request->seksi)->whereBetween('izin_terbit', [$request->tanggal_awal, $request->tanggal_akhir])->get();
        }

        return view('admin.NData.show', compact('data'));
    }
    public function getSeksi($id)
    {
        $Seksi = NSeksi::where('sektor_id', $id)->get();
        return $Seksi;
    }
    public function importNData(Request $request)
    {
        Excel::import(new NDataImport, $request->file('file'));
        return back();
    }

    public function showNData($id)
    {
        // $query = NData::select('seksi_id', DB::raw("(SUM(jumlah)) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
        //     ->whereYear('tanggal', date('Y'))
        //     ->groupBy('bulan')->groupBy('seksi_id')
        //     ->with('seksi')->get();
        // dd($query);     


        // dd($data);

        $NData = NData::all();
        return view('admin.NData.index', compact('NData'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        // if (Auth::user()->role_id == 1) {
        //     $seksi = seksi::all();
        // } else {
        //     $seksi = seksi::where('role_id', Auth::user()->role_id)->get();
        // }
        // return view('admin.NData.tambah', compact('seksi'));
    }

    public function store(Request $request)
    {
        // dd($request);
        // $request->validate([
        //     'seksi_id' => 'required',
        //     'tanggal' => 'required',
        //     'jumlah' => 'required',
        // ]);

        // NData::create([
        //     'seksi_id' => $request->seksi_id,
        //     'tanggal' => $request->tanggal,
        //     'jumlah' => $request->jumlah,
        // ]);
        // $tanggal = explode('-', $request->tanggal);
        // return redirect('cariTahunNData?tahun=' . $tanggal[0]);
    }
    public function show($id)
    {
        // $NData = NData::where('seksi_id', $id)->whereYear('tanggal', request()->tahun)->get();
        // // dd($NData);
        // return view('admin.NData.detail', compact('NData'));
    }


    public function edit($id)
    {
        // $NData = NData::find($id);
        // if (Auth::user()->role_id == 1) {
        //     $seksi = seksi::all();
        // } else {
        //     $seksi = seksi::where('role_id', Auth::user()->role_id)->get();
        // }
        // // dd($NData->tanggal->format('d/m/Y'));
        // return view('admin.NData.edit', compact('NData', 'seksi'));
    }

    public function update(Request $request, $id)
    {
        // $NData = NData::findOrFail($id);

        // $NData->seksi_id = $request->seksi_id;
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
