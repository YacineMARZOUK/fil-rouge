@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-8">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Bouton retour -->
        <a href="{{ route('shop.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-6">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Retour à la boutique
        </a>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">
                <!-- Image du produit -->
                <div class="relative">
                    <img src="{{ asset('images/products/' . ($product->image ?? 'default.jpg')) }}" 
                         alt="{{ $product->title }}" 
                         class="w-full h-96 object-cover rounded-lg">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-blue-600 text-white text-sm font-semibold rounded-full">
                            {{ $product->type_label }}
                        </span>
                    </div>
                </div>

                <!-- Informations du produit -->
                <div class="space-y-6">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ $product->title }}</h1>
                        <p class="text-2xl font-bold text-blue-600 mt-2">{{ $product->formatted_price }}</p>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                            </svg>
                            <span class="ml-2 text-gray-600">4.8 (120 avis)</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                            <span class="ml-2 text-gray-600">{{ $product->quantity }} en stock</span>
                        </div>
                    </div>

                    <div class="prose max-w-none">
                        <h3 class="text-lg font-semibold text-gray-900">Description</h3>
                        <p class="text-gray-600">{{ $product->description }}</p>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="flex items-center">
                            <button class="p-2 rounded-full bg-gray-200 hover:bg-gray-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                                </svg>
                            </button>
                            <span class="mx-4 text-xl font-semibold">1</span>
                            <button class="p-2 rounded-full bg-gray-200 hover:bg-gray-300">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                            </button>
                        </div>
                        <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg transition duration-300">
                            Ajouter au panier
                        </button>
                    </div>

                    <!-- Informations supplémentaires -->
                    <div class="border-t border-gray-200 pt-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations complémentaires</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-500">Type</p>
                                <p class="text-sm font-medium text-gray-900">{{ $product->type_label }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Disponibilité</p>
                                <p class="text-sm font-medium text-gray-900">
                                    @if($product->quantity > 0)
                                        <span class="text-green-600">En stock</span>
                                    @else
                                        <span class="text-red-600">Rupture de stock</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Produits similaires -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Produits similaires</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($similarProducts as $similarProduct)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ asset('images/products/' . ($similarProduct->image ?? 'default.jpg')) }}" 
                         alt="{{ $similarProduct->title }}" 
                         class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">{{ $similarProduct->title }}</h3>
                        <p class="text-gray-600 mb-4">{{ Str::limit($similarProduct->description, 60) }}</p>
                        <div class="flex justify-between items-center">
                            <span class="text-xl font-bold text-gray-900">{{ $similarProduct->formatted_price }}</span>
                            <a href="{{ route('shop.show', $similarProduct) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                Voir détails
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection 