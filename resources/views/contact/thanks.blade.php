<x-app-layout>
    <div class="max-w-2xl mx-auto py-16 px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-white shadow-md rounded-lg p-8">
            <h1 class="text-2xl font-bold text-green-600 mb-4">送信ありがとうございました！</h1>
            <p class="text-gray-700 text-base mb-6">
                お問い合わせ内容を受け付けました。<br>
                ご入力いただいたメールアドレス宛に、確認メールをお送りしています。
            </p>

            <a href="{{ route('contact.show') }}"
               class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700">
                フォームに戻る
            </a>
        </div>
    </div>
</x-app-layout>
