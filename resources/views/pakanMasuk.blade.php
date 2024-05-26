@extends('layout.master')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Pakan Masuk</h1>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                        Tambah Data
                    </button>
                </div>
                <div class="card-body">
                    @if ($errors->has('idPakan'))
                        <span class="text-danger">{{ $errors->first('idPakan') }}</span>
                    @endif
                    @if (session()->has('pesan'))
                        <span class="text-danger">{{ session()->get('pesan') }}</span>
                    @endif
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Tanggal Masuk</th>
                                <th>Merek Pakan</th>
                                <th>Penerima</th>
                                <th>Quantity Masuk</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Cara menampilkan data di database ke dalam website -->
                            @foreach ($stokPakanMasuk as $masuk)
                                <tr>
                                    <td>{{ $masuk->tglMasuk }} </td>
                                    <td>{{ $masuk->merekPakan }}</td>
                                    <td>{{ $masuk->penerima }}</td>
                                    <td>{{ $masuk->qtyMasuk }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $masuk->idPakanMasuk }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $masuk->idPakanMasuk }}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- The Edit Modal -->
                            @foreach ($stokPakanMasuk as $masuk)
                                <div class="modal fade" id="edit{{ $masuk->idPakanMasuk }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Edit Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Data</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Edit Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('edit.pakan.masuk') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type=text value='{{ $masuk->merekPakan }}'
                                                            class='form-control' disabled>
                                                        <br>
                                                        <input type="text" name="penerima"
                                                            value="{{ $masuk->penerima }}" class="form-control" required>
                                                        <br>
                                                        <input type="number" name="qtyMasuk"
                                                            value="{{ $masuk->qtyMasuk }}" class="form-control" required>
                                                        <br>
                                                        <input type="hidden" name="idPakanMasuk"
                                                            value="{{ $masuk->idPakanMasuk }}">
                                                        <input type="hidden" name="idPakan" value="{{ $masuk->idPakan }}">
                                                        <button type="submit" class="btn btn-primary"
                                                            name="editmasukbarang">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- The Delete Modal -->
                            @foreach ($stokPakanMasuk as $masuk)
                                <div class="modal fade" id="delete{{ $masuk->idPakanMasuk }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Delete Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data?</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Delete Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('hapus.pakan.masuk') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin menghapus {{ $masuk->merekPakan }} ?</p>
                                                        <input type="hidden" name="idPakanMasuk"
                                                            value="{{ $masuk->idPakanMasuk }}">
                                                        <input type="hidden" name="qtyMasuk"
                                                            value="{{ $masuk->qtymasuk }}">
                                                        <input type="hidden" name="idPakan" value="{{ $masuk->idPakan }}">
                                                        <button type="submit" class="btn btn-danger"
                                                            name="hapusmasukbarang">Hapus</button>
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
                    <h4 class="modal-title">Tambah Pakan Masuk</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="{{ route('tambah.pakan.masuk') }}">
                        @csrf
                        <div class="modal-body">
                            <select name="idPakan" class="form-control">
                                @foreach ($stokPakan as $ayams)
                                    <option value="{{ $ayams->idPakan }}">{{ $ayams->merekPakan }}</option>
                                @endforeach
                            </select>
                            <br>
                            <input type="number" name="qtyMasuk" class="form-control" placeholder="Quantity Masuk"
                                min="1"required>
                            <br>
                            <input type="text" name="penerima" class="form-control" placeholder="Penerima" required>
                            <br>
                            <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
