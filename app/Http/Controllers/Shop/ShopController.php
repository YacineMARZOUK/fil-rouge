<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    /**
     * Affiche la liste des produits
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Filtrer par type
        if ($request->has('type') && $request->type !== '') {
            $query->where('type', $request->type);
        }

        // Recherche par titre
        if ($request->has('search') && $request->search !== '') {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Tri
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price-asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price-desc':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->orderBy('title', 'asc');
            }
        }

        $products = $query->paginate(12);
        $types = Product::distinct('type')->pluck('type');

        return view('shop.index', compact('products', 'types'));
    }

    /**
     * Affiche les détails d'un produit
     */
    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }

    public function addToCart(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        $totalPrice = $product->price * $request->quantity;

        CartItem::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice
        ]);

        return response()->json([
            'message' => 'Produit ajouté au panier',
            'cart_count' => Auth::user()->cartItems()->sum('quantity')
        ]);
    }
} 