<div class="modal-content-inner">
  <span class="close" onclick="closeModal()" style="float:right; font-size:24px; cursor:pointer;">&times;</span>

  <h2>お問い合わせ詳細</h2>
  <p><strong>お名前:</strong> {{ $contact->first_name }} {{ $contact->last_name }}</p>
  <p><strong>性別:</strong> {{ $contact->gender }}</p>
  <p><strong>メール:</strong> {{ $contact->email }}</p>
  <p><strong>電話番号:</strong> {{ $contact->tel }}</p>
  <p><strong>住所:</strong> {{ $contact->address }}</p>
  <p><strong>建物名:</strong> {{ $contact->building }}</p>
  <p><strong>お問い合わせの種類:</strong> {{ $contact->category->name ?? '未分類' }}</p>
  <p><strong>内容:</strong> {{ $contact->message }}</p>
</div>
