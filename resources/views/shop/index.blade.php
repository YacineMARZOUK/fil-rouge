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
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition duration-300">
                <div class="relative">
                    <img src="{{ asset('images/products/' . ($product->image ?? 'default.jpg')) }}" 
                         alt="{{ $product->title }}" 
                         class="w-full h-48 object-cover">
                    @if($product->discount > 0)
                    <div class="absolute top-2 right-2">
                        <span class="px-2 py-1 bg-red-600 text-white text-xs font-semibold rounded-full">
                            -{{ $product->discount }}%
                        </span>
                    </div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="text-lg font-semibold mb-2">{{ $product->title }}</h3>
                    <p class="text-gray-600 mb-4">{{ Str::limit($product->description, 100) }}</p>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <div>
                                @if($product->discount > 0)
                                    <span class="text-lg font-bold text-red-600">{{ $product->formatted_discounted_price }}</span>
                                    <span class="text-sm text-gray-500 line-through ml-1">{{ $product->formatted_price }}</span>
                                @else
                                    <span class="text-xl font-bold text-gray-900">{{ $product->formatted_price }}</span>
                                @endif
                            </div>
                            <div class="flex items-center text-sm">
                                <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="ml-1 text-gray-600">{{ $product->rating ?? '4.8' }}</span>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('shop.show', $product) }}" 
                               class="flex items-center justify-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-lg transition duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Voir détails
                            </a>
                            <button class="flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-300">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Ajouter
                            </button>
                        </div>
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