@extends('layouts.ec_app')

@section('title', 'お問い合わせフォーム')

@section('content')
    <h2 class="mb-4 fw-bold">お問い合わせフォーム</h2>

    <div class="col-lg-10 mx-auto">
        <div class="card shadow-sm p-4">
            <form action="{{ route('contact.send') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">名前</label>
                    <input
                        type="text"
                        class="form-control shadow-sm @error('name') is-invalid @enderror"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">メールアドレス</label>
                    <input
                        type="email"
                        class="form-control shadow-sm @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="message" class="form-label">お問い合わせ内容</label>
                    <textarea
                        class="form-control shadow-sm @error('message') is-invalid @enderror"
                        id="message"
                        name="message"
                        rows="6"
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">送信</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
                </div>
            </form>
        </div>
    </div>
@endsection