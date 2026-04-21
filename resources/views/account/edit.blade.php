@extends('layouts.ec_app')

@section('title', 'アカウント情報編集')

@section('content')
    <h2 class="mb-4 fw-bold">アカウント情報編集</h2>

    <div class="col-lg-10 mx-auto">
        <div class="card shadow-sm p-4">
            <form action="{{ route('account.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-2">
                    <label for="name" class="form-label">ユーザ名</label>
                    <input
                        type="text"
                        class="form-control shadow-sm @error('name') is-invalid @enderror"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                    >
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Eメール</label>
                    <input
                        type="email"
                        class="form-control shadow-sm @error('email') is-invalid @enderror"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="name_kanji" class="form-label">名前</label>
                    <input
                        type="text"
                        class="form-control shadow-sm @error('name_kanji') is-invalid @enderror"
                        id="name_kanji"
                        name="name_kanji"
                        value="{{ old('name_kanji', $user->name_kanji) }}"
                    >
                    @error('name_kanji')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="name_kana" class="form-label">カナ</label>
                    <input
                        type="text"
                        class="form-control shadow-sm @error('name_kana') is-invalid @enderror"
                        id="name_kana"
                        name="name_kana"
                        value="{{ old('name_kana', $user->name_kana) }}"
                    >
                    @error('name_kana')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <a href="{{ route('mypage') }}" class="btn btn-secondary">戻る</a>
                    <button type="submit" class="btn btn-primary">更新</button>
                </div>
            </form>
        </div>
    </div>
@endsection