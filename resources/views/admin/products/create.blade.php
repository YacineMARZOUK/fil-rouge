@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Ajouter un nouveau produit</h1>

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
                        <label for="title" class="block text-sm font-medium text-gray-400 mb-1">Nom du produit</label>
                        <input type="text" name="title" id="title" class="input-field w-full @error('title') border-red-500 @enderror" value="{{ old('title') }}" required>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-400 mb-1">Type de produit</label>
                        <select name="type" id="type" class="input-field w-full @error('type') border-red-500 @enderror" required>
                            <option value="">Sélectionnez un type</option>
                            @foreach($types as $value => $label)
                                <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
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
                        <label for="price" class="block text-sm font-medium text-gray-400 mb-1">Prix</label>
                        <input type="number" name="price" id="price" step="0.01" min="0" class="input-field w-full @error('price') border-red-500 @enderror" value="{{ old('price') }}" required>
                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="quantity" class="block text-sm font-medium text-gray-400 mb-1">Quantité</label>
                        <input type="number" name="quantity" id="quantity" min="0" class="input-field w-full @error('quantity') border-red-500 @enderror" value="{{ old('quantity') }}" required>
                        @error('quantity')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-400 mb-1">Image du produit</label>
                        <input type="file" name="image" id="image" accept="image/*" class="input-field w-full @error('image') border-red-500 @enderror" required>
                        <p class="text-sm text-gray-400 mt-1">Format accepté : JPEG, PNG, JPG, GIF. Taille maximale : 2MB</p>
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