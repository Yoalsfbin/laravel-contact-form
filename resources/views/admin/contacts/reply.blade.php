@vite('resources/js/templateLoader.js')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            お問い合わせ返信
        </h2>
    </x-slot>

    <div class="py-6 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <div class="bg-white p-6 sm:p-8 shadow rounded-lg overflow-hidden">
            <h3 class="text-lg font-bold mb-4 break-words">
                件名: {{ $contact->subject }}
            </h3>

            <p class="mb-6 text-gray-700 whitespace-pre-wrap break-words leading-relaxed">内容: {{ $contact->message }}</p>

            {{-- ▼ テンプレート選択 --}}
            <div class="mb-4">
                <label for="template" class="block text-sm font-medium text-gray-700">テンプレートを選択</label>
                <select id="template" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" onchange="loadTemplate(this.value)">
                    <option value="">-- テンプレートを選択 --</option>
                    <option value="thanks">お礼テンプレート</option>
                    <option value="followup">フォローアップ</option>
                    <option value="custom">カスタム回答</option>
                </select>
            </div>

            <form method="POST" action="{{ route('admin.contacts.sendReply', $contact->id) }}">
                @csrf
                <div class="mb-6">
                    <label for="reply_message" class="block font-medium text-sm text-gray-700 mb-1">
                        返信内容
                    </label>
                    <p>※返信の件名は「お問い合わせへの返信」になります。</p>
                    <textarea id = "reply_message"
                              name="reply_message"
                              rows="6"
                              class="w-full border border-gray-300 rounded-md shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-400 resize-none p-3"
                              required></textarea>
                </div>

                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold px-5 py-2 rounded-md transition">
                    送信
                </button>
            </form>
        </div>
    </div>
    <script>
        // JSに問い合わせIDを渡す
        window.contactId = {{ $contact->id }};
    </script>
</x-app-layout>
