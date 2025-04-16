<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();

        $total = $cartItems->sum('total_price');

        return view('cart.index', compact('cartItems', 'total'));
    }

    public function store(Request $request, Product $product)
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

    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:10'
        ]);

        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $totalPrice = $cartItem->product->price * $request->quantity;

        $cartItem->update([
            'quantity' => $request->quantity,
            'total_price' => $totalPrice
        ]);

        return redirect()->route('cart.index')->with('success', 'Quantité mise à jour');
    }

    public function destroy(CartItem $cartItem)
    {
        if ($cartItem->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier');
    }

    public function clear()
    {
        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('cart.index')->with('success', 'Panier vidé');
    }
} 