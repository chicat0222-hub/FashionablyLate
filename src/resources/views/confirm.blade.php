<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>FashionablyLate - Confirm</title>
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
</head>
<body>
    <h1>FashionablyLate</h1>
    <h2>Confirm</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <tr>
            <th>お名前</th>
            <td>{{ $inputs['last_name'] ?? '' }} {{ $inputs['first_name'] ?? '' }}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td>{{ $inputs['gender'] }}</td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $inputs['email'] ?? '' }}</td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td>{{ $inputs['tel1'] ?? '' }}-{{ $inputs['tel2'] ?? '' }}-{{ $inputs['tel3'] ?? '' }}</td>
        </tr>
        <tr>
            <th>住所</th>
            <td>{{ $inputs['address'] ?? '' }}</td>
        </tr>
        <tr>
            <th>建物名</th>
            <td>{{ $inputs['building'] ?? '' }}</td>
        </tr>
        <tr>
            <th>お問い合わせの種類</th>
            <td>
                @switch($inputs['category'] ?? '')
                    @case('order') 注文について @break
                    @case('product') 商品について @break
                    @case('support') サポートについて @break
                    @case('other') その他 @break
                    @default -
                @endswitch
            </td>
        </tr>
        <tr>
            <th>お問い合わせ内容</th>
            <td>{{ $inputs['message'] ?? '' }}</td>
        </tr>
    </table>

    <div style="display: flex; gap: 10px; margin-top: 20px;">
        <!-- 送信ボタン（POSTフォーム） -->
        <form action="{{ route('contact.send') }}" method="POST">
    @csrf
    <input type="hidden" name="last_name" value="{{ $inputs['last_name'] }}">
    <input type="hidden" name="first_name" value="{{ $inputs['first_name'] }}">
    <input type="hidden" name="gender" value="{{ $inputs['gender'] }}">
    <input type="hidden" name="email" value="{{ $inputs['email'] }}">
    <input type="hidden" name="tel1" value="{{ $inputs['tel1'] }}">
    <input type="hidden" name="tel2" value="{{ $inputs['tel2'] }}">
    <input type="hidden" name="tel3" value="{{ $inputs['tel3'] }}">
    <input type="hidden" name="address" value="{{ $inputs['address'] }}">
    <input type="hidden" name="building" value="{{ $inputs['building'] }}">
    <input type="hidden" name="category" value="{{ $inputs['category'] }}">
    <input type="hidden" name="message" value="{{ $inputs['message'] }}">
    <button type="submit">送信</button>
</form>

        <!-- 修正ボタン -->
        <a href="{{ url('/') }}">
            <button type="button">修正</button>
        </a>
    </div>

</body>
</html>
