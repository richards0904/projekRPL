@extends('layout.master')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Ayam Keluar</h1>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <!-- Button to Open the Modal -->
                </div>
                <div class="card-body">
                    @if ($errors->has('idAyam'))
                        <span class="text-danger">{{ $errors->first('idAyam') }}</span>
                    @endif
                    @if (session()->has('pesan'))
                        <span class="text-danger">{{ session()->get('pesan') }}</span>
                    @endif
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Tanggal Keluar</th>
                                <th>Nama Barang</th>
                                <th>Pembeli</th>
                                <th>Quantity Keluar</th>
                                {{-- <th>Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Cara menampilkan data di database ke dalam website -->
                            @foreach ($stokAyamKeluar as $keluar)
                                <tr>
                                    <td>{{ $keluar->tglKeluar }}</td>
                                    <td>{{ $keluar->jenisAyam }}</td>
                                    <td>{{ $keluar->penjual }} </td>
                                    <td>{{ $keluar->qtyKeluar }} </td>
                                    {{-- <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $keluar->idAyamKeluar }}">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $keluar->idAyamKeluar }}">
                                            Hapus
                                        </button>
                                    </td> --}}
                                </tr>
                            @endforeach
                            {{-- <!-- The Edit Modal -->
                            @foreach ($stokAyamKeluar as $keluar)
                                <div class="modal fade" id="edit{{ $keluar->idAyamKeluar }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Edit Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Data</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Edit Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('edit.ayam.keluar') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type=text value='{{ $keluar->jenisAyam }}'
                                                            class='form-control' disabled>
                                                        <br>
                                                        <input type="text" name="penjual" value="{{ $keluar->penjual }}"
                                                            class="form-control" required>
                                                        <br>
                                                        <input type="number" name="qtyKeluar"
                                                            value="{{ $keluar->qtyKeluar }}" class="form-control" required>
                                                        <br>
                                                        <input type="hidden" name="idAyamKeluar"
                                                            value="{{ $keluar->idAyamKeluar }}">
                                                        <input type="hidden" name="idAyam" value="{{ $keluar->idAyam }}">
                                                        <button type="submit" class="btn btn-primary"
                                                            name="editkeluarbarang">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach --}}
                            {{-- <!-- The Delete Modal -->
                            @foreach ($stokAyamKeluar as $keluar)
                                <div class="modal fade" id="delete{{ $keluar->idAyamKeluar }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Delete Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Data?</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Delete Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('hapus.ayam.keluar') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin menghapus ?</p>
                                                        <input type="hidden" name="idAyamKeluar"
                                                            value="{{ $keluar->idAyamKeluar }}">
                                                        <input type="hidden" name="qtyKeluar"
                                                            value="{{ $keluar->qtyKeluar }}">
                                                        <input type="hidden" name="idAyam" value="{{ $keluar->idAyam }}">
                                                        <button type="submit" class="btn btn-danger"
                                                            name="hapuskeluarbarang">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    </main>
    {{-- <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Ayam Keluar</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="{{ route('tambah.ayam.keluar') }}">
                        @csrf
                        <div class="modal-body">
                            <select name="idAyam" class="form-control">
                                @foreach ($stokAyam as $ayams)
                                    <option value="{{ $ayams->idAyam }}">{{ $ayams->jenisAyam }}</option>
                                @endforeach
                            </select>
                            <br>
                            <input type="number" name="qtyKeluar" class="form-control" placeholder="Quantity Keluar"
                                min="1" required>
                            <br>
                            <input type="text" name="penjual" placeholder="Penjual" class="form-control" required>
                            <br>
                            <button type="submit" class="btn btn-primary" name="barangkeluar">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
