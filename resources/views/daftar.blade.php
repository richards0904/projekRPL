<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login & Registration</title>
    <link rel="stylesheet" href="{{ asset('css/daftar.css') }}">
</head>

<body>
    <div class="container">
        <div id="LoginAndRegistrationForm">
            <h1 id="formTitle">Login</h1>
            <div id="formSwitchBtn">
                <button onclick="ShowLoginForm()" id="ShowLoginBtn" class="active">Login</button>
                <button onclick="ShowRegistrationForm()" id="ShowRegistrationBtn">Sign Up</button>
            </div>
            <div id="LoginFrom">
                @if ($errors->any())
                    <div style="color: red; border-radius: 10px">
                        <ul>
                            @foreach ($errors->all() as $item)
                                <li style="list-style-type: none">{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="" method="POST">
                    @csrf
                    <div class="center">
                        <input name="email" id="LoginEmail" class="input-text" type="email"
                            value="{{ old('email') }}" placeholder="Alamat Email">
                        <input name="password" id="LoginPassword" class="mt-10 input-text" type="password"
                            placeholder="Password">
                    </div>

                    <div class="forgot-pass-remember-me mt-10">
                        <div class="forgot-pass">
                            <a id="ForgotPassword" href="JavaScript:void(0);" onclick="ShowForgotPasswordForm()">Lupa
                                Password?</a>
                        </div>
                        <div class="remember-me">
                            <input id="rememberMe" type="checkbox">
                            <label for="rememberMe">Ingat Saya</label>
                        </div>
                    </div>

                    <div class="center mt-20">
                        <input onclick="return ValidateLoginForm();" class="Submit-Btn" type="submit" value="Login"
                            id="LoginBtn">
                    </div>
                </form>
                <p class="center mt-20 dont-have-account">
                    Belum Punya Akun?
                    <a href="JavaScript:void(0);" onclick="ShowRegistrationForm()">Daftar Disini!!</a>
                </p>
            </div>
            <div id="RegistrationFrom">
                <form action="/register" method="POST">
                    @csrf
                    <div class="center">
                        <input id="RegiName" name="namalengkap" class="input-text" type="text"
                            placeholder="Nama Lengkap">
                        <input id="RegiEmailAddres" name="emailbaru" class="input-text mt-10" type="email"
                            placeholder="Alamat Email">
                        <input id="RegiPassword" name="passwordbaru" class="mt-10 input-text" type="password"
                            placeholder="Password">
                        <input id="RegiConfirmPassword" class="mt-10 input-text" type="password"
                            placeholder="Konfirmasi Password">
                    </div>
                    <div class="center mt-20">
                        <input onclick="return ValidateRegistrationForm();" class="Submit-Btn" type="submit"
                            value="Registration" id="RegistrationitBtn">
                    </div>
                </form>
                <p class="center mt-20 already-have-account">
                    Sudah Punya Akun?
                    <a href="#" onclick="ShowLoginForm()">Login Sekarang</a>
                </p>
            </div>
            <div id="ForgotPasswordForm">
                @if (Session::has('message'))
                    <div style="color:green" role="alert">
                        {{ Session::get('message') }}
                    </div>
                @endif
                <form action="{{ route('forget.password.post') }}" method="POST">
                    @csrf
                    <div class="center mt-20">
                        <input class="input-text" name="email" type="email" id="forgotPassEmail"
                            placeholder="Alamat Email">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="center mt-20">
                        <input onclick="return ValidateForgotPasswordForm();" class="Submit-Btn" type="submit"
                            value="Ganti Password" id="PasswordResetBtn">
                    </div>
                </form>
                <p class="center mt-20 already-have-account">
                    Kembali ke
                    <a href="JavaScript:void(0);" onclick="ShowLoginForm()">Halaman Login</a> | <a
                        href="JavaScript:void(0);" onclick="ShowRegistrationForm()">Halaman Sign Up</a>
                </p>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/form.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/validasi.js') }}" type="text/javascript"></script>
</body>

</html>
