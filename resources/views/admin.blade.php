@extends('layout.masterown')
@section('content')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Kelola Admin</h1>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <!-- Button to Open the Modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                        Tambah Admin
                    </button>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>ID User</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- Cara menampilkan data di database ke dalam website -->
                            @foreach ($dataAdmin as $admin)
                                <tr>
                                    <td>{{ $admin->id }}</td>
                                    <td>{{ $admin->namalengkap }}</td>
                                    <td>{{ $admin->email }} </td>
                                    <td>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#edit{{ $admin->id }}">
                                            Edit
                                        </button>
                                        <input type="hidden" name="idbaranghapus" value="">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $admin->id }}">
                                            Hapus
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            <!-- The Edit Modal -->
                            @foreach ($dataAdmin as $admin)
                                <div class="modal fade" id="edit{{ $admin->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Edit Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Admin</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Edit Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('edit.kelola.admin') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <input type="text" name="namalengkap"
                                                            value="{{ $admin->namalengkap }}" class="form-control" required>
                                                        <br>
                                                        <input type="email" name="emailAdmin" value="{{ $admin->email }}"
                                                            class="form-control" required>
                                                        <br>
                                                        <input type="password" name="password" class="form-control"
                                                            placeholder="password"
                                                            pattern="^(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,32}$"
                                                            placeholder="password"
                                                            oninvalid="this.setCustomValidity('Please input password that has number and special characters minimum 8 characters and maximum 32 characters')"
                                                            oninput="this.setCustomValidity('')" required>
                                                        <br>
                                                        <input type="hidden" name="id" value="{{ $admin->id }}">
                                                        <button type="submit" class="btn btn-primary"
                                                            name="editadmin">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- The Delete Modal -->
                            @foreach ($dataAdmin as $admin)
                                <div class="modal fade" id="delete{{ $admin->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Delete Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Hapus Admin?</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Delete Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="{{ route('hapus.kelola.admin') }}">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin ingin menghapus Akun {{ $admin->namalengkap }}
                                                            ?</p>
                                                        <input type="hidden" name="id" value="{{ $admin->id }}">
                                                        <button a type="submit" class="btn btn-danger"
                                                            name="hapusadmin">Hapus</button>
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
                    <h4 class="modal-title">Tambah Admin</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form method="post" action="{{ route('tambah.kelola.admin') }}">
                        @csrf
                        <div class="modal-body">
                            <input type="text" name="namalengkap" placeholder="Nama Lengkap" class="form-control"
                                required>
                            <br>
                            <input type="email" name="emailAdmin" placeholder="Email Baru" class="form-control" required>
                            <br>
                            <input type="password" name="password"
                                pattern="^(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,32}$" placeholder="Password Baru"
                                oninvalid="this.setCustomValidity('Please input password that has number and special characters minimum 8 characters and maximum 32 characters')"
                                oninput="this.setCustomValidity('')" class="form-control" required>
                            <br>
                            <button type="submit" class="btn btn-primary" name="addnewadmin">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
