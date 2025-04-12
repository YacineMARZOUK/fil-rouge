@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Détails de l'activité</h3>
                    <div>
                        <a href="{{ route('coach.activities.edit', $activity) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="{{ route('coach.activities.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Informations générales</h5>
                            <table class="table">
                                <tr>
                                    <th>Nom :</th>
                                    <td>{{ $activity->name }}</td>
                                </tr>
                                <tr>
                                    <th>Programme :</th>
                                    <td>
                                        @if($activity->program)
                                            <a href="{{ route('coach.programs.show', $activity->program) }}">
                                                {{ $activity->program->name }}
                                            </a>
                                        @else
                                            <span class="text-muted">Aucun programme</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Date :</th>
                                    <td>{{ $activity->date->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Lieu :</th>
                                    <td>{{ $activity->location }}</td>
                                </tr>
                                <tr>
                                    <th>Durée :</th>
                                    <td>{{ $activity->duration }} minutes</td>
                                </tr>
                                <tr>
                                    <th>Participants :</th>
                                    <td>
                                        <span class="badge badge-{{ $activity->participants->count() >= $activity->max_participants ? 'danger' : 'success' }}">
                                            {{ $activity->participants->count() }}/{{ $activity->max_participants }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Description</h5>
                            <p>{{ $activity->description ?? 'Aucune description' }}</p>

                            <h5 class="mt-4">Équipement nécessaire</h5>
                            <p>{{ $activity->equipment ?? 'Aucun équipement spécifique' }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h5>Liste des participants</h5>
                            @if($activity->participants->count() > 0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Email</th>
                                                <th>Date d'inscription</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($activity->participants as $participant)
                                                <tr>
                                                    <td>{{ $participant->name }}</td>
                                                    <td>{{ $participant->email }}</td>
                                                    <td>{{ $participant->pivot->created_at->format('d/m/Y H:i') }}</td>
                                                    <td>
                                                        <form action="{{ route('coach.activities.remove-participant', [$activity, $participant]) }}" 
                                                              method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                                    onclick="return confirm('Êtes-vous sûr de vouloir retirer ce participant ?')">
                                                                <i class="fas fa-user-minus"></i> Retirer
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">Aucun participant pour le moment</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 