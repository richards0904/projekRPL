<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
</head>
<body>
  <div class="container">
    <h1 class="center-word">Halaman Login</h1>
    <form method="post">
      <label for="email">Email</label>
      <input class="input-login" type="email" name="email" placeholder="Masukan Email">
      <label for="password">Password</label>
      <input class="input-login" type="email" name="password" placeholder="Masukan Password">
      <input type="submit" name="login" value="Login">
    </form>
    <p class="link-form">Belum Daftar? <a href="#">Sign in</a></p>
    <p class="lupa"><a href="#">Lupa Password?</a></p>
  </div>
</body>
</html>