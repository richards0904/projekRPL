<?php

namespace App\Http\Controllers;

use App\Models\AyamKeluar;
use App\Models\Pesanan;
use App\Models\StokAyam;
use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index()
    {

        return view('pelanggan.pelanggan');
    }

    public function produk()
    {
        $st = StokAyam::all();
        return view('pelanggan.produk', compact('st'));
    }
    public function pesanan()
    {
        $pesanan = Pesanan::select('*')
            ->join('stok_ayams', 'pesanans.idAyam', '=', 'stok_ayams.idAyam')
            ->where('id', auth()->user()->id)
            ->get();
        return view('pelanggan.pesanan', compact('pesanan'));
    }
    public function buatPesanan(Request $request)
    {
        $hargaJual = StokAyam::where('idAyam', $request->idAyam)->first();
        $total = $hargaJual->hargajual * $request->jumlahBeli;
        Pesanan::create([
            'id' => $request->id,
            'idAyam' => $request->idAyam,
            'jumlahBeli' => $request->jumlahBeli,
            'total' => $total
        ]);
        return redirect()->route('pelanggan.produk');
    }
    public function batalPesanan(Request $request)
    {
        $batalPesanan = Pesanan::where('idPesanan', $request->idPesanan)
            ->update([
                'status' => 'Dibatalkan',
            ]);
        return redirect()->route('pelanggan.pesanan');
    }

    public function pesananAdmin()
    {
        $a = 'Dikonfirmasi';
        $b = 'Sedang Diproses';
        $pesananAll = Pesanan::select('*')
            ->join('stok_ayams', 'pesanans.idAyam', '=', 'stok_ayams.idAyam')
            ->join('users', 'pesanans.id', '=', 'users.id')
            ->where(function ($query) use ($a, $b) {
                $query->where('status', '=', $a)
                    ->orWhere('status', '=', $b);
            })
            ->get();
        return view('pesananAdmin', compact('pesananAll'));
    }

    public function konfirmasiPesanan(Request $request)
    {
        $stokAwal = StokAyam::where('idAyam', $request->idAyam)
            ->first();
        $stokKeluar = Pesanan::where('idPesanan', $request->idPesanan)
            ->join('users', 'pesanans.id', '=', 'users.id')
            ->first();
        $stokAkhir = $stokAwal->stok - $stokKeluar->jumlahBeli;
        if ($stokAkhir < 0) {
            return redirect()->route('pesanan.admin')->with('msg', 'Data gagal dibuat!!! Stok Ayam tidak mencukupi, silahkan tambah stok terlebih dahulu atau ubah jumlah beli dengan mendiskusikan kepada pelanggan');
        } else {
            $editStok = StokAyam::where('idAyam', $request->idAyam)
                ->update([
                    'stok' => $stokAkhir,
                ]);
            AyamKeluar::create([
                'idAyam' => $request->idAyam,
                'penjual' => $stokKeluar->namalengkap,
                'qtyKeluar' => $stokKeluar->jumlahBeli
            ]);
            $konfirmasiPesanan = Pesanan::where('idPesanan', $request->idPesanan)
                ->update([
                    'status' => 'Dikonfirmasi',
                ]);
            return redirect()->route('pesanan.admin');
        }
    }
    public function ubahPesanan(Request $request)
    {
        $editPesanan = Pesanan::where('idPesanan', $request->idPesanan)
            ->update([
                'jumlahBeli' => $request->editJumlahBeli
            ]);
        return redirect()->route('pesanan.admin');
    }
    public function batalPesananAdmin(Request $request)
    {
        $batalPesanan = Pesanan::where('idPesanan', $request->idPesanan)
            ->update([
                'status' => 'Dibatalkan',
            ]);
        return redirect()->route('pesanan.admin');
    }
}
