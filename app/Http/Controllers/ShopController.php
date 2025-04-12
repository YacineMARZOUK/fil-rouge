<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('type')) {
            $query->where('type', $request->type);
        }

        $products = $query->paginate(12);

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