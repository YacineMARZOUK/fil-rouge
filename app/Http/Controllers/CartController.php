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
    
    $userId = Auth::id();
    $quantity = $request->quantity;
    
    // Calcul du prix total (c'est ce qui manque)
    $totalPrice = $product->price * $quantity;
    
    // Vérifie si le produit existe déjà dans le panier de l'utilisateur
    $existingItem = CartItem::where('user_id', $userId)
        ->where('product_id', $product->id)
        ->first();
    
    if ($existingItem) {
        // Met à jour la quantité
        $newQuantity = $existingItem->quantity + $quantity;
        
        // Limite maximale : 10 au total
        if ($newQuantity > 10) {
            return response()->json([
                'message' => 'Quantité maximale autorisée atteinte pour ce produit.'
            ], 400);
        }
        
        // Calcul du nouveau prix total
        $newTotalPrice = $product->price * $newQuantity;
        
        $existingItem->update([
            'quantity' => $newQuantity,
            'total_price' => $newTotalPrice // Ajout du prix total
        ]);
    } else {
        // Crée un nouvel article dans le panier
        CartItem::create([
            'user_id' => $userId,
            'product_id' => $product->id,
            'quantity' => $quantity,
            'total_price' => $totalPrice // Ajout du prix total
        ]);
    }
    
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