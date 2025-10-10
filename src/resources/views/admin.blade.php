<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<h1>FashionablyLate</h1>
<hr class="title-line">
<h2>Admin</h2>
<link rel="stylesheet" href="css/admin.css">

<form method="GET" action="{{ route('admin') }}" class="filter-box">
    <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ request('keyword') }}">
    <select name="gender">
    <option value="" {{ request('gender') == '' ? 'selected' : '' }}>性別</option>
    <option value="男性" {{ request('gender') == '男性' ? 'selected' : '' }}>男性</option>
    <option value="女性" {{ request('gender') == '女性' ? 'selected' : '' }}>女性</option>
    <option value="その他" {{ request('gender') == 'その他' ? 'selected' : '' }}>その他</option>
</select>

<select name="category_id" class="form-control">
    <option value="">全て</option>
    @foreach ($categories as $category)
        <option value="{{ $category->id }}"
            {{ request('category_id') == $category->id ? 'selected' : '' }}>
            {{ $category->content }}
        </option>
    @endforeach
</select>



    <input type="date" name="date" value="{{ request('date') }}">

    <button type="submit" class="search">検索</button>
    <a href="{{ route('admin') }}" class="reset">リセット</a>
    <a href="{{ route('admin.export', request()->query()) }}" class="export-btn ml-auto">エクスポート</a>
</form>

<div class="pagination-wrapper">
    {{ $contacts->links('pagination::bootstrap-4') }}
</div>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>お名前</th>
            <th>性別</th>
            <th>メールアドレス</th>
            <th>お問い合わせの種類</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($contacts as $contact)
        <tr>
            <td>{{ $contact->last_name }}{{ $contact->first_name }}</td>
            <td>{{ $contact->gender_text }}</td>
            <td>{{ $contact->email }}</td>
            <td>{{ $contact->category->content ?? '未分類' }}</td>
            <td>
            <button class="detail-btn" data-bs-toggle="modal" data-bs-target="#detailModal{{ $contact->id }}">
            詳細
            </button>

            </td>
        <tr>
<!-- モーダル本体 -->
<div class="modal fade" id="detailModal{{ $contact->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">FashionablyLate</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>お名前：</strong> {{ $contact->name }} {{ $contact->last_name }}{{ $contact->first_name }}</td></p>
                                <p><strong>性別：</strong> {{ $contact->gender_text }}</p>
                                <p><strong>メールアドレス：</strong> {{ $contact->email }}</p>
                                <p><strong>電話番号：</strong> {{ $contact->phone }}</p>
                                <p><strong>住所：</strong> {{ $contact->address }}</p>
                                <p><strong>建物名：</strong> {{ $contact->building }}</p>
                                <p><strong>お問い合わせの種類：</strong> {{ $contact->category->content }}</p>
                                <p><strong>お問い合わせ内容：</strong> {{ $contact->message }}</p>
                            </div>
                            <div class="modal-footer">
                            <form action="{{ route('admin.delete', $contact->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">削除</button>
                            </form>


                            </div>
                        </div>
                    </div>
                </div>
                </td>
            </tr>
    @endforeach
</tbody>
</table>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> </body> </html>
