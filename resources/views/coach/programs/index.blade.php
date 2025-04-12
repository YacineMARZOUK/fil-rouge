@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Mes Programmes</h3>
                    <a href="{{ route('coach.programs.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nouveau Programme
                    </a>
                </div>

                <div class="card-body">
                    <!-- Formulaire de recherche et filtrage -->
                    <form method="GET" action="{{ route('coach.programs.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Rechercher..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="filters[difficulty_level]" class="form-control">
                                        <option value="">Niveau de difficulté</option>
                                        <option value="beginner" {{ request('filters.difficulty_level') == 'beginner' ? 'selected' : '' }}>
                                            Débutant
                                        </option>
                                        <option value="intermediate" {{ request('filters.difficulty_level') == 'intermediate' ? 'selected' : '' }}>
                                            Intermédiaire
                                        </option>
                                        <option value="advanced" {{ request('filters.difficulty_level') == 'advanced' ? 'selected' : '' }}>
                                            Avancé
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="filters[status]" class="form-control">
                                        <option value="">Statut</option>
                                        <option value="draft" {{ request('filters.status') == 'draft' ? 'selected' : '' }}>
                                            Brouillon
                                        </option>
                                        <option value="active" {{ request('filters.status') == 'active' ? 'selected' : '' }}>
                                            Actif
                                        </option>
                                        <option value="completed" {{ request('filters.status') == 'completed' ? 'selected' : '' }}>
                                            Terminé
                                        </option>
                                        <option value="cancelled" {{ request('filters.status') == 'cancelled' ? 'selected' : '' }}>
                                            Annulé
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="fas fa-search"></i> Filtrer
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Tableau des programmes -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="{{ route('coach.programs.index', array_merge(request()->all(), [
                                            'sort_by' => 'name',
                                            'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc'
                                        ])) }}">
                                            Nom
                                            @if(request('sort_by') == 'name')
                                                <i class="fas fa-sort-{{ request('sort_direction') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Client</th>
                                    <th>Niveau</th>
                                    <th>Statut</th>
                                    <th>Durée (semaines)</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($programs as $program)
                                    <tr>
                                        <td>{{ $program->name }}</td>
                                        <td>{{ $program->user->name }}</td>
                                        <td>
                                            <span class="badge badge-{{ $program->difficulty_level == 'beginner' ? 'success' : ($program->difficulty_level == 'intermediate' ? 'warning' : 'danger') }}">
                                                {{ ucfirst($program->difficulty_level) }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-{{ $program->status == 'active' ? 'success' : ($program->status == 'draft' ? 'secondary' : ($program->status == 'completed' ? 'info' : 'danger')) }}">
                                                {{ ucfirst($program->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $program->duration }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('coach.programs.show', $program) }}" 
                                                   class="btn btn-sm btn-info" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('coach.programs.edit', $program) }}" 
                                                   class="btn btn-sm btn-primary" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('coach.programs.destroy', $program) }}" 
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
                                        <td colspan="6" class="text-center">Aucun programme trouvé</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $programs->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 