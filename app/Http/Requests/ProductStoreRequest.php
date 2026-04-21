<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_name' => ['required', 'string', 'max:255'],
            'price' => ['required', 'integer', 'min:0'],
            'description' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'integer', 'min:0'],
            'img_path' => ['required', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'],
        ];
    }

    public function messages()
    {
        return [
            'product_name.required' => '商品名は必須です。',
            'price.required' => '価格は必須です。',
            'description.required' => '商品説明は必須です。',
            'stock.required' => '在庫数は必須です。',
            'img_path.required' => '商品画像は必須です。',
        ];
    }

    public function attributes(): array
    {
        return [
            'product_name' => '商品名',
            'price' => '価格',
            'description' => '商品説明',
            'stock' => '在庫数',
            'img_path' => '商品画像',
        ];
    }
}