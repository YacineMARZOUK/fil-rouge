<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = CartItem::where('user_id', auth()->id())
            ->with('product')
            ->get();

        $total = $cartItems->sum('total_price');

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($validated['product_id']);
        
        // Vérifier si le produit est déjà dans le panier
        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Mettre à jour la quantité et le prix total
            $cartItem->quantity += $validated['quantity'];
            $cartItem->total_price = $cartItem->quantity * $product->price;
            $cartItem->save();
        } else {
            // Créer un nouvel élément dans le panier
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
                'total_price' => $validated['quantity'] * $product->price
            ]);
        }

        return response()->json([
            'message' => 'Produit ajouté au panier',
            'cart_count' => CartItem::where('user_id', auth()->id())->sum('quantity')
        ]);
    }

    public function destroy(CartItem $cartItem)
    {
        if ($cartItem->user_id !== auth()->id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->route('cart.index')
            ->with('success', 'Produit retiré du panier');
    }

    public function clear()
    {
        CartItem::where('user_id', auth()->id())->delete();

        return redirect()->route('cart.index')
            ->with('success', 'Panier vidé avec succès');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        if ($cartItem->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem->quantity = $validated['quantity'];
        $cartItem->total_price = $cartItem->quantity * $cartItem->product->price;
        $cartItem->save();

        return response()->json([
            'message' => 'Quantité mise à jour',
            'total_price' => number_format($cartItem->total_price, 2, ',', ' ') . ' €',
            'cart_total' => number_format(CartItem::where('user_id', auth()->id())->sum('total_price'), 2, ',', ' ') . ' €'
        ]);
    }
} 