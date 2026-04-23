<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PurchaseRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    public function purchase(PurchaseRequest $request)
    {
        $data = $request->validated();

        $product = Product::find($data['product_id']);

        if (!$product) {
            return response()->json([
                'message' => '商品が存在しません。',
            ], 404);
        }

        try {
            $sale = $product->purchase(Auth::id(), (int) $data['quantity']);

            return response()->json([
                'message' => '購入が完了しました。',
                'sale' => $sale,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}