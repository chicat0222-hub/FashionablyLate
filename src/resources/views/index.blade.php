<div class="container">
    <h1 class="text-center my-4">FashionablyLate</h1>
    <h3 class="text-center mb-4">Contact</h3>
    <link rel="stylesheet" href="css/index.css">

    <form action="{{ route('contact.confirm') }}" method="POST">
        @csrf

        {{-- お名前 --}}
        <div class="form-group row mb-3">
            <label class="col-sm-2 col-form-label">お名前 <span class="text-danger">※</span></label>
            @if($errors->has('first_name'))
            <p class="text-danger small mt-1">名前を入力してください</p>
            @endif
            <div class="col-sm-5">
                <input type="text" name="last_name" class="form-control" placeholder="例: 山田" value="{{ old('last_name') }}">
                @if($errors->has('last_name'))
                    <p class="text-danger small mt-1">姓を入力してください</p>
                @endif
            </div>
            <div class="col-sm-5">
                <input type="text" name="first_name" class="form-control" placeholder="例: 太郎" value="{{ old('first_name') }}">

            </div>
        </div>

        {{-- 性別 --}}
        <div class="form-group row mb-3">
            <label class="col-sm-2 col-form-label">性別 <span class="text-danger">※</span></label>
            @if($errors->has('gender'))
                <p class="text-danger small mt-1">性別を選択してください</p>
            @endif
            <div class="col-sm-10 d-flex align-items-center">
                <label class="mr-3">
                    <input type="radio" name="gender" value="男性" {{ old('gender')=='男性' ? 'checked' : '' }}> 男性
                </label>
                <label class="mr-3">
                    <input type="radio" name="gender" value="女性" {{ old('gender')=='女性' ? 'checked' : '' }}> 女性
                </label>
                <label>
                    <input type="radio" name="gender" value="その他" {{ old('gender')=='その他' ? 'checked' : '' }}> その他
                </label>
            </div>
        </div>

        {{-- メールアドレス --}}
        <div class="form-group row mb-3">
            <label class="col-sm-2 col-form-label">メールアドレス <span class="text-danger">※</span></label>
            @if($errors->has('email'))
                    <p class="text-danger small mt-1">メールアドレスを入力してください</p>
                @endif
            <div class="col-sm-10">
                <input type="email" name="email" class="form-control" placeholder="例: test@example.com" value="{{ old('email') }}">

            </div>
        </div>

        {{-- 電話番号 --}}
        <div class="form-group row mb-3">
            <label class="col-sm-2 col-form-label">電話番号 <span class="text-danger">※</span></label>
            @if($errors->has('tel1'))
                <p class="text-danger small mt-1">電話番号を入力してください</p>
            @endif
            <div class="col-sm-10 d-flex">
                <input type="text" name="tel1" class="form-control w-25 mr-2" placeholder="例: 080" value="{{ old('tel1') }}">
                <input type="text" name="tel2" class="form-control w-25 mr-2" placeholder="1234" value="{{ old('tel2') }}">
                <input type="text" name="tel3" class="form-control w-25" placeholder="5678" value="{{ old('tel3') }}">
            </div>
        </div>

        {{-- 住所 --}}
        <div class="form-group row mb-3">
            <label class="col-sm-2 col-form-label">住所 <span class="text-danger">※</span></label>
            @if($errors->has('address'))
                    <p class="text-danger small mt-1">住所を入力してください</p>
                @endif
            <div class="col-sm-10">
                <input type="text" name="address" class="form-control" placeholder="例: 東京都渋谷区○○ 1-2-3" value="{{ old('address') }}">

            </div>
        </div>

        {{-- 建物名 --}}
        <div class="form-group row mb-3">
            <label class="col-sm-2 col-form-label">建物名</label>
            <div class="col-sm-10">
                <input type="text" name="building" class="form-control" placeholder="例: 千代田ビルディング 2F" value="{{ old('building') }}">
            </div>
        </div>

        {{-- お問い合わせの種類 --}}
        <div class="form-group row mb-3">
            <label class="col-sm-2 col-form-label">お問い合わせの種類 <span class="text-danger">※</span></label>
            @if($errors->has('category'))
                    <p class="text-danger small mt-1">お問い合わせの種類を選択してください</p>
                @endif
            <div class="col-sm-10">
                <select name="category" class="form-control">
                    <option value="">選択してください</option>
                    <option value="order" {{ old('category')=='order' ? 'selected' : '' }}>注文について</option>
                    <option value="product" {{ old('category')=='product' ? 'selected' : '' }}>商品について</option>
                    <option value="support" {{ old('category')=='support' ? 'selected' : '' }}>サポートについて</option>
                    <option value="other" {{ old('category')=='other' ? 'selected' : '' }}>その他</option>
                </select>

            </div>
        </div>

        {{-- お問い合わせ内容 --}}
        <div class="form-group row mb-3">
            <label class="col-sm-2 col-form-label">お問い合わせ内容 <span class="text-danger">※</span></label>
            @if($errors->has('message'))
                    <p class="text-danger small mt-1">お問い合わせ内容を入力してください</p>
                @endif
            <div class="col-sm-10">
            <textarea name="message" class="form-control" rows="4" maxlength="120" placeholder="お問い合わせ内容を入力してください">{{ old('message') }}</textarea>
            </div>
        </div>

        <div class="text-center mb-4">
            <button type="submit" class="btn btn-dark px-5">確認画面へ</button>
        </div>
    </form>
</div>
