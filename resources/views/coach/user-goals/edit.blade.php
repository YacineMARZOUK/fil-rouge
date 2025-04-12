@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Modifier l'objectif</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('coach.user-goals.update', $goal) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="title">Titre de l'objectif</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title', $goal->title) }}" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3">{{ old('description', $goal->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="user_id">Utilisateur</label>
                            <select class="form-control @error('user_id') is-invalid @enderror" 
                                    id="user_id" name="user_id" required>
                                <option value="">Sélectionner un utilisateur</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" 
                                            {{ old('user_id', $goal->user_id) == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="start_date">Date de début</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                   id="start_date" name="start_date" 
                                   value="{{ old('start_date', $goal->start_date->format('Y-m-d')) }}" required>
                            @error('start_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="end_date">Date de fin</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                   id="end_date" name="end_date" 
                                   value="{{ old('end_date', $goal->end_date->format('Y-m-d')) }}" required>
                            @error('end_date')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="target_value">Valeur cible</label>
                            <input type="number" class="form-control @error('target_value') is-invalid @enderror" 
                                   id="target_value" name="target_value" 
                                   value="{{ old('target_value', $goal->target_value) }}" 
                                   min="0" step="0.1" required>
                            @error('target_value')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="unit">Unité de mesure</label>
                            <input type="text" class="form-control @error('unit') is-invalid @enderror" 
                                   id="unit" name="unit" value="{{ old('unit', $goal->unit) }}" required>
                            <small class="form-text text-muted">
                                Exemple : kg, km, répétitions, etc.
                            </small>
                            @error('unit')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Statut</label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="pending" {{ old('status', $goal->status) == 'pending' ? 'selected' : '' }}>
                                    En attente
                                </option>
                                <option value="in_progress" {{ old('status', $goal->status) == 'in_progress' ? 'selected' : '' }}>
                                    En cours
                                </option>
                                <option value="completed" {{ old('status', $goal->status) == 'completed' ? 'selected' : '' }}>
                                    Terminé
                                </option>
                                <option value="cancelled" {{ old('status', $goal->status) == 'cancelled' ? 'selected' : '' }}>
                                    Annulé
                                </option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="notes">Notes</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" 
                                      id="notes" name="notes" rows="2">{{ old('notes', $goal->notes) }}</textarea>
                            @error('notes')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                Mettre à jour
                            </button>
                            <a href="{{ route('coach.user-goals.show', $goal) }}" class="btn btn-secondary">
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