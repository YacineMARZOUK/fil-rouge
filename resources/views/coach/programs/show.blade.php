@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Détails du programme</h3>
                    <div class="btn-group">
                        <a href="{{ route('coach.programs.edit', $program) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="{{ route('coach.programs.index') }}" class="btn btn-secondary">
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
                                    <td>{{ $program->name }}</td>
                                </tr>
                                <tr>
                                    <th>Client :</th>
                                    <td>{{ $program->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Niveau :</th>
                                    <td>
                                        <span class="badge badge-{{ $program->difficulty_level == 'beginner' ? 'success' : ($program->difficulty_level == 'intermediate' ? 'warning' : 'danger') }}">
                                            {{ ucfirst($program->difficulty_level) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Statut :</th>
                                    <td>
                                        <span class="badge badge-{{ $program->status == 'active' ? 'success' : ($program->status == 'draft' ? 'secondary' : ($program->status == 'completed' ? 'info' : 'danger')) }}">
                                            {{ ucfirst($program->status) }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Durée :</th>
                                    <td>{{ $program->duration }} semaines</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Description</h5>
                            <p>{{ $program->description }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h5>Activités associées</h5>
                            @if($program->activities->count() > 0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nom</th>
                                                <th>Date</th>
                                                <th>Lieu</th>
                                                <th>Participants</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($program->activities as $activity)
                                                <tr>
                                                    <td>{{ $activity->name }}</td>
                                                    <td>{{ $activity->date->format('d/m/Y H:i') }}</td>
                                                    <td>{{ $activity->location }}</td>
                                                    <td>{{ $activity->participants->count() }}/{{ $activity->max_participants }}</td>
                                                    <td>
                                                        <a href="{{ route('coach.activities.show', $activity) }}" 
                                                           class="btn btn-sm btn-info">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    Aucune activité n'est associée à ce programme.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 