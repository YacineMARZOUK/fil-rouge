<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $types = ['nutrition', 'accessoire', 'vetement'];
        
        $query = Product::query();

        // Filtrer par type
        if ($request->has('type') && in_array($request->type, $types)) {
            $query->where('type', $request->type);
        }

        // Trier les produits
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price-asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price-desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'title':
                    $query->orderBy('title', 'asc');
                    break;
            }
        } else {
            $query->latest();
        }

        // Recherche
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $products = $query->paginate(12)->withQueryString();

        return view('shop.index', compact('products', 'types'));
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