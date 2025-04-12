@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Objectifs des utilisateurs</h3>
                    <a href="{{ route('coach.user-goals.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nouvel objectif
                    </a>
                </div>

                <div class="card-body">
                    <!-- Formulaire de recherche et filtrage -->
                    <form method="GET" action="{{ route('coach.user-goals.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Rechercher..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="filters[user_id]" class="form-control">
                                        <option value="">Tous les utilisateurs</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{ request('filters.user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="filters[status]" class="form-control">
                                        <option value="">Tous les statuts</option>
                                        <option value="pending" {{ request('filters.status') == 'pending' ? 'selected' : '' }}>En attente</option>
                                        <option value="in_progress" {{ request('filters.status') == 'in_progress' ? 'selected' : '' }}>En cours</option>
                                        <option value="completed" {{ request('filters.status') == 'completed' ? 'selected' : '' }}>Terminé</option>
                                        <option value="cancelled" {{ request('filters.status') == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search"></i> Filtrer
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Tableau des objectifs -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="{{ route('coach.user-goals.index', array_merge(request()->all(), [
                                            'sort_by' => 'title',
                                            'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc'
                                        ])) }}">
                                            Titre
                                            @if(request('sort_by') == 'title')
                                                <i class="fas fa-sort-{{ request('sort_direction') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Utilisateur</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Statut</th>
                                    <th>Progression</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($userGoals as $goal)
                                    <tr>
                                        <td>{{ $goal->title }}</td>
                                        <td>{{ $goal->user->name }}</td>
                                        <td>{{ $goal->start_date->format('d/m/Y') }}</td>
                                        <td>{{ $goal->end_date->format('d/m/Y') }}</td>
                                        <td>
                                            <span class="badge badge-{{ $goal->status_color }}">
                                                {{ $goal->status_label }}
                                            </span>
                                        </td>
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
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('coach.user-goals.show', $goal) }}" 
                                                   class="btn btn-sm btn-info" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('coach.user-goals.edit', $goal) }}" 
                                                   class="btn btn-sm btn-primary" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('coach.user-goals.destroy', $goal) }}" 
                                                      method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" 
                                                            title="Supprimer" onclick="return confirm('Êtes-vous sûr ?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Aucun objectif trouvé</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $userGoals->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 