@extends('layouts.app')

@section('content')
<!-- En-tête de la page -->
<div class="bg-dark py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">Mon Panier</h1>
        <p class="text-gray-400">Gérez vos articles et passez commande</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    @if($cartItems->count() > 0)
        <div class="bg-dark border border-gray-700 rounded-lg p-6 shadow-lg">
            <div class="flex flex-col space-y-4">
                @foreach($cartItems as $item)
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b border-gray-700 pb-4">
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-24 h-24 object-cover rounded-lg">
                            <div>
                                <h3 class="text-lg font-semibold">{{ $item->product->name }}</h3>
                                <p class="text-primary font-bold">{{ number_format($item->product->price, 2, ',', ' ') }} €</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4 mt-4 md:mt-0">
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="10" class="input-field w-16 px-2 py-1">
                                <button type="submit" class="ml-2 text-primary hover:text-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                </button>
                            </form>
                            <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex flex-col md:flex-row justify-between items-center">
                <div>
                    <p class="text-xl font-semibold text-primary">Total: {{ number_format($total, 2, ',', ' ') }} €</p>
                </div>
                <div class="space-x-4 mt-4 md:mt-0">
                    <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors duration-300">
                            Vider le panier
                        </button>
                    </form>
                    <a href="{{ route('checkout') }}" class="btn-primary inline-block px-6 py-2">
                        Commander
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-12 bg-dark border border-gray-700 rounded-lg">
            <p class="text-xl text-gray-400">Votre panier est vide</p>
            <a href="{{ route('shop') }}" class="inline-block mt-4 btn-primary px-6 py-2">
                Continuer mes achats
            </a>
        </div>
    @endif
</div>
@endsection