@extends('layouts.app')

@section('content')
<!-- En-tête de la page -->
<div class="bg-dark py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">Notre Boutique</h1>
        <p class="text-gray-400">Découvrez notre sélection d'équipements et de compléments alimentaires pour atteindre vos objectifs</p>
    </div>
</div>

<!-- Modal d'ajout au panier -->
<div id="cartModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
    <div class="bg-dark border border-gray-700 rounded-lg p-6 max-w-md w-full mx-4">
        <h3 class="text-xl font-bold mb-4">Ajouter au panier</h3>
        <div class="mb-4">
            <div class="flex items-center gap-4 mb-4">
                <img id="modalProductImage" src="" alt="" class="w-20 h-20 object-cover rounded">
                <div>
                    <h4 id="modalProductTitle" class="font-semibold"></h4>
                    <p id="modalProductPrice" class="text-primary"></p>
                </div>
            </div>
            <div class="mb-4">
                <label for="quantity" class="block text-sm font-medium text-gray-400 mb-1">Quantité</label>
                <input type="number" id="modalQuantity" class="input-field w-full" value="1" min="1">
            </div>
        </div>
        <div class="flex justify-end gap-2">
            <button onclick="closeModal()" class="btn-secondary">
                Annuler
            </button>
            <button onclick="addToCart()" class="btn-primary">
                Ajouter au panier
            </button>
        </div>
    </div>
</div>

<!-- Filtres et Recherche -->
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <form method="GET" action="{{ route('shop') }}" class="flex-1">
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
        @auth
        <a href="{{ route('cart.index') }}" class="btn-primary ml-4 flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
            </svg>
            <span id="cartCount">{{ Auth::user()->cartItems()->sum('quantity') }}</span>
        </a>
        @endauth
    </div>

    <!-- Grille de produits -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($products as $product)
        <div class="card bg-dark hover:shadow-lg transition-shadow duration-300">
            <div class="aspect-w-1 aspect-h-1 w-full overflow-hidden rounded-t-lg bg-gray-800">
                <img src="{{ asset('storage/' . $product->image) }}" 
                     alt="{{ $product->title }}"
                     class="h-full w-full object-cover object-center">
            </div>
            <div class="p-4">
                <h3 class="text-lg font-semibold mb-2">{{ $product->title }}</h3>
                <p class="text-gray-400 text-sm mb-2 line-clamp-2">{{ $product->description }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-primary font-bold">{{ number_format($product->price, 2, ',', ' ') }} €</span>
                    <span class="text-sm text-gray-400">Stock: {{ $product->quantity }}</span>
                </div>
                
                @if(auth()->check() && auth()->user()->role === 'admin')
                <div class="flex justify-between gap-2 mt-4">
                    <a href="{{ route('admin.products.edit', $product) }}" class="btn-secondary flex-1">
                        <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Modifier
                    </a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="flex-1" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger w-full">
                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Supprimer
                        </button>
                    </form>
                </div>
                @else
                <div class="mt-4">
                    <button onclick="openModal({{ $product->id }}, '{{ $product->title }}', '{{ number_format($product->price, 2, ',', ' ') }}', '{{ asset('storage/' . $product->image) }}')" 
                            class="btn-primary w-full">
                        Ajouter au panier
                    </button>
                </div>
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="mt-12">
        {{ $products->links() }}
    </div>
</div>

@push('scripts')
<script>
let currentProductId = null;

function openModal(productId, title, price, image) {
    currentProductId = productId;
    document.getElementById('modalProductTitle').textContent = title;
    document.getElementById('modalProductPrice').textContent = price + ' €';
    document.getElementById('modalProductImage').src = image;
    document.getElementById('modalQuantity').value = 1;
    document.getElementById('cartModal').classList.remove('hidden');
    document.getElementById('cartModal').classList.add('flex');
}

function closeModal() {
    document.getElementById('cartModal').classList.add('hidden');
    document.getElementById('cartModal').classList.remove('flex');
}

function addToCart() {
    const quantity = document.getElementById('modalQuantity').value;
    
    fetch('{{ route('cart.store') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            product_id: currentProductId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('cartCount').textContent = data.cart_count;
        closeModal();
        // Afficher une notification de succès
        alert(data.message);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Une erreur est survenue');
    });
}

// Fermer le modal si on clique en dehors
document.getElementById('cartModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});
</script>
@endpush
@endsection 