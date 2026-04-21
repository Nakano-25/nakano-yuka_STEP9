<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $products = Product::where('user_id', $user->id)
            ->orderBy('id', 'asc')
            ->get();

        $sales = Sale::with('product')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('mypage.index', compact('user', 'products', 'sales'));
    }

}