<?php

namespace App\Http\Controllers;

use App\Models\NSeksi;
use App\Models\NSektor;
use App\Models\Perizinan;
use App\Models\Permohonan;
use App\Models\SektorKesehatan;
use App\Models\SektorPendidikan;
use App\Models\SektorPertahanan;
use App\Models\Terbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $Terbit = Terbit::all();
        $Terbit1 = Terbit::paginate(5);
        $Permohonan = Permohonan::all();
        $Permohonan1 = Permohonan::paginate(5);
        $Perizinan = Perizinan::all();
        $Perizinan1 = Perizinan::paginate(5);

        $DataSektor = NSektor::all();
        $DataSeksi = NSeksi::all();
        $DataPertanahan = SektorPertahanan::all();
        $DataKesehatan = SektorKesehatan::all();
        $DataPendidikan = SektorPendidikan::all();
        $QueryTotal =  $DataPertanahan->count() + $DataKesehatan->count() + $DataPendidikan->count();
        // dd($DataPendidikan);
        return view('admin.index', compact('QueryTotal', 'DataPertanahan', 'DataKesehatan', 'DataPendidikan', 'DataSektor','DataSeksi','Terbit', 'Permohonan', 'Perizinan','Terbit1','Permohonan1','Perizinan1'));
    }
}
