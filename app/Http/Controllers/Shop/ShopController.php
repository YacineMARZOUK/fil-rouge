<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['addToCart']);
    }

    /**
     * Affiche la liste des produits
     */
    public function index(Request $request)
    {
        $query = Product::query();

        // Filtrage par catégorie
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Recherche par nom
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
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
                    $query->orderBy('name', 'asc');
            }
        }

        $products = $query->paginate(12);
        $categories = Product::distinct('category')->pluck('category');

        return view('shop.index', compact('products', 'categories'));
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
        try {
            $request->validate([
                'quantity' => 'required|integer|min:1|max:10'
            ]);

            // Vérifier si le produit est en stock
            if ($product->quantity < $request->quantity) {
                return response()->json([
                    'message' => 'Stock insuffisant'
                ], 422);
            }

            $totalPrice = $product->price * $request->quantity;

            // Vérifier si le produit existe déjà dans le panier
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();

            if ($cartItem) {
                // Mettre à jour la quantité
                $cartItem->update([
                    'quantity' => $cartItem->quantity + $request->quantity,
                    'total_price' => $cartItem->total_price + $totalPrice
                ]);
            } else {
                // Créer un nouvel élément dans le panier
                CartItem::create([
                    'user_id' => Auth::id(),
                    'product_id' => $product->id,
                    'quantity' => $request->quantity,
                    'total_price' => $totalPrice
                ]);
            }

            return response()->json([
                'message' => 'Produit ajouté au panier',
                'cart_count' => Auth::user()->cartItems()->sum('quantity')
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Une erreur est survenue'
            ], 500);
        }
    }
} 