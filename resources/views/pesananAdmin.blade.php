@extends('layout.master')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Pesanan</h1>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <!-- Button to Open the Modal -->
                </div>
                <div class="card-body">
                    @if (session()->has('msg'))
                        <span class="text-danger">{{ session()->get('msg') }}</span>
                    @endif
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Tanggal Pesan</th>
                                <th>ID Pesanan</th>
                                <th>Nama Pesanan</th>
                                <th>Jenis Ayam</th>
                                <th>Jumlah Beli</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Cara menampilkan data di database ke dalam website -->
                            @foreach ($pesananAll as $pesan)
                                <tr>
                                    <td>{{ $pesan->tglPesan }}</td>
                                    <td>{{ $pesan->idPesanan }}</td>
                                    <td>{{ $pesan->namalengkap }}</td>
                                    <td>{{ $pesan->jenisAyam }}</td>
                                    <td>{{ $pesan->jumlahBeli }}</td>
                                    <td>{{ $pesan->formatRupiah('total') }}</td>
                                    <td>{{ $pesan->status }}</td>
                                    <td>
                                        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                            data-bs-target="#konfirmasi{{ $pesan->idPesanan }}" <?php if (($pesan->status == 'Dikonfirmasi') || ($pesan->status == 'Dibatalkan')){ ?> disabled
                                            <?php   } ?>>
                                            Konfirmasi
                                        </button>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $pesan->idPesanan }}" <?php if (($pesan->status == 'Dikonfirmasi') || ($pesan->status == 'Dibatalkan')){ ?> disabled
                                            <?php   } ?>>
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $pesan->idPesanan }}" <?php if (($pesan->status == 'Dikonfirmasi') || ($pesan->status == 'Dibatalkan')){ ?> disabled
                                            <?php   } ?>>
                                            Batal
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- The Edit Modal -->
                            @foreach ($pesananAll as $pesan)
                                <div class="modal fade" id="edit{{ $pesan->idPesanan }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Edit Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Data</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Edit Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('ubah.pesanan.admin') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="text" name="displayjenisAyam"
                                                            value="{{ $pesan->jenisAyam }}" class="form-control" disabled>
                                                        <br>
                                                        <input type="text" name="displaynama"
                                                            value="{{ $pesan->namalengkap }}" class="form-control"
                                                            disabled>
                                                        <br>
                                                        <input type="number" name="editJumlahBeli"
                                                            value="{{ $pesan->jumlahBeli }}" class="form-control" required>
                                                        <br>
                                                        <input type="hidden" name="idPesanan"
                                                            value="{{ $pesan->idPesanan }}">
                                                        <button type="submit" class="btn btn-primary"
                                                            name="editPesanan">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- The Delete Modal -->
                            @foreach ($pesananAll as $pesan)
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
                                                <form method="post" action="{{ route('batal.pesanan.admin') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin memnbatalkan Pesanan? Pesanan tidak dapat
                                                            diubah lagi setelah dibatalkan.
                                                        </p>
                                                        <input type="hidden" name="idPesanan"
                                                            value="{{ $pesan->idPesanan }}">
                                                        <button a type="submit" class="btn btn-danger"
                                                            name="hapuspesananAll">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- The Konfirmasi Modal -->
                            @foreach ($pesananAll as $pesan)
                                <div class="modal fade" id="konfirmasi{{ $pesan->idPesanan }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Konfirmasi Pesanan</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form action="{{ route('konfirmasi.pesanan.admin') }}" method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin mengkonfirmasi Pesanan ini ? Pesanan
                                                            tidak dapat diubah lagi setelah dikonfirmasi.</p>
                                                        <input type="hidden" name="idAyam" value="{{ $pesan->idAyam }}">
                                                        <input type="hidden" name="idPesanan"
                                                            value="{{ $pesan->idPesanan }}">
                                                        <button a type="submit" class="btn btn-success"
                                                            name="konfirmasipesananAll">Konfirmasi</button>
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
