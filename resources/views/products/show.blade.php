@extends('layouts.ec_app')

@section('title', '商品詳細')

@section('content')
    <div class="col-lg-8 mx-auto">
        <h2 class="mb-4 fw-bold">商品詳細</h2>

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
                <p class="fs-4 mb-2">会社：{{ $product->company->company_name ?? '未設定' }}</p>

                @auth
                    <button id="like-btn" class="border-0 bg-transparent p-0"
                            data-product-id="{{ $product->id }}"
                            data-like-url="{{ route('products.like', $product->id) }}">
                        <i class="{{ $product->likedBy(Auth::user()) ? 'fa-solid' : 'fa-regular' }} fa-heart fs-2 text-danger"></i>
                    </button>
                @endauth

                @guest
                    <button class="border-0 bg-transparent p-0" disabled>
                        <i class="fa-regular fa-heart fs-2 text-secondary"></i>
                    </button>
                @endguest

            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('products.purchase') }}" class="btn btn-primary btn-lg">カートに追加する</a>
                <a href="{{ route('products.index') }}" class="btn btn-secondary btn-lg">戻る</a>
            </div>
        </div>
    </div>
@endsection