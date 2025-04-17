<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
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

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide');
        }

        $total = $cartItems->sum('total_price');

        return view('checkout.index', compact('cartItems', 'total'));
    }

    public function process(Request $request)
    {
        // Cette méthode sera implémentée plus tard pour traiter le paiement
        return redirect()->route('checkout.success');
    }

    public function success()
    {
        return view('checkout.success');
    }
} 