<?php

namespace App\Http\Controllers;

use App\Models\Helpdesk;
use App\Models\KategoriHelpdesk;
use Illuminate\Http\Request;

class HelpdeskController extends Controller
{
    public function index()
    {
        $KategoriHelpdesk = KategoriHelpdesk::all();
        $Helpdesk = Helpdesk::all();
        return view('admin.Helpdesk.index', compact('Helpdesk','KategoriHelpdesk'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        $KategoriHelpdesk = KategoriHelpdesk::all();
        return view('admin.Helpdesk.tambah',compact('KategoriHelpdesk'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'nama' => 'required',
        //     'no_hp' => 'required',
        //     'kategori_helpdesk_id' => 'required',
        //     'keterangan' => 'required',
        //     'ttd' => 'required',
        // ]);

        // $date = date("his");
        // $extension = $request->file('gambar1')->extension();
        // $file_name = "Helpdesk_$date.$extension";
        // $path = $request->file('gambar1')->storeAs('public/Helpdesk', $file_name);
        // if($request->status == NULL){
        //     $status = false;
        // }else{
        //     $status = true;
        // }
        Helpdesk::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'kategori_helpdesk_id' => $request->kategori_helpdesk_id,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            // 'ttd' => $ttd,
        ]);
        return back()->with('success','Data Berhasil Ditambah');
    }
    public function show($Helpdesk)
    {
      
    }


    public function edit($id)
    {
        $Helpdesk = Helpdesk::find($id);
        // $kategori = Kategori::all();
        return view('admin.Helpdesk.edit',compact('Helpdesk'));
    }

    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'nama' => 'required',
        //     'no_hp' => 'required',
        //     'kategori_helpdesk_id' => 'required',
        //     'keterangan' => 'required',
        //     'ttd' => 'required',
        // ]);

        $Helpdesk = Helpdesk::findOrFail($id);
        $Helpdesk->nama = $request->nama;
        $Helpdesk->no_hp = $request->no_hp;
        $Helpdesk->nama = $request->nama;
        $Helpdesk->kategori_helpdesk_id = $request->kategori_helpdesk_id;
        $Helpdesk->keterangan = $request->keterangan;
        // $Helpdesk->kategori_helpdesk_id = $ttd;
        $Helpdesk->save();

        return redirect()->route('Helpdesk.index')
        ->with('edit', 'Helpdesk Berhasil Diedit');
    }

    public function destroy($id)
    {
        Helpdesk::where('id',$id)->delete();
        return back()
            ->with('delete', 'Helpdesk Berhasil Dihapus');
    }
}
