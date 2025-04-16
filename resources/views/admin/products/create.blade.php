@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Ajouter un nouveau produit</h1>

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
                        <label for="description" class="block text-sm font-medium text-gray-400 mb-1">Description</label>
                        <textarea name="description" id="description" rows="4" class="input-field w-full @error('description') border-red-500 @enderror" required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-400 mb-1">Prix</label>
                        <input type="number" name="price" id="price" step="0.01" min="0" class="input-field w-full @error('price') border-red-500 @enderror" value="{{ old('price') }}" required>
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="stock" class="block text-sm font-medium text-gray-400 mb-1">Stock</label>
                        <input type="number" name="stock" id="stock" min="0" class="input-field w-full @error('stock') border-red-500 @enderror" value="{{ old('stock') }}" required>
                        @error('stock')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-400 mb-1">Image du produit</label>
                        <input type="file" name="image" id="image" accept="image/*" class="input-field w-full @error('image') border-red-500 @enderror" required>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('admin.dashboard') }}" class="btn-secondary">
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