@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Modifier le Produit</h1>
            <a href="{{ route('admin.products.index') }}" class="text-indigo-600 hover:text-indigo-900">
                Retour à la liste
            </a>
        </div>

        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                    Nom du produit
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                       id="name"
                       type="text"
                       name="name"
                       value="{{ old('name', $product->name) }}"
                       required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('description') border-red-500 @enderror"
                          id="description"
                          name="description"
                          rows="4"
                          required>{{ old('description', $product->description) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                    Catégorie
                </label>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('category') border-red-500 @enderror"
                        id="category"
                        name="category"
                        required>
                    <option value="">Sélectionnez une catégorie</option>
                    <option value="Protéines" {{ old('category', $product->category) == 'Protéines' ? 'selected' : '' }}>Protéines</option>
                    <option value="Créatine" {{ old('category', $product->category) == 'Créatine' ? 'selected' : '' }}>Créatine</option>
                    <option value="BCAA" {{ old('category', $product->category) == 'BCAA' ? 'selected' : '' }}>BCAA</option>
                    <option value="Pré-workout" {{ old('category', $product->category) == 'Pré-workout' ? 'selected' : '' }}>Pré-workout</option>
                    <option value="Vitamines" {{ old('category', $product->category) == 'Vitamines' ? 'selected' : '' }}>Vitamines</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="price">
                    Prix (€)
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('price') border-red-500 @enderror"
                       id="price"
                       type="number"
                       name="price"
                       step="0.01"
                       value="{{ old('price', $product->price) }}"
                       required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="stock">
                    Stock
                </label>
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('stock') border-red-500 @enderror"
                       id="stock"
                       type="number"
                       name="stock"
                       value="{{ old('stock', $product->stock) }}"
                       required>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="image">
                    Image
                </label>
                @if($product->image)
                    <div class="mb-2">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded">
                    </div>
                @endif
                <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('image') border-red-500 @enderror"
                       id="image"
                       type="file"
                       name="image"
                       accept="image/*">
                <p class="text-sm text-gray-500 mt-1">Laissez vide pour conserver l'image actuelle</p>
            </div>

            <div class="flex items-center justify-between">
                <button class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Mettre à jour le produit
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 