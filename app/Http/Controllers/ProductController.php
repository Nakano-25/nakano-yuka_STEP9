<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductSearchRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(ProductSearchRequest $request)
    {
        $query = Product::query();

        if (Auth::check()) {
            $query->where('user_id', '!=', Auth::id());
        }

        if ($request->filled('product_name')) {
            $query->where('product_name', 'like', '%' . $request->product_name . '%');
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', $request->min_price);
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->max_price);
        }

        $products = $query->orderBy('id', 'asc')->get();

        return view('products.index', compact('products'));
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('products.show', compact('product'));
    }

    public function purchase()
    {
        return view('products.purchase');
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductStoreRequest $request)
    {
        $user = Auth::user();

        if (!$user || !$user->company_id) {
            return back()->withErrors([
                'company_id' => '会社情報が設定されていないため商品登録できません。',
            ])->withInput();
        }

        $imagePath = $request->file('img_path')->store('products', 'public');

        Product::create([
            'user_id' => $user->id,
            'company_id' => $user->company_id,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
            'img_path' => $imagePath,
        ]);

        return redirect()->route('mypage')->with('success', '商品を登録しました。');
    }

    public function edit()
    {
        return view('products.edit');
    }
}