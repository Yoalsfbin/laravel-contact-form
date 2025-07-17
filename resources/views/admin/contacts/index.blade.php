@vite('resources/js/modal.js')
<x-app-layout>
    <div class="max-w-7xl mx-auto p-6 sm:p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">お問い合わせ一覧</h1>

        {{-- 検索ボックス --}}
        <form method="GET" action="{{ route('admin.contacts.index') }}" class="mb-4">
            <input type="text" name="keyword" value="{{ $keyword ?? '' }}" placeholder="キーワードで検索"
                class="border px-3 py-1 rounded" />
            <button type="submit" class="bg-indigo-600 text-white px-4 py-1 rounded ml-2">検索</button>
        </form>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                    <tr>
                        <th class="px-6 py-4">名前</th>
                        <th class="px-6 py-4">メール</th>
                        <th class="px-6 py-4">件名</th>
                        <th class="px-6 py-4">メッセージ</th>
                        <th class="px-6 py-4">送信日時</th>
                        <th class="px-6 py-4 text-center">操作</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm">
                    @foreach ($contacts as $contact)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $contact->name }}</td>
                            <td class="px-6 py-4 text-blue-600 underline break-words">{{ $contact->email }}</td>
                            <td class="px-6 py-4 text-gray-900  break-words">{{ $contact->subject }}</td>
                            <td class="px-6 py-4 text-gray-700">
                                {{ Str::limit($contact->message, 50) }}
                                @if (Str::length($contact->message) > 50)
                                    <button
                                        onclick="openModal({{ $contact->id }})"
                                        class="text-indigo-600 text-sm underline ml-2">
                                        続きを読む
                                    </button>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.contacts.reply', $contact->id) }}"
                                class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700 transition">
                                    返信
                                </a>
                            </td>
                        </tr>

                        {{-- モーダル --}}
                        <div id="modal-{{ $contact->id }}"
                            class="fixed inset-0 z-50 bg-black bg-opacity-50 hidden justify-center items-center p-4 sm:p-6">
                            <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl max-h-[80vh] overflow-y-auto relative p-6 sm:p-8">
                                <h2 class="text-xl font-semibold mb-4 text-gray-800">
                                    お問い合わせ内容（{{ $contact->name }}）
                                </h2>

                                <div class="text-gray-700 whitespace-pre-wrap break-words leading-relaxed">{{ $contact->message }}</div>

                                <button onclick="closeModal({{ $contact->id }})"
                                        class="absolute top-4 right-5 text-gray-500 hover:text-black text-2xl leading-none focus:outline-none">
                                    &times;
                                </button>
                            </div>
                        </div>
                    @endforeach

                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $contacts->links() }}
        </div>
    </div>
</x-app-layout>
