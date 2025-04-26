@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-8 text-gray-200">Ajouter un nouveau produit</h1>

        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="card">
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-400 mb-1">Nom du produit</label>
                        <input type="text" name="name" id="name" class="input-field w-full @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
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
                        <textarea name="description" id="description" rows="4" class="input-field w-full @error('description') border-red-500 @enderror" required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-400 mb-1">Prix (€)</label>
                        <input type="number" name="price" id="price" step="0.01" min="0" class="input-field w-full @error('price') border-red-500 @enderror" value="{{ old('price') }}" required>
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-400 mb-1">Quantité en stock</label>
                        <input type="number" name="stock" id="stock" min="0" class="input-field w-full @error('stock') border-red-500 @enderror" value="{{ old('stock') }}" required>
                        @error('stock')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-400 mb-1">Image du produit</label>
                        <input type="file" name="image" id="image" accept="image/*" class="input-field w-full @error('image') border-red-500 @enderror" required>
                        <p class="text-sm text-gray-400 mt-1">Formats acceptés : JPEG, PNG, JPG, GIF. Taille maximale : 2MB</p>
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
                    Ajouter le produit
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
    @apply focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent;
}

.btn-primary {
    @apply bg-blue-600 text-white px-6 py-2 rounded-lg;
    @apply hover:bg-blue-700 transition-colors duration-200;
}

.btn-secondary {
    @apply bg-gray-700 text-white px-6 py-2 rounded-lg;
    @apply hover:bg-gray-600 transition-colors duration-200;
}

input[type="file"].input-field {
    @apply file:mr-4 file:py-2 file:px-4;
    @apply file:rounded-lg file:border-0;
    @apply file:text-gray-200 file:bg-gray-700;
    @apply file:hover:bg-gray-600 file:transition-colors file:duration-200;
}
</style>
