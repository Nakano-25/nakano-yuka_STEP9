@extends('layouts.ec_app')

@section('title', '商品一覧')

@section('content')
    <h2 class="mb-4">商品一覧</h2>
    
    <div class="col-lg-11 mx-auto">
    <form method="GET" action="{{ route('products.index') }}" class="mb-4">
        <div class="row align-items-center g-3 justify-content-center">
            <div class="col-md-4">
                <input type="text" name="product_name" class="form-control"
                    placeholder="商品名を入力" value="{{ request('product_name') }}">
            </div>

            <div class="col-md-2">
                <input type="text" name="min_price" class="form-control"
                    placeholder="最低価格" value="{{ request('min_price') }}">
            </div>

            <div class="col-md-1 text-center">
                <span>〜</span>
            </div>

            <div class="col-md-2">
                <input type="text" name="max_price" class="form-control"
                    placeholder="最高価格" value="{{ request('max_price') }}">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">検索</button>
            </div>
        </div>
    </form>
    </div>

    <table class="table align-middle">
        <thead>
            <tr>
                <th>商品番号</th>
                <th>商品名</th>
                <th>商品説明</th>
                <th>画像</th>
                <th>料金(￥)</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>
                        <img src="{{ asset('storage/' .$product->img_path) }}" alt="{{ $product->product_name }}" width="60">
                    </td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-success">詳細</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">商品がありません。</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection