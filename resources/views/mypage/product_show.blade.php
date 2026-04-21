@extends('layouts.ec_app')

@section('title', '出品商品詳細')

@section('content')
<div class="col-lg-8 mx-auto">
    <h2 class="mb-4 fw-bold">出品商品詳細</h2>

    <div class="card shadow p-4 border-0">
        <div class="mb-4">
            <p class="fs-4 mb-2">商品名：{{ $product->product_name }}</p>
            <p class="fs-4 mb-0">説明：{{ $product->description }}</p>
        </div>

        <div class="mb-4">
            <p class="fs-4 mb-3">画像：</p>
                <div class="text-center">
                    <img
                        src="{{ asset('storage/' . $product->img_path) }}"
                        alt="{{ $product->product_name }}"
                        class="img-fluid"
                        style="max-height: 420px;"
                    >
                </div>
        </div>

        <div class="mb-4">
                <p class="fs-4 mb-2">金額：￥{{ number_format($product->price) }}</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('products.edit', $product->id) }}"
                class="btn btn-primary">編集</a>

            <form action="{{ route('products.destroy', $product->id) }}"
                method="POST"
                onsubmit="return confirm('削除しますか？');">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">削除する</button>
            </form>

            <a href="{{ route('mypage') }}"
                class="btn btn-secondary">戻る</a>
        </div>
    </div>
</div>
@endsection