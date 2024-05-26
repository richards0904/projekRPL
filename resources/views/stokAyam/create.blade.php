@extends('layout.master')
@section('title','Halaman mahasiswa')

@section('content')

<div class="container">
    <div class="row pt-4">
        <div class="col">
            <h2>Form stokAyam</h2>
            @if (session()->has('info'))
            <div class="alert alert-success"> {{ session()->get('info') }}</div>
            @endif

            <form method="post" action="{{ url('stokAyam/store')}}">
                @csrf
                <div class="form-group">
                    <label for="nama"></label>
                    <input type="text" name="nama" id="nama">
                </div>

                @error('nama')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
            </form>
        </div>
    </div>
</div>

@endsection