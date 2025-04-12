@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>Modifier le programme</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('coach.programs.update', $program) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="name">Nom du programme</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                   id="name" name="name" value="{{ old('name', $program->name) }}" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" required>{{ old('description', $program->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="user_id">Client</label>
                            <select class="form-control @error('user_id') is-invalid @enderror" 
                                    id="user_id" name="user_id" required>
                                <option value="">Sélectionnez un client</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id', $program->user_id) == $user->id ? 'selected' : '' }}>
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
                            <label for="duration">Durée (en semaines)</label>
                            <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                                   id="duration" name="duration" value="{{ old('duration', $program->duration) }}" min="1" required>
                            @error('duration')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="difficulty_level">Niveau de difficulté</label>
                            <select class="form-control @error('difficulty_level') is-invalid @enderror" 
                                    id="difficulty_level" name="difficulty_level" required>
                                <option value="">Sélectionnez un niveau</option>
                                <option value="beginner" {{ old('difficulty_level', $program->difficulty_level) == 'beginner' ? 'selected' : '' }}>
                                    Débutant
                                </option>
                                <option value="intermediate" {{ old('difficulty_level', $program->difficulty_level) == 'intermediate' ? 'selected' : '' }}>
                                    Intermédiaire
                                </option>
                                <option value="advanced" {{ old('difficulty_level', $program->difficulty_level) == 'advanced' ? 'selected' : '' }}>
                                    Avancé
                                </option>
                            </select>
                            @error('difficulty_level')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Statut</label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="">Sélectionnez un statut</option>
                                <option value="draft" {{ old('status', $program->status) == 'draft' ? 'selected' : '' }}>
                                    Brouillon
                                </option>
                                <option value="active" {{ old('status', $program->status) == 'active' ? 'selected' : '' }}>
                                    Actif
                                </option>
                                <option value="completed" {{ old('status', $program->status) == 'completed' ? 'selected' : '' }}>
                                    Terminé
                                </option>
                                <option value="cancelled" {{ old('status', $program->status) == 'cancelled' ? 'selected' : '' }}>
                                    Annulé
                                </option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                Mettre à jour
                            </button>
                            <a href="{{ route('coach.programs.show', $program) }}" class="btn btn-secondary">
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