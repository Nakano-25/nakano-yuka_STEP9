@extends('layouts.ec_app')

@section('title', '購入画面')

@section('content')
    <div class="col-lg-8 mx-auto">
        <h2 class="mb-4 fw-bold">購入画面</h2>

        <div class="card shadow p-4 border-0">
            <div class="mb-4">
                <p class="fs-4 mb-2">商品名：{{ $product->product_name }}</p>
                <p class="fs-4 mb-0">説明：{{ $product->description }}</p>
            </div>

            <div class="text-center my-4">
                <img
                    src="{{ asset('storage/' . $product->img_path) }}"
                    alt="{{ $product->product_name }}"
                    class="img-fluid"
                    style="max-height: 420px;"
                >
            </div>

            <form action="{{ route('products.purchase.store', $product->id) }}" method="POST">
                @csrf

                <div class="mb-3" style="max-width: 160px;">
                    <input
                        type="number"
                        name="quantity"
                        class="form-control"
                        min="1"
                        max="{{ $product->stock }}"
                        value="{{ old('quantity', 1) }}"
                        {{ $product->stock == 0 ? 'disabled' : '' }}
                    >
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <p class="fs-4 mb-2">金額：￥{{ number_format($product->price) }}</p>
                    <p class="fs-4 mb-2">残り：{{ $product->stock }}</p>
                    <p class="fs-4 mb-2">会社：{{ $product->company->company_name ?? '未設定' }}</p>
                </div>

                <div class="d-flex gap-2">
                @if ($product->stock > 0)
                    <button type="submit" class="btn btn-primary btn-lg">購入する</button>
                @else
                <button class="btn btn-secondary btn-lg" disabled style="opacity: 0.6; cursor: not-allowed;">在庫切れ</button>
                @endif
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary btn-lg">戻る</a>
                </div>
            </form>
        </div>
    </div>
@endsection