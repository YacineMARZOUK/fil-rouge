@extends('layouts.app')

@section('content')
<!-- En-tête de la page -->
<div class="bg-dark py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">Notre Boutique</h1>
        <p class="text-gray-400">Découvrez notre sélection d'équipements et de compléments alimentaires pour atteindre vos objectifs</p>
    </div>
</div>

<!-- Filtres et Recherche -->
<div class="container mx-auto px-4 py-8">
    <form method="GET" action="{{ route('shop') }}" class="mb-8">
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-4 w-full md:w-auto">
                <select name="type" class="input-field" onchange="this.form.submit()">
                    <option value="">Tous les types</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
                <select name="sort" class="input-field" onchange="this.form.submit()">
                    <option value="title" {{ request('sort') == 'title' ? 'selected' : '' }}>Nom</option>
                    <option value="price-asc" {{ request('sort') == 'price-asc' ? 'selected' : '' }}>Prix croissant</option>
                    <option value="price-desc" {{ request('sort') == 'price-desc' ? 'selected' : '' }}>Prix décroissant</option>
                </select>
            </div>
            <div class="relative w-full md:w-64">
                <input type="text" name="search" placeholder="Rechercher..." 
                       class="input-field w-full pr-10" 
                       value="{{ request('search') }}">
                <button type="submit" class="absolute right-3 top-1/2 transform -translate-y-1/2">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </div>
    </form>

    <!-- Grille de produits -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="card group">
                <div class="relative aspect-square mb-4 overflow-hidden rounded-lg">
                    <img src="{{ asset('images/products/' . ($product->image ?? 'default.jpg')) }}" 
                         alt="{{ $product->title }}" 
                         class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">
                    @if($product->quantity > 0)
                        <div class="absolute top-2 right-2">
                            <span class="bg-primary text-dark px-2 py-1 rounded-full text-sm font-semibold">
                                En stock
                            </span>
                        </div>
                    @else
                        <div class="absolute top-2 right-2">
                            <span class="bg-red-500 text-white px-2 py-1 rounded-full text-sm font-semibold">
                                Rupture de stock
                            </span>
                        </div>
                    @endif
                </div>
                <h3 class="text-lg font-semibold mb-2">{{ $product->title }}</h3>
                <p class="text-gray-400 text-sm mb-4">{{ Str::limit($product->description, 100) }}</p>
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-2">
                        <span class="text-primary font-bold">{{ number_format($product->price, 2, ',', ' ') }} €</span>
                    </div>
                    <button class="btn-primary" {{ $product->quantity <= 0 ? 'disabled' : '' }}>
                        {{ $product->quantity <= 0 ? 'Rupture de stock' : 'Ajouter au panier' }}
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-400">Aucun produit trouvé</p>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $products->links() }}
    </div>
</div>
@endsection 