<?php

namespace App\Http\Controllers;

use App\Models\StokPakan;
use Illuminate\Http\Request;

class StokPakanController extends Controller
{
    public function index()
    {
        $stokPakan = StokPakan::all();
        return view('stokPakan', compact('stokPakan'));
    }
    public function inputStockPakan(Request $request)
    {
        $request->validate([
            'merekPakan' => 'required',
            'deskripsi' => 'required'
        ]);

        StokPakan::create([
            'merekPakan' => $request->merekPakan,
            'deskripsi' => $request->deskripsi,
            'stokPakan' => 0
        ]);
        return redirect()->route('stok.pakan');
    }

    public function editStockPakan(Request $request)
    {
        $editStok = StokPakan::where('idPakan', $request->idPakan)
            ->update([
                'merekPakan' => $request->editMerekPakan,
                'deskripsi' => $request->editDeskripsi
            ]);
        return redirect()->route('stok.pakan');
    }
    public function hapusStockPakan(Request $request)
    {
        $editStok = StokPakan::where('idPakan', $request->idPakan)
            ->delete();
        return redirect()->route('stok.pakan');
    }
}
