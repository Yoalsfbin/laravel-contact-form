<p>{{ $contactData['name'] }} 様</p>

<p>この度はお問い合わせいただき、誠にありがとうございます。</p>

<p>以下の内容でお問い合わせを受け付けました。</p>

<ul>
    <li><strong>お名前：</strong> {{ $contactData['name'] }}</li>
    <li><strong>メール：</strong> {{ $contactData['email'] }}</li>
    <li><strong>件名：</strong> {{ $contactData['subject'] }}</li>
    <li><strong>お問い合わせ内容：</strong><br>{{ $contactData['message'] }}</li>
</ul>

<p>内容を確認の上、必要に応じてご連絡させていただきます。</p>

<p>------------------------------<br>
お問い合わせシステム<br>
このメールは自動送信です</p>
