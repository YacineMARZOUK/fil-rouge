@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Mon Panier</h1>

    @if($cartItems->count() > 0)
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex flex-col space-y-4">
                @foreach($cartItems as $item)
                    <div class="flex items-center justify-between border-b pb-4">
                        <div class="flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->title }}" class="w-24 h-24 object-cover rounded-lg">
                            <div>
                                <h3 class="text-lg font-semibold">{{ $item->product->title }}</h3>
                                <p class="text-gray-600">{{ $item->product->price }} €</p>
                            </div>
                        </div>
                        <div class="flex items-center space-x-4">
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="10" class="w-16 px-2 py-1 border rounded-lg">
                                <button type="submit" class="ml-2 text-primary hover:text-primary-dark">
                                    <i class="fas fa-sync"></i>
                                </button>
                            </form>
                            <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex justify-between items-center">
                <div>
                    <p class="text-xl font-semibold">Total: {{ $total }} €</p>
                </div>
                <div class="space-x-4">
                    <form action="{{ route('cart.clear') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                            Vider le panier
                        </button>
                    </form>
                    <a href="{{ route('checkout') }}" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark">
                        Commander
                    </a>
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <p class="text-xl text-gray-600">Votre panier est vide</p>
            <a href="{{ route('shop') }}" class="inline-block mt-4 bg-primary text-white px-6 py-2 rounded-lg hover:bg-primary-dark">
                Continuer mes achats
            </a>
        </div>
    @endif
</div>
@endsection 