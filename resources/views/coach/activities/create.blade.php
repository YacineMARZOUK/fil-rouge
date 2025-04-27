@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-black rounded-lg p-6">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-[#CDFB47]">Créer une Activité</h1>
                <p class="mt-2 text-gray-400">Ajouter une nouvelle activité</p>
            </div>

            <form method="POST" action="{{ route('coach.activities.store') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-[#CDFB47] text-lg font-medium mb-2">
                        Nom de l'activité
                    </label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required
                           class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300"
                           placeholder="Nom de l'activité">
                </div>

                <div>
                    <label for="description" class="block text-[#CDFB47] text-lg font-medium mb-2">
                        Description
                    </label>
                    <textarea id="description" name="description" rows="4" required
                           class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300"
                           placeholder="Description détaillée de l'activité">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label for="date" class="block text-[#CDFB47] text-lg font-medium mb-2">
                        Date de l'activité
                    </label>
                    <input id="date" type="datetime-local" name="date" value="{{ old('date') }}" required
                           class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300">
                </div>

                <div>
                    <label for="duration" class="block text-[#CDFB47] text-lg font-medium mb-2">
                        Durée (en minutes)
                    </label>
                    <input id="duration" type="number" name="duration" value="{{ old('duration', 60) }}" required min="15"
                           class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300"
                           placeholder="60">
                </div>

                

                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <button type="submit"
                            class="w-full bg-[#CDFB47] text-black px-6 py-3 rounded-lg text-lg font-semibold hover:bg-[#5B5B5B] hover:text-[#CDFB47] transition-all duration-300">
                        Créer l'activité
                    </button>
                </div>

                <div class="text-center mt-6">
                    <a href="{{ route('coach.activities.index') }}" 
                       class="text-[#CDFB47] hover:text-[#5B5B5B] transition-colors duration-300">
                        Retour aux activités
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection