<?php

namespace App\Http\Controllers;

use App\Models\AyamKeluar;
use App\Models\StokAyam;
use Illuminate\Http\Request;

class AyamKeluarController extends Controller
{
    public function index()
    {
        $stokAyamKeluar = AyamKeluar::select('*')
            ->join('stok_ayams', 'ayam_keluars.idAyam', '=', 'stok_ayams.idAyam')
            ->get();
        $stokAyam = StokAyam::select('*')
            ->get();
        return view('keluar', compact('stokAyamKeluar', 'stokAyam'));
    }
    // public function inputAyamKeluar(Request $request)
    // {
    //     $request->validate(
    //         [
    //             'idAyam' => 'required'
    //         ],
    //         [
    //             'idAyam.required' => 'Nilai jenis ayam tidak boleh kosong. Silahkan masukan data dalam Stok Ayam terlebih dahulu'
    //         ]
    //     );

    //     $stokAwal = StokAyam::where('idAyam', $request->idAyam)
    //         ->first();
    //     $stokKeluar = $request->qtyKeluar;
    //     $stokAkhir = $stokAwal->stok - $stokKeluar;
    //     if ($stokAkhir < 0) {
    //         return redirect()->route('ayam.keluar')->with('pesan', 'Data gagal dibuat!!! Stok Ayam tidak mencukupi, silahkan tambah stok terlebih dahulu atau sesuaikan dengan stok yang tersedia');
    //     } else {
    //         $editStok = StokAyam::where('idAyam', $request->idAyam)
    //             ->update([
    //                 'stok' => $stokAkhir,
    //             ]);
    //         AyamKeluar::create([
    //             'idAyam' => $request->idAyam,
    //             'penjual' => $request->penjual,
    //             'qtyKeluar' => $request->qtyKeluar
    //         ]);
    //         return redirect()->route('ayam.keluar');
    //     }
    // }
    // public function editAyamKeluar(Request $request)
    // {
    //     $stokAwal = StokAyam::where('idAyam', $request->idAyam)
    //         ->first();
    //     $stokLomEdit = AyamKeluar::where('idAyamKeluar', $request->idAyamKeluar)
    //         ->first();
    //     $stokEdit = $request->qtyKeluar;
    //     if ($stokEdit >= $stokLomEdit->qtyKeluar) {
    //         $selisihStok = $stokEdit - $stokLomEdit->qtyKeluar;
    //         $stokAkhir = $stokAwal->stok - $selisihStok;
    //         if ($stokAkhir < 0) {
    //             return redirect()->route('ayam.keluar')->with('pesan', 'Data gagal dibuat!!! Stok Pakan tidak mencukupi, silahkan tambah stok terlebih dahulu atau sesuaikan dengan stok yang tersedia');
    //         }
    //     } else if ($stokEdit < $stokLomEdit->qtyMasuk) {
    //         $selisihStok = $stokLomEdit->qtyKeluar - $stokEdit;
    //         $stokAkhir = $stokAwal->stok + $selisihStok;
    //     }
    //     $editStokMasuk = StokAyam::where('idAyam', $request->idAyam)
    //         ->update([
    //             'stok' => $stokAkhir
    //         ]);
    //     $editAyamMasuk = AyamKeluar::where('idAyamKeluar', $request->idAyamKeluar)
    //         ->update([
    //             'qtyKeluar' => $request->qtyKeluar,
    //             'penjual' => $request->penjual,
    //         ]);
    //     return redirect()->route('ayam.keluar');
    // }
    // public function hapusAyamKeluar(Request $request)
    // {
    //     $stokAwal = StokAyam::where('idAyam', $request->idAyam)
    //         ->first();
    //     $stokKeluar = AyamKeluar::where('idAyam', $request->idAyam)
    //         ->first();
    //     $stokAkhir = $stokAwal->stok + $stokKeluar->qtyKeluar;
    //     $editStok = StokAyam::where('idAyam', $request->idAyam)
    //         ->update([
    //             'stok' => $stokAkhir,
    //         ]);
    //     $editAyamKeluar = AyamKeluar::where('idAyamKeluar', $request->idAyamKeluar)
    //         ->delete();
    //     return redirect()->route('ayam.keluar');
    // }
}
