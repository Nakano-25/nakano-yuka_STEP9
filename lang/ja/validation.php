<?php

return [

    'required' => ':attribute は必須です。',
    'regex' => ':attribute の形式が正しくありません。',
    'string' => ':attribute は文字列で入力してください。',
    'max' => ['string' => ':attribute は :max 文字以内で入力してください。',],
    'min' => ['string' => ':attribute は :min 文字以上で入力してください。',],
    'numeric' => ':attribute は数値で入力してください。',
    'integer' => ':attribute は整数で入力してください。',
    'email' => ':attribute は正しいメールアドレス形式で入力してください。',
    'confirmed' => ':attribute が一致しません。',
    'unique' => ':attribute は既に使用されています。',
    'image' => ':attribute は画像ファイルを指定してください。',
    'mimes' => ':attribute は :values 形式でアップロードしてください。',
    'max.file' => ':attribute は :max KB以下にしてください。',

    'attributes' => [
        'name' => '名前',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'product_name' => '商品名',
        'price' => '価格',
        'min_price' => '最低価格',
        'max_price' => '最高価格',
        'description' => '商品説明',
        'stock' => '在庫数',
        'img_path' => '商品画像',
        'message' => 'お問い合わせ内容',
    ],
];