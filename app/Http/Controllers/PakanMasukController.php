<?php

namespace App\Http\Controllers;

use App\Models\PakanMasuk;
use App\Models\StokPakan;
use Illuminate\Http\Request;

class PakanMasukController extends Controller
{
    public function index()
    {
        $stokPakanMasuk = PakanMasuk::select('*')
            ->join('stok_pakans', 'pakan_masuks.idPakan', '=', 'stok_pakans.idPakan')
            ->get();
        $stokPakan = StokPakan::select('*')
            ->get();
        return view('pakanMasuk', compact('stokPakanMasuk', 'stokPakan'));
    }
    public function inputPakanMasuk(Request $request)
    {
        $request->validate(
            [
                'idPakan' => 'required'
            ],
            [
                'idPakan.required' => 'Merek Ayam Value can not be empty. Please input data in Stok Pakan Table first Nilai merek pakan tidak boleh kosong. Silahkan masukan data dalam Stok Pakan terlebih dahulu '
            ]
        );

        PakanMasuk::create([
            'idPakan' => $request->idPakan,
            'penerima' => $request->penerima,
            'qtyMasuk' => $request->qtyMasuk
        ]);
        $stokAwal = StokPakan::where('idPakan', $request->idPakan)
            ->first();
        $stokMasuk = $request->qtyMasuk;
        $stokAkhir = $stokAwal->stokPakan + $stokMasuk;
        $editStok = StokPakan::where('idPakan', $request->idPakan)
            ->update([
                'stokPakan' => $stokAkhir,
            ]);
        return redirect()->route('pakan.masuk');
    }
    public function editPakanMasuk(Request $request)
    {
        $stokAwal = StokPakan::where('idPakan', $request->idPakan)
            ->first();
        $stokLomEdit = PakanMasuk::where('idPakanMasuk', $request->idPakanMasuk)
            ->first();
        $stokEdit = $request->qtyMasuk;
        if ($stokEdit >= $stokLomEdit->qtyMasuk) {
            $selisihStok = $stokEdit - $stokLomEdit->qtyMasuk;
            $stokAkhir = $stokAwal->stokPakan + $selisihStok;
        } else if ($stokEdit < $stokLomEdit->qtyMasuk) {
            $selisihStok = $stokLomEdit->qtyMasuk - $stokEdit;
            $stokAkhir = $stokAwal->stokPakan - $selisihStok;
        }
        $editStokMasuk = StokPakan::where('idPakan', $request->idPakan)
            ->update([
                'stokPakan' => $stokAkhir
            ]);
        $editAyamMasuk = PakanMasuk::where('idPakanMasuk', $request->idPakanMasuk)
            ->update([
                'qtyMasuk' => $request->qtyMasuk,
                'penerima' => $request->penerima,
            ]);
        return redirect()->route('pakan.masuk');
    }
    public function hapusPakanMasuk(Request $request)
    {
        $stokAwal = StokPakan::where('idPakan', $request->idPakan)
            ->first();
        $stokMasuk = PakanMasuk::where('idPakan', $request->idPakan)
            ->where('idPakanMasuk', $request->idPakanMasuk)
            ->first();
        $stokAkhir = $stokAwal->stokPakan - $stokMasuk->qtyMasuk;
        if ($stokAkhir < 0) {
            return redirect()->route('pakan.masuk')->with('pesan', 'Data gagal dihapus!!! Stok Pakan akan menjadi negatif jika dihapus.');
        } else {
            $editStok = StokPakan::where('idPakan', $request->idPakan)
                ->update([
                    'stokPakan' => $stokAkhir,
                ]);
            $editAyamMasuk = PakanMasuk::where('idPakanMasuk', $request->idPakanMasuk)
                ->delete();
            return redirect()->route('pakan.masuk');
        }
    }
}
