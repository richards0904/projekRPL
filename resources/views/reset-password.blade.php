<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('css/daftar.css') }}">
</head>

<body>
    <div class="container">
        <div id="LoginAndRegistrationForm">
            <h1 id="formTitle">Reset Password</h1>
            <div id="ResetPasswordForm">
                <form action="{{ route('reset.password.post') }}" method="post">
                    @csrf
                    <input type="hidden" name="token" value="{{ request()->token }}">
                    <input type="hidden" name="email" value="{{ request()->email }}">
                    <div class="center">
                        <input id="NewPassword" name="password" class="mt-10 input-text" type="password"
                            placeholder=" Password Baru">
                        @if ($errors->has('password'))
                            <span style="color: red">{{ $errors->first('password') }}</span>
                        @endif
                        <input id="ConfirmNewPassword" class="mt-10 input-text" name="password_confirmation"
                            type="password" placeholder="Konfirmasi Password">
                        @if ($errors->has('konfirmasi-password'))
                            <span style="color: red">{{ $errors->first('konfirmasi-password') }}</span>
                        @endif
                    </div>
                    <div class="center mt-20">
                        <input onclick="return ValidateResetPasswordForm();" class="Submit-Btn" type="submit"
                            value="Ubah Password" id="PasswordChangeBtn">
                    </div>
                </form>
                <p class="center mt-20 already-have-account">
                    Kembali Ke
                    <a href="/reset">Halaman Login</a>
                </p>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/validasi.js') }}" type="text/javascript"></script>
</body>

</html>
