@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-gray-400">Liste des produits</h1>
            <a href="{{ route('admin.products.create') }}" class="btn-primary inline-flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Nouveau Produit
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="card">
                <div class="relative">
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="w-full h-48 object-cover rounded-t">
                    <div class="absolute top-2 right-2 flex space-x-2">
                        <a href="{{ route('admin.products.edit', $product) }}" 
                           class="bg-gray-800 p-2 rounded-full hover:bg-gray-700 transition-colors duration-200">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </a>
                        
                        <form action="{{ route('admin.products.destroy', $product) }}" 
                              method="POST" 
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?');"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-gray-800 p-2 rounded-full hover:bg-red-600 transition-colors duration-200">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
                
                <div class="p-4 space-y-4">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-200">{{ $product->name }}</h2>
                        <p class="text-sm text-gray-400 mt-1">{{ Str::limit($product->description, 100) }}</p>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-400">Catégorie</span>
                            <span class="text-sm text-gray-200">{{ $product->type }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-400">Prix</span>
                            <span class="text-sm text-gray-200">{{ number_format($product->price, 2, ',', ' ') }} €</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-400">Stock</span>
                            <span class="text-sm text-gray-200">{{ $product->stock }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection

<style>
.card {
    @apply bg-gray-900 rounded-lg overflow-hidden;
    @apply transform transition-all duration-200;
    @apply border border-gray-800;
}

.card:hover {
    @apply border-gray-700;
    transform: translateY(-2px);
}

.btn-primary {
    @apply bg-gray-800 text-white px-4 py-2 rounded-lg;
    @apply hover:bg-gray-700 transition-colors duration-200;
}
</style> 