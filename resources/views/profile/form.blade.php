@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="px-4 py-5 sm:p-6">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Complétez votre profil</h2>
                
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-red-700">
                                    Veuillez corriger les erreurs suivantes :
                                </p>
                                <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
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
                            <label for="sexe" class="block text-sm font-medium text-gray-700">Sexe</label>
                            <select id="sexe" name="sexe" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md" required>
                                <option value="">Sélectionnez votre sexe</option>
                                <option value="homme" {{ old('sexe') == 'homme' ? 'selected' : '' }}>Homme</option>
                                <option value="femme" {{ old('sexe') == 'femme' ? 'selected' : '' }}>Femme</option>
                            </select>
                            @error('sexe')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="age" class="block text-sm font-medium text-gray-700">Âge</label>
                            <input type="number" name="age" id="age" value="{{ old('age') }}" class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('age')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="taille" class="block text-sm font-medium text-gray-700">Taille (cm)</label>
                            <input type="number" name="taille" id="taille" value="{{ old('taille') }}" class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('taille')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="poids" class="block text-sm font-medium text-gray-700">Poids (kg)</label>
                            <input type="number" name="poids" id="poids" value="{{ old('poids') }}" class="mt-1 focus:ring-primary focus:border-primary block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            @error('poids')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="niveau_activite" class="block text-sm font-medium text-gray-700">Niveau d'activité</label>
                            <select id="niveau_activite" name="niveau_activite" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md" required>
                                <option value="">Sélectionnez votre niveau d'activité</option>
                                <option value="sedentaire" {{ old('niveau_activite') == 'sedentaire' ? 'selected' : '' }}>Sédentaire</option>
                                <option value="leger" {{ old('niveau_activite') == 'leger' ? 'selected' : '' }}>Léger</option>
                                <option value="modere" {{ old('niveau_activite') == 'modere' ? 'selected' : '' }}>Modéré</option>
                                <option value="actif" {{ old('niveau_activite') == 'actif' ? 'selected' : '' }}>Actif</option>
                                <option value="tres_actif" {{ old('niveau_activite') == 'tres_actif' ? 'selected' : '' }}>Très actif</option>
                            </select>
                            @error('niveau_activite')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="objectif_principal" class="block text-sm font-medium text-gray-700">Objectif principal</label>
                            <select id="objectif_principal" name="objectif_principal" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md" required>
                                <option value="">Sélectionnez votre objectif</option>
                                <option value="perte_poids" {{ old('objectif_principal') == 'perte_poids' ? 'selected' : '' }}>Perte de poids</option>
                                <option value="prise_muscle" {{ old('objectif_principal') == 'prise_muscle' ? 'selected' : '' }}>Prise de muscle</option>
                                <option value="maintien" {{ old('objectif_principal') == 'maintien' ? 'selected' : '' }}>Maintien</option>
                                <option value="endurance" {{ old('objectif_principal') == 'endurance' ? 'selected' : '' }}>Endurance</option>
                            </select>
                            @error('objectif_principal')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 