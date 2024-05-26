<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPAY</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/pelanggan.css') }}" />

</head>

<body>
    <!-- Navbar Mulai -->
    <section class="navbar1">
        <div class="container">
            <div class="logo">
                <a href="{{ route('pelanggan.home') }}"><img src="{{ asset('image/logo.png') }}" alt="SPAY Logo"
                        class="img-responsive"></a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="{{ route('pelanggan.home') }}">Beranda</a>
                    </li>
                    <li>
                        <a href="tentang">Tentang</a>
                    </li>
                    <li>
                        <a href="{{ route('pelanggan.produk') }}">Produk</a>
                    </li>
                    <li>
                        <a href="kontak">Kontak</a>
                    </li>
                    <li>
                        <a href="{{ route('pelanggan.pesanan') }}">Pesanan</a>
                    </li>
                    <li>
                        <a href="logout">Logout</a>
                    </li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </section>
    @yield('content')
    <!-- footer mulai -->
    <section class="footer">
        <div class="container">
            <p class="text-center"> &copy;Copyright 2023 <br> Kelompok 7 - Rekayasa Perangkat Lunak</p>
        </div>
    </section>
    <!-- footer Selesai -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        < script src = "{{ asset('js/main.js') }}" >
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>


    </script>
</body>

</html>
