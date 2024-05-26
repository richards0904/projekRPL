<?php

namespace App\Http\Controllers;

use App\Models\PakanKeluar;
use App\Models\StokPakan;
use Illuminate\Http\Request;

class PakanKeluarController extends Controller
{
    public function index()
    {
        $stokPakanKeluar = PakanKeluar::select('*')
            ->join('stok_pakans', 'pakan_keluars.idPakan', '=', 'stok_pakans.idPakan')
            ->get();
        $stokPakan = StokPakan::select('*')
            ->get();
        return view('pakanKeluar', compact('stokPakanKeluar', 'stokPakan'));
    }
    public function inputPakanKeluar(Request $request)
    {
        $request->validate(
            [
                'idPakan' => 'required'
            ],
            [
                'idPakan.required' => 'Nilai merek pakan tidak boleh kosong. Silahkan input data dalam Stok Pakan terlebih dahulu.'
            ]
        );
        $stokAwal = StokPakan::where('idPakan', $request->idPakan)
            ->first();
        $stokKeluar = $request->qtyKeluar;
        $stokAkhir = $stokAwal->stokPakan - $stokKeluar;
        if ($stokAkhir < 0) {
            return redirect()->route('pakan.keluar')->with('pesan', 'Data gagal dibuat!!! Stok Pakan tidak mencukupi, silahkan tambah stok terlebih dahulu atau sesuaikan dengan stok yang tersedia');
        } else {
            $editStok = StokPakan::where('idPakan', $request->idPakan)
                ->update([
                    'stokPakan' => $stokAkhir,
                ]);
            PakanKeluar::create([
                'idPakan' => $request->idPakan,
                'pemakai' => $request->pemakai,
                'qtyKeluar' => $request->qtyKeluar
            ]);
            return redirect()->route('pakan.keluar');
        }
    }
    public function editPakanKeluar(Request $request)
    {
        $stokAwal = StokPakan::where('idPakan', $request->idPakan)
            ->first();
        $stokLomEdit = PakanKeluar::where('idPakanKeluar', $request->idPakanKeluar)
            ->first();
        $stokEdit = $request->qtyKeluar;
        if ($stokEdit >= $stokLomEdit->qtyKeluar) {
            $selisihStok = $stokEdit - $stokLomEdit->qtyKeluar;
            $stokAkhir = $stokAwal->stokPakan - $selisihStok;
            if ($stokAkhir < 0) {
                return redirect()->route('pakan.keluar')->with('pesan', 'Data gagal dibuat!!! Stok Pakan tidak mencukupi, silahkan tambah stok terlebih dahulu atau sesuaikan dengan stok yang tersedia');
            }
        } else if ($stokEdit < $stokLomEdit->qtyKeluar) {
            $selisihStok = $stokLomEdit->qtyKeluar - $stokEdit;
            $stokAkhir = $stokAwal->stokPakan + $selisihStok;
        }
        $editStokMasuk = StokPakan::where('idPakan', $request->idPakan)
            ->update([
                'stokPakan' => $stokAkhir
            ]);
        $editAyamMasuk = PakanKeluar::where('idPakanKeluar', $request->idPakanKeluar)
            ->update([
                'qtyKeluar' => $request->qtyKeluar,
                'pemakai' => $request->pemakai,
            ]);
        return redirect()->route('pakan.keluar');
    }
    public function hapusPakanKeluar(Request $request)
    {
        $stokAwal = StokPakan::where('idPakan', $request->idPakan)
            ->first();
        $stokKeluar = PakanKeluar::where('idPakan', $request->idPakan)
            ->where('idPakanKeluar', $request->idPakanKeluar)
            ->first();
        $stokAkhir = $stokAwal->stokPakan + $stokKeluar->qtyKeluar;
        $editStok = StokPakan::where('idPakan', $request->idPakan)
            ->update([
                'stokPakan' => $stokAkhir,
            ]);
        $editAyamKeluar = PakanKeluar::where('idPakanKeluar', $request->idPakanKeluar)
            ->delete();
        return redirect()->route('pakan.keluar');
    }
}
