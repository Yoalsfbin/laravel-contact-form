<x-app-layout>
    <div class="max-w-6xl mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">お問い合わせ一覧</h1>

        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="border px-4 py-2">名前</th>
                    <th class="border px-4 py-2">メール</th>
                    <th class="border px-4 py-2">メッセージ</th>
                    <th class="border px-4 py-2">送信日時</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td class="border px-4 py-2">{{ $contact->name }}</td>
                        <td class="border px-4 py-2">{{ $contact->email }}</td>
                        <td class="border px-4 py-2">{{ $contact->message }}</td>
                        <td class="border px-4 py-2">{{ $contact->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $contacts->links() }}
        </div>
    </div>
</x-app-layout>
