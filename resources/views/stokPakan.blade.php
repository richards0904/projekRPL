@extends('layout.master')

@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Stok Pakan</h1>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                        Tambah Data
                    </button>
                </div>
                <div class="card-body">

                    {{-- <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong>Perhatian!!!</strong> Stok Ayam Telah Habis
                    </div> --}}

                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>ID Pakan</th>
                                <th>Merek Pakan</th>
                                <th>Deskripsi</th>
                                <th>Stok Pakan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Cara menampilkan data di database ke dalam website -->
                            @foreach ($stokPakan as $ayams)
                                <tr>
                                    <td>{{ $ayams->idPakan }}</td>
                                    <td>{{ $ayams->merekPakan }}</td>
                                    <td>{{ $ayams->deskripsi }}</td>
                                    <td>{{ $ayams->stokPakan }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $ayams->idPakan }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $ayams->idPakan }}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- The Edit Modal -->
                            @foreach ($stokPakan as $ayams)
                                <div class="modal fade" id="edit{{ $ayams->idPakan }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Edit Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Data</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Edit Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('edit.stok.pakan') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="text" name="editMerekPakan"
                                                            value="{{ $ayams->merekPakan }}" class="form-control" required>
                                                        <br>
                                                        <input type="text" name="editDeskripsi"
                                                            value="{{ $ayams->deskripsi }}" class="form-control" required>
                                                        <br>
                                                        <input type="hidden" name="idPakan" value="{{ $ayams->idPakan }}">
                                                        <button type="submit" class="btn btn-primary"
                                                            name="editstokPakan">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- The Delete Modal -->
                            @foreach ($stokPakan as $ayams)
                                <div class="modal fade" id="delete{{ $ayams->idPakan }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Delete Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data?</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Delete Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('hapus.stok.pakan') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin menghapus {{ $ayams->merekPakan }} ?
                                                        </p>
                                                        <input type="hidden" name="idPakan" value="{{ $ayams->idPakan }}">
                                                        <button a type="submit" class="btn btn-danger"
                                                            name="hapusstokPakan">Hapus</button>
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
                    <h4 class="modal-title">Tambah Pakan</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('tambah.stok.pakan') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="text" name="merekPakan" placeholder="Merek Pakan" class="form-control" required>
                            <br>
                            <input type="text" name="deskripsi" placeholder="Deskripsi Pakan" class="form-control"
                                required>
                            <br>
                            <button type="submit" class="btn btn-primary" name="addnewayam">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
