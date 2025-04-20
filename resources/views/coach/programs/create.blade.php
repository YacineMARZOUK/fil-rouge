@extends('layouts.app')

@section('content')
<div class="py-12 bg-black">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-black overflow-hidden shadow-xl sm:rounded-lg border border-[#5B5B5B]">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-[#CDFB47]">Créer un Programme</h1>
                    <a href="{{ route('coach.programs.index') }}" class="bg-[#5B5B5B] text-white px-4 py-2 rounded-md hover:bg-[#CDFB47] hover:text-black transition-colors duration-300">
                        Retour aux programmes
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

                <form action="{{ route('coach.programs.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-[#CDFB47]">Nom du programme</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required
                               class="mt-1 block w-full rounded-md bg-[#1A1A1A] border-[#5B5B5B] text-white shadow-sm focus:border-[#CDFB47] focus:ring focus:ring-[#CDFB47] focus:ring-opacity-50 placeholder-gray-400">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-[#CDFB47]">Description</label>
                        <textarea name="description" id="description" rows="4" required
                                  class="mt-1 block w-full rounded-md bg-[#1A1A1A] border-[#5B5B5B] text-white shadow-sm focus:border-[#CDFB47] focus:ring focus:ring-[#CDFB47] focus:ring-opacity-50 placeholder-gray-400">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="duration" class="block text-sm font-medium text-[#CDFB47]">Durée (en semaines)</label>
                            <input type="number" name="duration" id="duration" value="{{ old('duration') }}" required min="1"
                                   class="mt-1 block w-full rounded-md bg-[#1A1A1A] border-[#5B5B5B] text-white shadow-sm focus:border-[#CDFB47] focus:ring focus:ring-[#CDFB47] focus:ring-opacity-50">
                        </div>

                        <div class="mb-4">
                            <label for="difficulty" class="block text-sm font-medium text-[#CDFB47]">Niveau de difficulté</label>
                            <select id="difficulty" name="difficulty" class="mt-1 block w-full rounded-md bg-[#1A1A1A] border-[#5B5B5B] text-white shadow-sm focus:border-[#CDFB47] focus:ring focus:ring-[#CDFB47] focus:ring-opacity-50">
                                <option value="">Sélectionnez un niveau</option>
                                <option value="facile" {{ old('difficulty') == 'facile' ? 'selected' : '' }}>Facile</option>
                                <option value="moyen" {{ old('difficulty') == 'moyen' ? 'selected' : '' }}>Moyen</option>
                                <option value="difficile" {{ old('difficulty') == 'difficile' ? 'selected' : '' }}>Difficile</option>
                            </select>
                            @error('difficulty')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="objectif_cible" class="block text-sm font-medium text-[#CDFB47]">Objectif ciblé</label>
                        <select name="objectif_cible" id="objectif_cible" required
                                class="mt-1 block w-full rounded-md bg-[#1A1A1A] border-[#5B5B5B] text-white shadow-sm focus:border-[#CDFB47] focus:ring focus:ring-[#CDFB47] focus:ring-opacity-50">
                            <option value="">Sélectionnez un objectif</option>
                            <option value="perte_poids" {{ old('objectif_cible') == 'perte_poids' ? 'selected' : '' }}>Perte de poids</option>
                            <option value="prise_muscle" {{ old('objectif_cible') == 'prise_muscle' ? 'selected' : '' }}>Prise de muscle</option>
                            <option value="maintien" {{ old('objectif_cible') == 'maintien' ? 'selected' : '' }}>Maintien</option>
                            <option value="endurance" {{ old('objectif_cible') == 'endurance' ? 'selected' : '' }}>Endurance</option>
                        </select>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-[#CDFB47] text-black px-6 py-2 rounded-md hover:bg-[#5B5B5B] hover:text-[#CDFB47] transition-colors duration-300 font-semibold">
                            Créer le programme
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 