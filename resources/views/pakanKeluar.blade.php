@extends('layout.master')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Pakan Keluar</h1>
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
                                <th>Tanggal Keluar</th>
                                <th>Merek Pakan</th>
                                <th>Pemakai</th>
                                <th>Quantity Keluar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Cara menampilkan data di database ke dalam website -->
                            @foreach ($stokPakanKeluar as $masuk)
                                <tr>
                                    <td>{{ $masuk->tglKeluar }} </td>
                                    <td>{{ $masuk->merekPakan }}</td>
                                    <td>{{ $masuk->pemakai }}</td>
                                    <td>{{ $masuk->qtyKeluar }}</td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $masuk->idPakanKeluar }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $masuk->idPakanKeluar }}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- The Edit Modal -->
                            @foreach ($stokPakanKeluar as $masuk)
                                <div class="modal fade" id="edit{{ $masuk->idPakanKeluar }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Edit Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Data</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Edit Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('edit.pakan.keluar') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type=text value='{{ $masuk->merekPakan }}'
                                                            class='form-control' disabled>
                                                        <br>
                                                        <input type="text" name="pemakai" value="{{ $masuk->pemakai }}"
                                                            class="form-control" required>
                                                        <br>
                                                        <input type="number" name="qtyKeluar"
                                                            value="{{ $masuk->qtyKeluar }}" class="form-control" required>
                                                        <br>
                                                        <input type="hidden" name="idPakanKeluar"
                                                            value="{{ $masuk->idPakanKeluar }}">
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
                            @foreach ($stokPakanKeluar as $masuk)
                                <div class="modal fade" id="delete{{ $masuk->idPakanKeluar }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Delete Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data?</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Delete Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('hapus.pakan.keluar') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin menghapus {{ $masuk->merekPakan }} ?</p>
                                                        <input type="hidden" name="idPakanKeluar"
                                                            value="{{ $masuk->idPakanKeluar }}">
                                                        <input type="hidden" name="qtyKeluar"
                                                            value="{{ $masuk->qtykeluar }}">
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
                    <h4 class="modal-title">Tambah Pakan Keluar</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="{{ route('tambah.pakan.keluar') }}">
                        @csrf
                        <div class="modal-body">
                            <select name="idPakan" class="form-control">
                                @for ($stokPakan as $ayams)
                                    <option value="{{ $ayams->idPakan }}">{{ $ayams->merekPakan }}</option>
                                @endfor
                            </select>
                            <br>
                            <input type="number" name="qtyKeluar" class="form-control" placeholder="Quantity Keluar"
                                min="1" required>
                            <br>
                            <input type="text" name="pemakai" class="form-control" placeholder="Pemakai" required>
                            <br>
                            <button type="submit" class="btn btn-primary" name="barangmasuk">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
