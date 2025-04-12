@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4">
        <!-- En-tête de la boutique -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Notre Boutique</h1>
            <p class="text-xl text-gray-600">Découvrez nos produits de qualité pour atteindre vos objectifs</p>
        </div>

        <!-- Filtres -->
        <div class="mb-8">
            <div class="flex flex-wrap gap-4 justify-center">
                <a href="{{ route('shop.index') }}" class="px-4 py-2 bg-white rounded-lg shadow hover:bg-gray-50 transition duration-300 {{ !request('type') ? 'bg-blue-100' : '' }}">
                    Tous les produits
                </a>
                <a href="{{ route('shop.index', ['type' => 'nutrition']) }}" class="px-4 py-2 bg-white rounded-lg shadow hover:bg-gray-50 transition duration-300 {{ request('type') === 'nutrition' ? 'bg-blue-100' : '' }}">
                    Nutrition
                </a>
                <a href="{{ route('shop.index', ['type' => 'vetement']) }}" class="px-4 py-2 bg-white rounded-lg shadow hover:bg-gray-50 transition duration-300 {{ request('type') === 'vetement' ? 'bg-blue-100' : '' }}">
                    Vêtements
                </a>
                <a href="{{ route('shop.index', ['type' => 'accessoire']) }}" class="px-4 py-2 bg-white rounded-lg shadow hover:bg-gray-50 transition duration-300 {{ request('type') === 'accessoire' ? 'bg-blue-100' : '' }}">
                    Accessoires
                </a>
            </div>
        </div>

        <!-- Grille de produits -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('images/products/' . ($product->image ?? 'default.jpg')) }}" alt="{{ $product->title }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">{{ $product->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 100) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold text-gray-900">{{ $product->formatted_price }}</span>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full transition duration-300">
                            Ajouter au panier
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection 