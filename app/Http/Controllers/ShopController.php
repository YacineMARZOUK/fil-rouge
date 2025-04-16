<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('shop.index', compact('products'));
    }

    public function show(Product $product)
    {
        $similarProducts = Product::where('type', $product->type)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        return view('shop.show', compact('product', 'similarProducts'));
    }
} 