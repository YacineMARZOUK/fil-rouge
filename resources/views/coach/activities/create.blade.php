@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Ajouter une nouvelle activité</h1>

        <form action="{{ route('coach.activities.store') }}" method="POST" class="space-y-6">
            @csrf

            <div class="card">
                <div class="space-y-4">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-400 mb-1">Nom de l'activité</label>
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
                        <label for="program_id" class="block text-sm font-medium text-gray-400 mb-1">Programme associé</label>
                        <select name="program_id" id="program_id" class="input-field w-full @error('program_id') border-red-500 @enderror">
                            <option value="">Sélectionner un programme</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                    {{ $program->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('program_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-400 mb-1">Date et heure</label>
                        <input type="datetime-local" name="date" id="date" class="input-field w-full @error('date') border-red-500 @enderror" value="{{ old('date') }}" required>
                        @error('date')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="duration" class="block text-sm font-medium text-gray-400 mb-1">Durée (minutes)</label>
                        <input type="number" name="duration" id="duration" min="15" step="15" class="input-field w-full @error('duration') border-red-500 @enderror" value="{{ old('duration', 60) }}" required>
                        @error('duration')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-400 mb-1">Client associé</label>
                        <select name="user_id" id="user_id" class="input-field w-full @error('user_id') border-red-500 @enderror" required>
                            <option value="">Sélectionner un client</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('coach.activities.index') }}" class="btn-secondary">
                    Annuler
                </a>
                <button type="submit" class="btn-primary">
                    Créer l'activité
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 