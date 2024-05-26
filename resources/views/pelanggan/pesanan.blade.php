@extends('layout.masterpel')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Pesanan</h1>
            </div>
            <div class="card mb-4">
                <div class="card-body">

                    {{-- <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Perhatian!!!</strong> Stok Ayam Telah Habis
                    </div> --}}

                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Tanggal Pesan</th>
                                <th>ID Pesanan</th>
                                <th>Jenis Ayam</th>
                                <th>Jumlah Beli</th>
                                <th>Harga Satuan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Cara menampilkan data di database ke dalam website -->
                            @foreach ($pesanan as $pesan)
                                <tr>
                                    <td>{{ $pesan->tglPesan }}</td>
                                    <td>{{ $pesan->idPesanan }}</td>
                                    <td>{{ $pesan->jenisAyam }}</td>
                                    <td>{{ $pesan->jumlahBeli }}</td>
                                    <td>{{ $pesan->formatRupiah('hargajual') }}</td>
                                    <td>{{ $pesan->formatRupiah('total') }}</td>
                                    <td>{{ $pesan->status }}</td>
                                    <td>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $pesan->idPesanan }} <?php if (($pesan->status == 'Dikonfirmasi') || ($pesan->status == 'Dibatalkan')){ ?> disabled
                                            <?php   } ?>">
                                            Batal
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- The Delete Modal -->
                            @foreach ($pesanan as $pesan)
                                <div class="modal fade" id="delete{{ $pesan->idPesanan }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Delete Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data?</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Delete Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('pelanggan.batal.pesanan') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin membatalkan Pesanan
                                                            {{ $pesan->jenisAyam }} ? </p>
                                                        <input type="hidden" name="idPesanan"
                                                            value="{{ $pesan->idPesanan }}">
                                                        <button a type="submit" class="btn btn-danger"
                                                            name="hapuspesanan">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    </main>
@endsection
