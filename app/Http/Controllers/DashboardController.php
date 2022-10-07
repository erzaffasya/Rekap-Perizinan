<?php

namespace App\Http\Controllers;

use App\Models\NSeksi;
use App\Models\NSektor;
use App\Models\SektorKesehatan;
use App\Models\SektorPendidikan;
use App\Models\SektorPerdagangan;
use App\Models\SektorPertahanan;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $DataSektor = NSektor::all();
        $DataSeksi = NSeksi::all();

        $DataPertanahan = SektorPertahanan::all();
        $DataKesehatan = SektorKesehatan::all();
        $DataPendidikan = SektorPendidikan::all();
        $DataPerdagangan = SektorPerdagangan::all();
        $QueryTotal =  $DataPertanahan->count() + $DataKesehatan->count() + $DataPendidikan->count() + $DataPerdagangan->count();

        // $query = SektorPerdagangan::select( DB::raw("COUNT(*) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
        // ->whereYear('tanggal', date("Y"))
        // ->groupBy('bulan')->get();

        $LinePertanahan = json_encode($this->dashboardPerBulan(SektorPertahanan::select(DB::raw("COUNT(*) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
            ->groupBy('bulan')->get()));

        $LineKesehatan = json_encode($this->dashboardPerBulan(SektorKesehatan::select(DB::raw("COUNT(*) as jumlah"), DB::raw("MONTHNAME(izin_terbit) as bulan"))
            ->groupBy('bulan')
            ->get()));

        $LinePendidikan = json_encode($this->dashboardPerBulan(SektorPendidikan::select(DB::raw("COUNT(*) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
            ->groupBy('bulan')
            ->get()));

        $LinePerdagangan = json_encode($this->dashboardPerBulan(SektorPerdagangan::select(DB::raw("COUNT(*) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
            ->groupBy('bulan')
            ->get()));

        // return ($LinePerdagangan);
        return view('admin.index', compact('LinePertanahan','LineKesehatan','LinePendidikan','LinePerdagangan','QueryTotal', 'DataPerdagangan', 'DataPertanahan', 'DataKesehatan', 'DataPendidikan', 'DataSektor', 'DataSeksi'));
    }

    public function bukupanduan()
    {
        return view('admin.bukuPanduan');
    }
}
