@extends('layouts.app')

@section('content')
<div class="py-12 bg-black">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="form-container">
            <div class="flex justify-between items-center mb-6">
                <h1 class="form-title">Créer une Activité</h1>
                <a href="{{ route('coach.activities.index') }}" class="form-button-secondary">
                    Retour aux activités
                </a>
            </div>

            @if($errors->any())
                <div class="form-error mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('coach.activities.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Nom de l'activité</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="form-input" placeholder="Nom de l'activité">
                </div>

                <div class="form-group">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" rows="4" required
                              class="form-textarea" placeholder="Description détaillée de l'activité">{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="form-group">
                        <label for="duration" class="form-label">Durée (en minutes)</label>
                        <input type="number" name="duration" id="duration" value="{{ old('duration') }}" required min="1"
                               class="form-input" placeholder="60">
                    </div>

                    <div class="form-group">
                        <label for="program_id" class="form-label">Programme associé</label>
                        <select name="program_id" id="program_id" class="form-select">
                            <option value="">Sélectionnez un programme</option>
                            @foreach($programs as $program)
                                <option value="{{ $program->id }}" {{ old('program_id') == $program->id ? 'selected' : '' }}>
                                    {{ $program->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="form-button-primary">
                        Créer l'activité
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 