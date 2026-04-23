<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductSearchRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductPurchaseRequest;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $product = Product::with('company')->findOrFail($id);

        return view('products.show', compact('product'));
    }

    public function purchase($id)
    {
    $product = Product::with('company')->findOrFail($id);

    return view('products.purchase', compact('product'));
    }

    public function storePurchase(ProductPurchaseRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();
        $quantity = $request->validated()['quantity'];

        try {
            $product->purchase($user->id, $quantity);
        } catch (\Exception $e) {
            return back()->withErrors([
                'quantity' => $e->getMessage(),
            ])->withInput();
        }

        return redirect()->route('products.index')
            ->with('success', '商品を購入しました。');
    }

    public function create()
    {
        $user = Auth::user();

        if (!$user || !$user->company_id) {
            return redirect()->route('mypage')
                ->with('error', '会社情報を登録してから商品登録してください');
        }

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

    public function myShow($id)
    {
        $product = Product::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('mypage.product_show', compact('product'));
    }

    public function destroy($id)
    {
        $product = Product::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $product->delete();

        return redirect()->route('mypage')
            ->with('success', '商品を削除しました');
    }

    public function toggleLike($id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();

        if ($product->likedBy($user)) {
            $product->likedUsers()->detach($user->id);
            $liked = false;
        } else {
            $product->likedUsers()->attach($user->id);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
        ]);
    }

    public function edit($id)
    {
        $product = Product::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('products.edit', compact('product'));
    }

    public function update(ProductStoreRequest $request, $id)
    {
        $product = Product::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $data = $request->validated();

        if ($request->hasFile('img_path')) {
            $data['img_path'] = $request->file('img_path')->store('products', 'public');
        } else {
            $data['img_path'] = $product->img_path;
        }

        $product->update($data);

        return redirect()->route('products.my.show', $product->id)
            ->with('success', '商品を更新しました');
    }
}