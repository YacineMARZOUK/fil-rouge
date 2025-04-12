@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Détails de l'objectif</h3>
                    <div>
                        <a href="{{ route('coach.user-goals.edit', $goal) }}" class="btn btn-primary">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <a href="{{ route('coach.user-goals.index') }}" class="btn btn-secondary">
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
                                    <th>Titre :</th>
                                    <td>{{ $goal->title }}</td>
                                </tr>
                                <tr>
                                    <th>Utilisateur :</th>
                                    <td>{{ $goal->user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Statut :</th>
                                    <td>
                                        <span class="badge badge-{{ $goal->status_color }}">
                                            {{ $goal->status_label }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Période :</th>
                                    <td>
                                        {{ $goal->start_date->format('d/m/Y') }} - 
                                        {{ $goal->end_date->format('d/m/Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Objectif :</th>
                                    <td>
                                        {{ $goal->target_value }} {{ $goal->unit }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>Progression :</th>
                                    <td>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" 
                                                 style="width: {{ $goal->progress }}%;" 
                                                 aria-valuenow="{{ $goal->progress }}" 
                                                 aria-valuemin="0" 
                                                 aria-valuemax="100">
                                                {{ $goal->progress }}%
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Description</h5>
                            <p>{{ $goal->description ?? 'Aucune description' }}</p>

                            <h5 class="mt-4">Notes</h5>
                            <p>{{ $goal->notes ?? 'Aucune note' }}</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <h5>Historique des mises à jour</h5>
                            @if($goal->updates->count() > 0)
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Valeur</th>
                                                <th>Progression</th>
                                                <th>Commentaire</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($goal->updates as $update)
                                                <tr>
                                                    <td>{{ $update->created_at->format('d/m/Y H:i') }}</td>
                                                    <td>{{ $update->current_value }} {{ $goal->unit }}</td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar" role="progressbar" 
                                                                 style="width: {{ $update->progress }}%;" 
                                                                 aria-valuenow="{{ $update->progress }}" 
                                                                 aria-valuemin="0" 
                                                                 aria-valuemax="100">
                                                                {{ $update->progress }}%
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $update->comment ?? 'Aucun commentaire' }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted">Aucune mise à jour pour le moment</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 