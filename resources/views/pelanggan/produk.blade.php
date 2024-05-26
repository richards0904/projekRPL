@extends('layout.masterpel')
@section('content')
    <section class="menuProduk">
        <div class="container">
            <h2 class="text-center">Eksplor Menu</h2>
            @foreach ($st as $item)
                <div class="menuProduk-box">
                    <div class="menuProduk-img">
                        <img src="{{ asset('uploads/' . $item->image) }}" alt="{{ $item->deskripsi }}" class="img-responsive">,
                    </div>
                    <div class="menuProduk-desc">
                        <h4>{{ $item->jenisAyam }}</h4>
                        <p class="hargaProduk">{{ $item->formatRupiah('hargajual') }}</p>
                        <p class="detailProduk">{{ $item->deskripsi }}</p>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#beli{{ $item->idAyam }}">
                            Beli
                        </button>
                    </div>
                </div>
            @endforeach
            {{-- {{-- <div class="menuProduk-box">
                <div class="menuProduk-img">
                    <img src="{{ asset('image/anakayam.jpg') }}" alt="anakayam2month" class="img-responsive">
                </div>
                <div class="menuProduk-desc">
                    <h4>Anak Ayam</h4>
                    <p class="hargaProduk">Rp. 75.000/kotak</p>
                    <p class="detailProduk">Anak Ayam pada opsi ini berusia 2 bulan</p>
                    <br>

                    <a href="#" class="btn btn-primary">Beli</a>
                </div>
            </div>
            <div class="menuProduk-box">
                <div class="menuProduk-img">
                    <img src="{{ asset('image/anakayam.jpg') }}" alt="anakayam2month" class="img-responsive">
                </div>
                <div class="menuProduk-desc">
                    <h4>Anak Ayam</h4>
                    <p class="hargaProduk">Rp. 100.000/kotak</p>
                    <p class="detailProduk">Anak Ayam pada opsi ini berusia 2 bulan</p>
                    <br>

                    <a href="#" class="btn btn-primary">Beli</a>
                </div>
            </div>

            <div class="menuProduk-box">
                <div class="menuProduk-img">
                    <img src="{{ asset('image/anakayam.jpg') }}" alt="anakayam2month" class="img-responsive">
                </div>
                <div class="menuProduk-desc">
                    <h4>Anak Ayam</h4>
                    <p class="hargaProduk">Rp. 150.000/kotak</p>
                    <p class="detailProduk">Anak Ayam pada opsi ini berusia 2 bulan</p>
                    <br>
                    <a href="#" class="btn btn-primary">Beli</a>
                </div>
            </div> --}}
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- menu produk Selesai -->
@endsection
@foreach ($st as $item)
    <div class="modal fade" id="beli{{ $item->idAyam }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Beli Ayam</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{ route('pelanggan.buat.pesanan') }}" method="post">
                        @csrf
                        <div class="modal-body">
                            <input type="text" name="jenisAyam" placeholder="Jenis Ayam"
                                value="{{ $item->jenisAyam }}" class="form-control" disabled>
                            <br>
                            <input type="number" name="jumlahBeli" class="form-control" placeholder="Jumlah Beli"
                                min="1" required>
                            <br>
                            <input type="hidden" name="idAyam" value="{{ $item->idAyam }}">
                            <input type="hidden" name="id" value="{{ auth()->user()->id }}">
                            <button type="submit" class="btn btn-primary" name="addnewayam">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
