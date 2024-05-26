@extends('layout.master')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Stok Ayam</h1>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal"
                        name="tambahDataStok">
                        Tambah Data
                    </button>
                    <a href="{{ route('export.stok.ayam') }}" class="btn btn-success">Export Stok<a>
                </div>
                <div class="card-body">

                    {{-- <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Perhatian!!!</strong> Stok Ayam Telah Habis
                    </div> --}}

                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>ID Ayam</th>
                                <th>Jenis Ayam</th>
                                <th>Deskripsi</th>
                                <th>Stok Ayam</th>
                                <th>Harga Jual</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>


                            <!-- Cara menampilkan data di database ke dalam website -->
                            @foreach ($stokAyam as $ayams)
                                <tr>
                                    <td>{{ $ayams->idAyam }}</td>
                                    <td>{{ $ayams->jenisAyam }}</td>
                                    <td>{{ $ayams->deskripsi }}</td>
                                    <td>{{ $ayams->stok }}</td>
                                    <td>{{ $ayams->formatRupiah('hargajual') }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $ayams->idAyam }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $ayams->idAyam }}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- The Edit Modal -->
                            @foreach ($stokAyam as $ayams)
                                <div class="modal fade" id="edit{{ $ayams->idAyam }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Edit Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Data</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Edit Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('edit.stok.post') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="text" name="editJenisAyam"
                                                            value="{{ $ayams->jenisAyam }}" class="form-control" required>
                                                        <br>
                                                        <input type="text" name="editDeskripsi"
                                                            value="{{ $ayams->deskripsi }}" class="form-control" required>
                                                        <br>
                                                        <input type="hidden" name="idAyam" value="{{ $ayams->idAyam }}">
                                                        <button type="submit" class="btn btn-primary"
                                                            name="editStokAyam">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- The Delete Modal -->
                            @foreach ($stokAyam as $ayams)
                                <div class="modal fade" id="delete{{ $ayams->idAyam }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Delete Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data?</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Delete Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('hapus.stok.post') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin menghapus {{ $ayams->jenisAyam }} ? </p>
                                                        <input type="hidden" name="idAyam" value="{{ $ayams->idAyam }}">
                                                        <button a type="submit" class="btn btn-danger"
                                                            name="hapusStokAyam">Hapus</button>
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
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Ayam</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('tambah.stok.post') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="text" id="jenisAyam" name="jenisAyam" placeholder="Jenis Ayam"
                                class="form-control" required>
                            <br>
                            <input type="text" id="deskripsi" name="deskripsi" placeholder="Deskripsi Ayam"
                                class="form-control" required>
                            <br>
                            <input type="number" id="hargajual" name="hargajual" class="form-control"
                                placeholder="Harga Jual" min="0" required>
                            <br>
                            <input type="file" name="image" class="form-control">
                            <br>
                            <button type="submit" class="btn btn-primary" name="addnewayam">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
