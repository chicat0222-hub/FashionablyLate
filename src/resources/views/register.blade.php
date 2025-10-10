<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>FashionablyLate - Register</title>
  <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
  <header>
    <h1>FashionablyLate</h1>
    <nav>
      <a href="{{ route('login') }}">login</a>
    </nav>
  </header>
  <h2>Register</h2>
  <main>

    <form method="POST" action="{{ route('register') }}">
    @csrf

    <label for="name">お名前</label>
    <input type="text" name="name" value="{{ old('name') }}">
    @error('name')
        <div class="error">{{ $message }}</div>
    @enderror

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

    <button type="submit">登録</button>
</form>

  </main>
</body>
</html>
