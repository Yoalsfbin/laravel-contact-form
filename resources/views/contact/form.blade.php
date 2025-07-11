<x-app-layout>
    <div class="container py-5">
        <h1 class="mb-4">お問い合わせ</h1>

        {{-- バリデーションエラー --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- フォーム --}}
        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf

            <div class="form-floating mb-3">
                <input type="text" id="name" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" placeholder="お名前">
                <label for="name" class="form-label">お名前</label>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <input type="email" id="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" placeholder="name@example.com" >
                <label for="email" class="form-label">メールアドレス</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-floating mb-3">
                <textarea id="message" name="message" rows="5"
                          class="form-control @error('message') is-invalid @enderror" 
                          style="height: 200px; resize: none;"
                          placeholder="お問い合わせ内容">{{ old('message') }}</textarea>
                <label for="message" class="form-label">お問い合わせ内容</label>
                @error('message')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">送信する</button>
        </form>
    </div>
</x-app-layout>
