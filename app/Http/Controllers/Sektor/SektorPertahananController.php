<?php

namespace App\Http\Controllers\Sektor;

use App\Http\Controllers\Controller;

use App\Imports\PertahananImport;
use App\Models\NSeksi;
use App\Models\SektorPertahanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class SektorPertahananController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());
        $data = null;
        $query = SektorPertahanan::select('seksi_id', DB::raw("COUNT(*) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
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
        $query = SektorPertahanan::select('seksi_id', DB::raw("COUNT(*) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
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
        // dd("erza");
        $data = null;

        $date = date_parse($request->bulan);


        if ($date['month'] == true) {
            $data = SektorPertahanan::where('seksi_id', $request->seksi)->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->whereMonth('tanggal', $date['month'])->get();
        } else {
            $data = SektorPertahanan::where('seksi_id', $request->seksi)->whereBetween('tanggal', [$request->tanggal_awal, $request->tanggal_akhir])->get();
        }

        return view('admin.Sektor.Perdagangan.show', compact('data'));
    }
    public function getSeksi($id)
    {
        $Seksi = NSeksi::where('sektor_id', $id)->get();
        return $Seksi;
    }

    public function importData(Request $request)
    {
        Excel::import(new PertahananImport, $request->file('file'));
        return back();
    }

    // public function create()
    // {
    //     return view('admin.Sektor.Pertahanan.tambah');
    // }

    // public function store(Request $request)
    // {
        // $request->validate([
        //     'no_surat' => 'required',
        //     'alamat' => 'required',
        // ]);
    //     SektorPertahanan::create([
    //         'no_surat' => $request->no_surat,
    //         'alamat' => $request->alamat,
    //         'nama_pemohon' => $request->nama_pemohon,
    //         'kecamatan' => $request->kecamatan,
    //         'tanggal' => $request->tanggal,
    //         'tujuan_opd' => $request->tujuan_opd,
    //         'keterangan' => $request->keterangan,
    //     ]);
    //     return back();
    // }
    // public function show($Pertahanan)
    // {
    // }


    // public function edit($id)
    // {
    //     $Pertahanan = SektorPertahanan::find($id);
    //     return view('admin.Sektor.Pertahanan.edit', compact('Pertahanan'));
    // }

    // public function update(Request $request, $id)
    // {
    //     // $request->validate([
    //     //     'no_surat' => 'required',
    //     //     'alamat' => 'required',
    //     // ]);

    //     $Pertahanan = SektorPertahanan::findOrFail($id);
    //     $Pertahanan->no_surat = $request->no_surat;
    //     $Pertahanan->alamat = $request->alamat;
    //     $Pertahanan->nama_pemohon = $request->nama_pemohon;
    //     $Pertahanan->kecamatan = $request->kecamatan;
    //     $Pertahanan->tanggal = $request->tanggal;
    //     $Pertahanan->tujuan_opd = $request->tujuan_opd;
    //     $Pertahanan->keterangan = $request->keterangan;
    //     $Pertahanan->save();

    //     return redirect()->route('Pertahanan.index')
    //         ->with('edit', 'Pertahanan Berhasil Diedit');
    // }

    // public function destroy($id)
    // {
    //     SektorPertahanan::where('id', $id)->delete();
    //     return back()
    //         ->with('delete', 'Pertahanan Berhasil Dihapus');
    // }
}
