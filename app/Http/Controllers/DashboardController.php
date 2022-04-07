<?php

namespace App\Http\Controllers;

use App\Models\Perizinan;
use App\Models\Permohonan;
use App\Models\Terbit;
use Illuminate\Http\Request;

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

        return view('admin.index', compact('Terbit', 'Permohonan', 'Perizinan','Terbit1','Permohonan1','Perizinan1'));
    }
}
