<?php

namespace App\Http\Controllers;

use App\Exports\PermohonanExport;
use App\Models\Perizinan;
use App\Models\Role;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PerizinanController extends Controller
{
    public function index()
    {
        $Seksi = Role::all();
        $Perizinan = Perizinan::all();
        return view('admin.Perizinan.index', compact('Perizinan','Seksi'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        $Seksi = Role::all();
        return view('admin.Perizinan.tambah',compact('Seksi'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'nama_izin' => 'required',
            'role_id' => 'required',
        ]);

        // $date = date("his");
        // $extension = $request->file('gambar1')->extension();
        // $file_name = "Perizinan_$date.$extension";
        // $path = $request->file('gambar1')->storeAs('public/Perizinan', $file_name);
        // if($request->status == NULL){
        //     $status = false;
        // }else{
        //     $status = true;
        // }
        Perizinan::create([
            'nama_izin' => $request->nama_izin,
            'role_id' => $request->role_id,
        ]);
        return back();
    }
    public function show($Perizinan)
    {
      
    }


    public function edit($id)
    {
        $Perizinan = Perizinan::find($id);
        // $kategori = Kategori::all();
        return view('admin.Perizinan.edit',compact('Perizinan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_izin' => 'required',
            'role_id' => 'required',
        ]);

        $Perizinan = Perizinan::findOrFail($id);
        $Perizinan->nama_izin = $request->nama_izin;
        $Perizinan->role_id = $request->role_id;
        $Perizinan->save();

        return redirect()->route('Perizinan.index')
        ->with('edit', 'Perizinan Berhasil Diedit');
    }

    public function destroy($id)
    {
        Perizinan::where('id',$id)->delete();
        return back()
            ->with('delete', 'Perizinan Berhasil Dihapus');
    }
}
