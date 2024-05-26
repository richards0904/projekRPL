<?php

namespace App\Http\Controllers;

use App\Models\AyamMasuk;
use App\Models\StokAyam;
use Illuminate\Http\Request;

class AyamMasukController extends Controller
{
    public function index()
    {
        $stokAyamMasuk = AyamMasuk::select('*')
            ->join('stok_ayams', 'ayam_masuks.idAyam', '=', 'stok_ayams.idAyam')
            ->get();
        $stokAyam = StokAyam::select('*')
            ->get();
        return view('masuk', compact('stokAyamMasuk', 'stokAyam'));
    }
    public function inputAyamMasuk(Request $request)
    {
        $request->validate(
            [
                'idAyam' => 'required'
            ],
            [
                'idAyam.required' => 'Nilai jenis ayam tidak boleh kosong. Silahkan masukan data dalam Stok Ayam terlebih dahulu'
            ]
        );

        AyamMasuk::create([
            'idAyam' => $request->idAyam,
            'penerima' => $request->penerima,
            'qtyMasuk' => $request->qtyMasuk
        ]);
        $stokAwal = StokAyam::where('idAyam', $request->idAyam)
            ->first();
        $stokMasuk = $request->qtyMasuk;
        $stokAkhir = $stokAwal->stok + $stokMasuk;
        $editStok = StokAyam::where('idAyam', $request->idAyam)
            ->update([
                'stok' => $stokAkhir,
            ]);
        return redirect()->route('ayam.masuk');
    }
    public function editAyamMasuk(Request $request)
    {
        $stokAwal = StokAyam::where('idAyam', $request->idAyam)
            ->first();
        $stokLomEdit = AyamMasuk::where('idAyamMasuk', $request->idAyamMasuk)
            ->first();
        $stokEdit = $request->qtyMasuk;
        if ($stokEdit >= $stokLomEdit->qtyMasuk) {
            $selisihStok = $stokEdit - $stokLomEdit->qtyMasuk;
            $stokAkhir = $stokAwal->stok + $selisihStok;
        } else if ($stokEdit < $stokLomEdit->qtyMasuk) {
            $selisihStok = $stokLomEdit->qtyMasuk - $stokEdit;
            $stokAkhir = $stokAwal->stok - $selisihStok;
        }
        $editStokMasuk = StokAyam::where('idAyam', $request->idAyam)
            ->update([
                'stok' => $stokAkhir
            ]);
        $editAyamMasuk = AyamMasuk::where('idAyamMasuk', $request->idAyamMasuk)
            ->update([
                'qtyMasuk' => $request->qtyMasuk,
                'penerima' => $request->penerima,
            ]);
        return redirect()->route('ayam.masuk');
    }
    public function hapusAyamMasuk(Request $request)
    {
        $stokAwal = StokAyam::where('idAyam', $request->idAyam)
            ->first();
        $stokMasuk = AyamMasuk::where('idAyam', $request->idAyam)
            ->where('idAyamMasuk', $request->idAyamMasuk)
            ->first();
        $stokAkhir = $stokAwal->stok - $stokMasuk->qtyMasuk;
        if ($stokAkhir < 0) {
            return redirect()->route('ayam.masuk')->with('pesan', 'Data gagal dihapus!!! Stok Ayam akan menjadi negatif jika dihapus.');
        } else {
            $editStok = StokAyam::where('idAyam', $request->idAyam)
                ->update([
                    'stok' => $stokAkhir,
                ]);
            $editAyamMasuk = AyamMasuk::where('idAyamMasuk', $request->idAyamMasuk)
                ->delete();
            return redirect()->route('ayam.masuk');
        }
    }
}
