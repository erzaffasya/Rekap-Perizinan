<?php

namespace App\Http\Controllers;

use App\Models\Helpdesk;
use App\Models\KategoriHelpdesk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HelpdeskController extends Controller
{
    public function index()
    {
        $KategoriHelpdesk = KategoriHelpdesk::all();
        $Helpdesk = Helpdesk::all();
        return view('admin.Helpdesk.index', compact('Helpdesk', 'KategoriHelpdesk'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        $KategoriHelpdesk = KategoriHelpdesk::all();
        return view('admin.Helpdesk.tambah', compact('KategoriHelpdesk'));
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'nama' => 'required',
        //     'no_hp' => 'required',
        //     'kategori_helpdesk_id' => 'required',
        //     'keterangan' => 'required',
        //     'ttd' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return back()->with('errors', $validator->messages()->all()[0])->withInput();
        // }

        $data_uri = $request->dataUrl;
        $encoded_image = explode(",", $data_uri)[1];
        $decoded_image = base64_decode($encoded_image);
        $folderPath = public_path('storage/ttd/');
        $filename = uniqid() . '.png';
        $file = $folderPath . $filename;
        file_put_contents($file, $decoded_image);

        if ($request->keterangan2) {
            $keterangan = $request->keterangan .' - '. $request->keterangan2;
        } else {
            $keterangan = $request->keterangan;
        }
        Helpdesk::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'kategori_helpdesk_id' => $request->kategori_helpdesk_id,
            'nama' => $request->nama,
            'keterangan' => $keterangan,
            'ttd' => $filename,
        ]);
        return response()->json(['success' => true]);
    }
    public function show($Helpdesk)
    {
    }


    public function edit($id)
    {
        $Helpdesk = Helpdesk::find($id);
        // $kategori = Kategori::all();
        return view('admin.Helpdesk.edit', compact('Helpdesk'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' => 'required',
            'kategori_helpdesk_id' => 'required',
            'keterangan' => 'required',
            'ttd' => 'required',
        ]);

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
        Helpdesk::where('id', $id)->delete();
        return back()
            ->with('delete', 'Helpdesk Berhasil Dihapus');
    }
}
