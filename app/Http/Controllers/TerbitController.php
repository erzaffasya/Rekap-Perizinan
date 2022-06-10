<?php

namespace App\Http\Controllers;

use App\Exports\TerbitExport;
use App\Models\Perizinan;
use App\Models\Terbit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class TerbitController extends Controller
{
    public function index()
    {
        // $query = Terbit::select('perizinan_id', DB::raw("(SUM(jumlah)) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
        //     ->whereYear('tanggal', date('Y'))
        //     ->groupBy('bulan')->groupBy('perizinan_id')
        //     ->with('Perizinan')->get();
        // dd($query);     
        
    
        // dd($data);
        $Tahun = Terbit::select(DB::raw('year(tanggal) as year'))->groupBy('year')->get();
        $Terbit = Terbit::all();
        return view('admin.Terbit.index', compact('Terbit','Tahun'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function showterbit($id)
    {
        // $query = Terbit::select('perizinan_id', DB::raw("(SUM(jumlah)) as jumlah"), DB::raw("MONTHNAME(tanggal) as bulan"))
        //     ->whereYear('tanggal', date('Y'))
        //     ->groupBy('bulan')->groupBy('perizinan_id')
        //     ->with('Perizinan')->get();
        // dd($query);     
        
    
        // dd($data);

        $Terbit = Terbit::all();
        return view('admin.Terbit.index', compact('Terbit'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function cariTahunTerbit(Request $request)
    {
        $Tahun = Terbit::select(DB::raw('year(tanggal) as year'))->groupBy('year')->get();
        $query = Terbit::select('perizinan_id',DB::raw("(SUM(jumlah)) as jumlah"),DB::raw("MONTHNAME(tanggal) as bulan"))
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

        $Terbit = Terbit::all();
        return view('admin.Terbit.index', compact('Terbit','data','Tahun','query'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function exportTerbit()
    {
        return Excel::download(new TerbitExport(), 'Terbit.xlsx');
    }

    public function create()
    {
        if(Auth::user()->role_id == 1){
            $Perizinan = Perizinan::all();
        }else{
            $Perizinan = Perizinan::where('role_id',Auth::user()->role_id)->get();
        }
        return view('admin.Terbit.tambah', compact('Perizinan'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'perizinan_id' => 'required',
            'tanggal' => 'required',
            'jumlah' => 'required',
        ]);

        Terbit::create([
            'perizinan_id' => $request->perizinan_id,
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
        ]);
        $tanggal = explode('-',$request->tanggal);
        return redirect('cariTahunTerbit?tahun='.$tanggal[0]);
    }
    public function show($id)
    {
        $Terbit = Terbit::where('perizinan_id',$id)->whereYear('tanggal',request()->tahun)->get();
        // dd($Terbit);
        return view('admin.Terbit.detail', compact('Terbit'));
    }


    public function edit($id)
    {
        $Terbit = Terbit::find($id);
        if(Auth::user()->role_id == 1){
            $Perizinan = Perizinan::all();
        }else{
            $Perizinan = Perizinan::where('role_id',Auth::user()->role_id)->get();
        }
        // dd($Terbit->tanggal->format('d/m/Y'));
        return view('admin.Terbit.edit', compact('Terbit','Perizinan'));
    }

    public function update(Request $request, $id)
    {
        $Terbit = Terbit::findOrFail($id);

        $Terbit->perizinan_id = $request->perizinan_id;
        $Terbit->tanggal = $request->tanggal;
        $Terbit->jumlah = $request->jumlah;
        $Terbit->save();

        return redirect()->route('Terbit.index')
            ->with('edit', 'Terbit Berhasil Diedit');
    }

    public function destroy($id)
    {
        Terbit::where('id', $id)->delete();
        return back()
            ->with('delete', 'Terbit Berhasil Dihapus');
    }
}
