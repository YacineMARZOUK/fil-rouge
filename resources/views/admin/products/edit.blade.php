@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-gray-200">Modifier le produit</h1>

        @if($errors->any())
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="space-y-4">

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-400 mb-1">Nom du produit</label>
                        <input type="text" name="name" id="name" class="input-field w-full @error('name') border-red-500 @enderror" value="{{ old('name', $product->name) }}" required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-400 mb-1">Catégorie du produit</label>
                        <select name="type" id="type" class="input-field w-full @error('type') border-red-500 @enderror" required>
                            <option value="">Sélectionnez une catégorie</option>
                            <option value="nutrition" {{ old('type') == 'nutrition' ? 'selected' : '' }}>Nutrition</option>
                            <option value="vetement" {{ old('type') == 'vetement' ? 'selected' : '' }}>Vêtement</option>
                            <option value="accessoire" {{ old('type') == 'accessoire' ? 'selected' : '' }}>Accessoire</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-400 mb-1">Description</label>
                        <textarea name="description" id="description" rows="4" class="input-field w-full @error('description') border-red-500 @enderror" required>{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-400 mb-1">Prix (€)</label>
                        <input type="number" name="price" id="price" step="0.01" min="0" class="input-field w-full @error('price') border-red-500 @enderror" value="{{ old('price', $product->price) }}" required>
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-400 mb-1">Stock</label>
                        <input type="number" name="stock" id="stock" min="0" class="input-field w-full @error('stock') border-red-500 @enderror" value="{{ old('stock', $product->stock) }}" required>
                        @error('stock')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-400 mb-1">Image du produit</label>

                        @if($product->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded">
                            </div>
                        @endif

                        <input type="file" name="image" id="image" accept="image/*" class="input-field w-full @error('image') border-red-500 @enderror">
                        <p class="text-sm text-gray-400 mt-1">Laissez vide pour conserver l'image actuelle</p>

                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.products.index') }}" class="btn-secondary">
                    Annuler
                </a>
                <button type="submit" class="btn-primary">
                    Mettre à jour
                </button>
            </div>

        </form>
    </div>
</div>
@endsection

<style>
.card {
    @apply bg-gray-900 rounded-lg p-6;
    @apply border border-gray-800;
}
.input-field {
    @apply bg-gray-800 border border-gray-700 rounded-lg px-4 py-2;
    @apply text-gray-200 placeholder-gray-500;
    @apply focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent;
}
.btn-primary {
    @apply bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg transition duration-200;
}
.btn-secondary {
    @apply bg-gray-700 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition duration-200;
}
</style>
