<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お問い合わせ管理システム</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen bg-gradient-to-br from-indigo-100 via-white to-indigo-50 flex items-center justify-center">

    <div class="max-w-2xl w-full px-6 py-12 bg-white shadow-2xl rounded-xl text-center">
        <h1 class="text-4xl font-extrabold text-indigo-700 mb-4">お問い合わせ管理システム</h1>
        <p class="text-gray-600 text-lg mb-8">
            お客様からのお問い合わせを<br class="sm:hidden" />スムーズに管理・対応。
        </p>

        <div class="space-y-4 sm:space-y-0 sm:space-x-4 sm:flex sm:justify-center">
            @auth
                <a href="{{ route('dashboard') }}"
                   class="inline-block px-6 py-3 bg-indigo-600 text-white text-sm font-semibold rounded-md shadow hover:bg-indigo-700 transition">
                    ダッシュボードへ
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="inline-block px-6 py-3 bg-green-600 text-white text-sm font-semibold rounded-md shadow hover:bg-green-700 transition">
                    ログイン
                </a>
                <a href="{{ route('register') }}"
                   class="inline-block px-6 py-3 bg-gray-300 text-gray-800 text-sm font-semibold rounded-md shadow hover:bg-gray-400 transition">
                    新規登録
                </a>
            @endauth

            {{-- お問い合わせリンク（ログインしていないユーザーもアクセス可） --}}
            <a href="{{ route('contact.show') }}"
               class="inline-block px-6 py-3 bg-yellow-500 text-white text-sm font-semibold rounded-md shadow hover:bg-yellow-600 transition">
                お問い合わせ
            </a>

        </div>
    </div>

</body>
</html>
