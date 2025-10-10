<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>FashionablyLate - Login</title>
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
  <header>
    <h1>FashionablyLate</h1>
    <nav>
      <a href="{{ route('register') }}">register</a>
    </nav>
  </header>
  <h2>Login</h2>
  <main>


    <form method="POST" action="{{ route('login.post') }}" class="form-box">
      @csrf

    <label for="email">メールアドレス</label>
    <input type="email" name="email" value="{{ old('email') }}">
    @error('email')
        <div class="error">{{ $message }}</div>
    @enderror

    <label for="password">パスワード</label>
    <input type="password" name="password">
    @error('password')
        <div class="error">{{ $message }}</div>
    @enderror


      <button type="submit">ログイン</button>

    </form>
  </main>
</body>
</html>
