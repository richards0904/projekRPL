<?php

namespace App\Http\Controllers;

use App\Models\StokAyam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StokAyamController extends Controller
{
    public function index()
    {
        $stokAyam = StokAyam::all();

        return view('index', compact('stokAyam'));
    }
    public function inputStock(Request $request)
    {
        $request->validate([
            'jenisAyam' => 'required',
            'deskripsi' => 'required',
            'hargajual' => 'required',
        ]);
        if ($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); // getting image extension
            $filename = time() . '.' . $extension;
            $file->move('uploads/', $filename);
            StokAyam::create([
                'jenisAyam' => $request->jenisAyam,
                'deskripsi' => $request->deskripsi,
                'stok' => 0,
                'hargajual' => $request->hargajual,
                'image' => $filename
            ]);
        } else {
            StokAyam::create([
                'jenisAyam' => $request->jenisAyam,
                'deskripsi' => $request->deskripsi,
                'stok' => 0,
                'hargajual' => $request->hargajual
            ]);
        }
        return redirect()->route('stok.ayam');
    }

    public function editStock(Request $request)
    {
        $editStok = StokAyam::where('idAyam', $request->idAyam)
            ->update([
                'jenisAyam' => $request->editJenisAyam,
                'deskripsi' => $request->editDeskripsi
            ]);
        return redirect()->route('stok.ayam');
    }
    public function hapusStock(Request $request)
    {
        $editStok = StokAyam::where('idAyam', $request->idAyam)
            ->delete();
        return redirect()->route('stok.ayam');
    }

    public function exportStock()
    {
        $stokAyam = StokAyam::select('*')
            ->get();
        return view('exportStock', ['stokAyam' => $stokAyam]);
    }
}
