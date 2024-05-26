@extends('layout.master')
@section('title','Halaman stokAyam')

@section('content')

<div class="container">
    <div class="row pt-4">
        <div class="col">
            <h2>Form Edit StokAyam</h2>
            @if (session()->has('info'))
                <div class="alert alert-success"> {{ session()->get('info') }}</div>
            @endif

            <form method="post" action="{{ route('stokAyam.update',['stokAyam' => $stokAyam->id])}}">
                {{ csrf_field()}}
                @method('PATCH')
                <div class="form-group">
                    <label for="nama"></label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') ?? $stokAyam->nama }}">
                </div>

                @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                @enderror

            <button type="submit" class="btn btn-primary mt-2">Ubah</button>
            </form>
        </div>
    </div>
</div>

@endsection
