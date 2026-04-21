@extends('layouts.ec_app')

@section('title', 'マイページ')

@section('content')
<div class="container">

    <h2 class="mb-4 fw-bold">マイページ</h2>

    <div class="mb-4">
        <a href="{{ route('account.edit') }}" class="btn btn-primary mb-2">アカウント編集</a>

        <div class="row">
            <div class="col-md-6">
                <p>ユーザ名：{{ $user->name }}</p>
                <p>Eメール：{{ $user->email }}</p>
            </div>
            <div class="col-md-6">
                <p>名前：{{ $user->name_kanji }}</p>
                <p>カナ：{{ $user->name_kana }}</p>
            </div>
        </div>
    </div>

    <div class="mb-5">
        <h4>＜出品商品＞</h4>

        <div class="text-end mb-2">
            <a href="{{ route('products.create') }}" class="btn btn-primary">新規登録</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>商品番号</th>
                    <th>商品名</th>
                    <th>商品説明</th>
                    <th>料金(¥)</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            <a href="{{ route('products.my.show', $product->id) }}" class="btn btn-success">詳細</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">出品商品がありません</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        <h4>＜購入した商品＞</h4>

        <table class="table">
            <thead>
                <tr>
                    <th>商品名</th>
                    <th>商品説明</th>
                    <th>料金(¥)</th>
                    <th>個数</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($sales as $sale)
                    <tr>
                        <td>{{ $sale->product->product_name ?? '' }}</td>
                        <td>{{ $sale->product->description ?? '' }}</td>
                        <td>{{ $sale->product->price ?? '' }}</td>
                        <td>{{ $sale->quantity }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">購入商品がありません</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection