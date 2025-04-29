@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-black rounded-lg p-6">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-[#CDFB47]">Complétez votre profil</h1>
                <p class="mt-2 text-gray-400">Personnalisez votre expérience</p>
            </div>
            
            @if ($errors->any())
                <div class="bg-red-900 border-l-4 border-red-500 p-4 mb-6 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-400">
                                Veuillez corriger les erreurs suivantes :
                            </p>
                            <ul class="mt-2 text-sm text-red-400 list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('profile.complete') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    <div>
                        <label for="sexe" class="block text-[#CDFB47] text-lg font-medium mb-2">Sexe</label>
                        <select id="sexe" name="sexe" class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300" required>
                            <option value="">Sélectionnez votre sexe</option>
                            <option value="homme" {{ old('sexe') == 'homme' ? 'selected' : '' }}>Homme</option>
                            <option value="femme" {{ old('sexe') == 'femme' ? 'selected' : '' }}>Femme</option>
                        </select>
                        @error('sexe')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="age" class="block text-[#CDFB47] text-lg font-medium mb-2">Âge</label>
                        <input type="number" name="age" id="age" value="{{ old('age') }}" class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300" required>
                        @error('age')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="taille" class="block text-[#CDFB47] text-lg font-medium mb-2">Taille (cm)</label>
                        <input type="number" name="taille" id="taille" value="{{ old('taille') }}" class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300" required>
                        @error('taille')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="poids" class="block text-[#CDFB47] text-lg font-medium mb-2">Poids (kg)</label>
                        <input type="number" name="poids" id="poids" value="{{ old('poids') }}" class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300" required>
                        @error('poids')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="niveau_activite" class="block text-[#CDFB47] text-lg font-medium mb-2">Niveau d'activité</label>
                        <select id="niveau_activite" name="niveau_activite" class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300" required>
                            <option value="">Sélectionnez votre niveau d'activité</option>
                            <option value="sedentaire" {{ old('niveau_activite') == 'sedentaire' ? 'selected' : '' }}>Sédentaire</option>
                            <option value="leger" {{ old('niveau_activite') == 'leger' ? 'selected' : '' }}>Léger</option>
                            <option value="modere" {{ old('niveau_activite') == 'modere' ? 'selected' : '' }}>Modéré</option>
                            <option value="actif" {{ old('niveau_activite') == 'actif' ? 'selected' : '' }}>Actif</option>
                            <option value="tres_actif" {{ old('niveau_activite') == 'tres_actif' ? 'selected' : '' }}>Très actif</option>
                        </select>
                        @error('niveau_activite')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="objectif_principal" class="block text-[#CDFB47] text-lg font-medium mb-2">Objectif principal</label>
                        <select id="objectif_principal" name="objectif_principal" class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300" required>
                            <option value="">Sélectionnez votre objectif</option>
                            <option value="perte_poids" {{ old('objectif_principal') == 'perte_poids' ? 'selected' : '' }}>Perte de poids</option>
                            <option value="prise_muscle" {{ old('objectif_principal') == 'prise_muscle' ? 'selected' : '' }}>Prise de muscle</option>
                            <option value="maintien" {{ old('objectif_principal') == 'maintien' ? 'selected' : '' }}>Maintien</option>
                            <option value="endurance" {{ old('objectif_principal') == 'endurance' ? 'selected' : '' }}>Endurance</option>
                        </select>
                        @error('objectif_principal')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-8">
                    <button type="submit" class="bg-[#CDFB47] text-black px-6 py-3 rounded-lg text-lg font-semibold hover:bg-[#5B5B5B] hover:text-[#CDFB47] transition-all duration-300">
                        Enregistrer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection