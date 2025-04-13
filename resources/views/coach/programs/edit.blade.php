@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-black rounded-lg p-6">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-4xl font-bold text-[#CDFB47]">Modifier le Programme</h1>
                <a href="{{ route('coach.programs.index') }}" 
                   class="bg-[#5B5B5B] text-white px-6 py-2 rounded-lg hover:bg-[#CDFB47] hover:text-black transition-all duration-300">
                    Retour aux programmes
                </a>
            </div>

            <form action="{{ route('coach.programs.update', $program->id) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-[#CDFB47] text-lg font-medium mb-2">
                            Nom du programme
                        </label>
                        <input type="text" name="name" id="name" 
                               class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300"
                               placeholder="Entrez le nom du programme"
                               value="{{ old('name', $program->name) }}" required>
                    </div>

                    <div>
                        <label for="description" class="block text-[#CDFB47] text-lg font-medium mb-2">
                            Description
                        </label>
                        <textarea name="description" id="description" rows="4" 
                                  class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300"
                                  placeholder="Décrivez le programme">{{ old('description', $program->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="duration" class="block text-[#CDFB47] text-lg font-medium mb-2">
                                Durée (en semaines)
                            </label>
                            <input type="number" name="duration" id="duration" min="1"
                                   class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300"
                                   placeholder="Nombre de semaines"
                                   value="{{ old('duration', $program->duration) }}" required>
                        </div>

                        <div>
                            <label for="difficulty_level" class="block text-[#CDFB47] text-lg font-medium mb-2">
                                Niveau de difficulté
                            </label>
                            <select name="difficulty_level" id="difficulty_level" required
                                    class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300">
                                <option value="">Sélectionnez un niveau</option>
                                <option value="beginner" {{ old('difficulty_level', $program->difficulty_level) == 'beginner' ? 'selected' : '' }}>Débutant</option>
                                <option value="intermediate" {{ old('difficulty_level', $program->difficulty_level) == 'intermediate' ? 'selected' : '' }}>Intermédiaire</option>
                                <option value="advanced" {{ old('difficulty_level', $program->difficulty_level) == 'advanced' ? 'selected' : '' }}>Avancé</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="objectif_cible" class="block text-[#CDFB47] text-lg font-medium mb-2">
                                Objectif ciblé
                            </label>
                            <select name="objectif_cible" id="objectif_cible" required
                                    class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300">
                                <option value="">Sélectionnez un objectif</option>
                                <option value="perte_poids" {{ old('objectif_cible', $program->objectif_cible) == 'perte_poids' ? 'selected' : '' }}>Perte de poids</option>
                                <option value="prise_muscle" {{ old('objectif_cible', $program->objectif_cible) == 'prise_muscle' ? 'selected' : '' }}>Prise de muscle</option>
                                <option value="maintien" {{ old('objectif_cible', $program->objectif_cible) == 'maintien' ? 'selected' : '' }}>Maintien</option>
                                <option value="endurance" {{ old('objectif_cible', $program->objectif_cible) == 'endurance' ? 'selected' : '' }}>Endurance</option>
                            </select>
                        </div>

                        <div>
                            <label for="status" class="block text-[#CDFB47] text-lg font-medium mb-2">
                                Statut
                            </label>
                            <select name="status" id="status" required
                                    class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300">
                                <option value="active" {{ old('status', $program->status) == 'active' ? 'selected' : '' }}>Actif</option>
                                <option value="inactive" {{ old('status', $program->status) == 'inactive' ? 'selected' : '' }}>Inactif</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="user_id" class="block text-[#CDFB47] text-lg font-medium mb-2">
                            Client associé
                        </label>
                        <select name="user_id" id="user_id" required
                                class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300">
                            <option value="">Sélectionnez un client</option>
                            @foreach($clients as $client)
                                <option value="{{ $client->id }}" {{ old('user_id', $program->user_id) == $client->id ? 'selected' : '' }}>
                                    {{ $client->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="flex justify-end">
                    <button type="submit" 
                            class="bg-[#CDFB47] text-black px-8 py-3 rounded-lg text-lg font-semibold hover:bg-[#5B5B5B] hover:text-[#CDFB47] transition-all duration-300">
                        Mettre à jour le programme
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
