@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Finaliser la commande</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Résumé de la commande -->
        <div class="bg-dark rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Résumé de votre commande</h2>
            <div class="space-y-4">
                @foreach($cartItems as $item)
                    <div class="flex items-center justify-between border-b border-gray-700 pb-4">
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $item->product->image) }}" 
                                 alt="{{ $item->product->title }}" 
                                 class="w-16 h-16 object-cover rounded">
                            <div>
                                <h3 class="font-semibold">{{ $item->product->title }}</h3>
                                <p class="text-gray-400">Quantité: {{ $item->quantity }}</p>
                            </div>
                        </div>
                        <span class="text-primary font-bold">{{ number_format($item->total_price, 2, ',', ' ') }} €</span>
                    </div>
                @endforeach
            </div>
            <div class="mt-6 pt-6 border-t border-gray-700">
                <div class="flex justify-between items-center">
                    <span class="text-xl font-semibold">Total</span>
                    <span class="text-2xl font-bold text-primary">{{ number_format($total, 2, ',', ' ') }} €</span>
                </div>
            </div>
        </div>

        <!-- Formulaire de paiement -->
        <div class="bg-dark rounded-lg shadow-lg p-6">
            <h2 class="text-xl font-semibold mb-4">Informations de paiement</h2>
            <form action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label for="card_name" class="block text-sm font-medium text-gray-400 mb-1">Nom sur la carte</label>
                    <input type="text" id="card_name" name="card_name" required 
                           class="input-field w-full" placeholder="John Doe">
                </div>
                <div>
                    <label for="card_number" class="block text-sm font-medium text-gray-400 mb-1">Numéro de carte</label>
                    <input type="text" id="card_number" name="card_number" required 
                           class="input-field w-full" placeholder="1234 5678 9012 3456">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="expiry" class="block text-sm font-medium text-gray-400 mb-1">Date d'expiration</label>
                        <input type="text" id="expiry" name="expiry" required 
                               class="input-field w-full" placeholder="MM/YY">
                    </div>
                    <div>
                        <label for="cvc" class="block text-sm font-medium text-gray-400 mb-1">CVC</label>
                        <input type="text" id="cvc" name="cvc" required 
                               class="input-field w-full" placeholder="123">
                    </div>
                </div>
                <button type="submit" class="btn-primary w-full py-3">
                    Payer {{ number_format($total, 2, ',', ' ') }} €
                </button>
            </form>
        </div>
    </div>
</div>
@endsection 