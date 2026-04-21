@extends('layouts.ec_app')

@section('title', '出品商品編集')

@section('content')
    <h2 class="mb-4 fw-bold">出品商品編集</h2>

    <div class="col-lg-10 mx-auto">
    <div class="card shadow-sm p-4">
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-2">
            <label for="product_name" class="form-label">商品名</label>
            <input
                type="text"
                class="form-control shadow-sm @error('product_name') is-invalid @enderror"
                id="product_name"
                name="product_name"
                value="{{ old('product_name', $product->product_name) }}"
            >
            @error('product_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-2">
            <label for="price" class="form-label">価格</label>
            <input
                type="number"
                min="0"
                class="form-control shadow-sm @error('price') is-invalid @enderror"
                id="price"
                name="price"
                value="{{ old('price', $product->price) }}"
            >
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-2">
            <label for="description" class="form-label">商品説明</label>
            <textarea
                class="form-control shadow-sm @error('description') is-invalid @enderror"
                id="description"
                name="description"
                rows="4"
            >{{ old('description', $product->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-2">
            <label for="stock" class="form-label">在庫数</label>
            <input
                type="number"
                min="0"
                class="form-control shadow-sm @error('stock') is-invalid @enderror"
                id="stock"
                name="stock"
                value="{{ old('stock', $product->stock) }}"
            >
            @error('stock')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">商品画像</label>
            <div class="mb-2">
                <img src="{{ asset('storage/' . $product->img_path) }}" alt="{{ $product->product_name }}" width="200">
            </div>
            <input
                type="file"
                name="img_path"
                class="form-control @error('img_path') is-invalid @enderror"
            >
            @error('img_path')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <a href="{{ route('products.my.show', $product->id) }}" class="btn btn-secondary">戻る</a>
            <button type="submit" class="btn btn-primary">更新</button>
        </div>
    </form>
    </div>
    </div>
@endsection