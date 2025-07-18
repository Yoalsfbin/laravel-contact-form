<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">お問い合わせCSV出力</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <div class="bg-white p-6 shadow rounded">
            <form method="POST" action="{{ route('admin.contacts.export.post') }}">
                @csrf

                <div class="mb-4">
                    <label class="block font-medium">名前</label>
                    <input type="text" name="name" class="mt-1 w-full border-gray-300 rounded-md" />
                </div>

                <div class="mb-4">
                    <label class="block font-medium">メールアドレス</label>
                    <input type="text" name="email" class="mt-1 w-full border-gray-300 rounded-md" />
                </div>

                <div class="mb-4">
                    <label class="block font-medium">件名</label>
                    <input type="text" name="subject" class="mt-1 w-full border-gray-300 rounded-md" />
                </div>

                <div class="mb-4">
                    <label class="block font-medium">内容</label>
                    <input type="text" name="message" class="mt-1 w-full border-gray-300 rounded-md" />
                </div>

                <div class="mb-4">
                    <label class="block font-medium">期間（From）</label>
                    <input type="date" name="from" class="mt-1 w-full border-gray-300 rounded-md" />
                </div>

                <div class="mb-4">
                    <label class="block font-medium">期間（To）</label>
                    <input type="date" name="to" class="mt-1 w-full border-gray-300 rounded-md" />
                </div>

                <div class="mb-4">
                    <label class="block font-medium">並び順</label>
                    <select name="sort_column" class="border border-gray-300 rounded px-3 py-2 pr-10">
                        <option value="created_at" {{ ($sort_column ?? '') === 'created_at' ? 'selected' : '' }}>送信日時</option>
                        <option value="name" {{ ($sort_column ?? '') === 'name' ? 'selected' : '' }}>名前</option>
                        <option value="email" {{ ($sort_column ?? '') === 'email' ? 'selected' : '' }}>メールアドレス</option>
                    </select>
                    <select name="sort_direction" class="border border-gray-300 rounded px-3 py-2 pr-10">
                        <option value="desc" {{ ($sort_direction ?? '') === 'desc' ? 'selected' : '' }}>降順</option>
                        <option value="asc" {{ ($sort_direction ?? '') === 'asc' ? 'selected' : '' }}>昇順</option>
                    </select>
                </div>

                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded">
                    CSV出力
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
