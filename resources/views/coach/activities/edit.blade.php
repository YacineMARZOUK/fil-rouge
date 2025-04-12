@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Modifier l'activité</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('coach.activities.update', $activity) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nom de l'activité</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $activity->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description', $activity->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="program_id">Programme associé</label>
                            <select class="form-control @error('program_id') is-invalid @enderror" 
                                    id="program_id" name="program_id">
                                <option value="">Sélectionner un programme</option>
                                @foreach($programs as $program)
                                    <option value="{{ $program->id }}" 
                                            {{ old('program_id', $activity->program_id) == $program->id ? 'selected' : '' }}>
                                        {{ $program->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('program_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="date">Date et heure</label>
                            <input type="datetime-local" class="form-control @error('date') is-invalid @enderror" 
                                   id="date" name="date" 
                                   value="{{ old('date', $activity->date->format('Y-m-d\TH:i')) }}" required>
                            @error('date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="location">Lieu</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                   id="location" name="location" value="{{ old('location', $activity->location) }}" required>
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="max_participants">Nombre maximum de participants</label>
                            <input type="number" class="form-control @error('max_participants') is-invalid @enderror" 
                                   id="max_participants" name="max_participants" 
                                   value="{{ old('max_participants', $activity->max_participants) }}" 
                                   min="{{ $activity->participants->count() }}" required>
                            <small class="form-text text-muted">
                                Minimum : {{ $activity->participants->count() }} (nombre actuel de participants)
                            </small>
                            @error('max_participants')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="duration">Durée (en minutes)</label>
                            <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                                   id="duration" name="duration" value="{{ old('duration', $activity->duration) }}" 
                                   min="15" step="15" required>
                            @error('duration')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="equipment">Équipement nécessaire</label>
                            <textarea class="form-control @error('equipment') is-invalid @enderror" 
                                      id="equipment" name="equipment" rows="2">{{ old('equipment', $activity->equipment) }}</textarea>
                            @error('equipment')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                Mettre à jour
                            </button>
                            <a href="{{ route('coach.activities.show', $activity) }}" class="btn btn-secondary">
                                Annuler
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 