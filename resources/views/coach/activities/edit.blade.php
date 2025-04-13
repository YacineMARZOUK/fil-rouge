@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-black rounded-lg p-6">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-[#CDFB47]">Modifier l'activité</h1>
                <p class="mt-2 text-gray-400">Met à jour les informations de cette activité</p>
            </div>

            <form method="POST" action="{{ route('coach.activities.update', $activity) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-[#CDFB47] text-lg font-medium mb-2">Nom de l'activité</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $activity->name) }}" required
                        class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] transition-colors duration-300"
                        placeholder="Nom de l'activité">
                </div>

                <div>
                    <label for="description" class="block text-[#CDFB47] text-lg font-medium mb-2">Description</label>
                    <textarea id="description" name="description" rows="4" required
                        class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] transition-colors duration-300"
                        placeholder="Description de l'activité">{{ old('description', $activity->description) }}</textarea>
                </div>

                <div>
                    <label for="program_id" class="block text-[#CDFB47] text-lg font-medium mb-2">Programme associé</label>
                    <select id="program_id" name="program_id"
                        class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white focus:border-[#CDFB47] transition-colors duration-300">
                        <option value="">Sélectionner un programme</option>
                        @foreach($programs as $program)
                            <option value="{{ $program->id }}"
                                {{ old('program_id', $activity->program_id) == $program->id ? 'selected' : '' }}>
                                {{ $program->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="date" class="block text-[#CDFB47] text-lg font-medium mb-2">Date et heure</label>
                    <input id="date" type="datetime-local" name="date"
                        value="{{ old('date', $activity->date->format('Y-m-d\TH:i')) }}" required
                        class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white focus:border-[#CDFB47] transition-colors duration-300">
                </div>

                

                

                <div>
                    <label for="duration" class="block text-[#CDFB47] text-lg font-medium mb-2">Durée (en minutes)</label>
                    <input id="duration" type="number" name="duration"
                        value="{{ old('duration', $activity->duration) }}" min="15" step="15" required
                        class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white focus:border-[#CDFB47] transition-colors duration-300"
                        placeholder="Durée de l'activité">
                </div>

                

                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="flex justify-between items-center pt-4">
                    <button type="submit"
                        class="bg-[#CDFB47] text-black px-6 py-3 rounded-lg text-lg font-semibold hover:bg-[#5B5B5B] hover:text-[#CDFB47] transition-all duration-300">
                        Mettre à jour
                    </button>
                    <a href="{{ route('coach.activities.show', $activity) }}"
                        class="text-[#CDFB47] hover:text-[#5B5B5B] transition-colors duration-300">
                        Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
