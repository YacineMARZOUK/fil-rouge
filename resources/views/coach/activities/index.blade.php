@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>Mes Activités</h3>
                    <a href="{{ route('coach.activities.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nouvelle Activité
                    </a>
                </div>

                <div class="card-body">
                    <!-- Formulaire de recherche et filtrage -->
                    <form method="GET" action="{{ route('coach.activities.index') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="text" name="search" class="form-control" 
                                           placeholder="Rechercher..." value="{{ request('search') }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="date" name="start_date" class="form-control" 
                                           value="{{ request('start_date') }}" placeholder="Date début">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="date" name="end_date" class="form-control" 
                                           value="{{ request('end_date') }}" placeholder="Date fin">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select name="filters[program_id]" class="form-control">
                                        <option value="">Tous les programmes</option>
                                        @foreach($programs as $program)
                                            <option value="{{ $program->id }}" {{ request('filters.program_id') == $program->id ? 'selected' : '' }}>
                                                {{ $program->name }}
                                            </option>
                                        @endforeach
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

                    <!-- Tableau des activités -->
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>
                                        <a href="{{ route('coach.activities.index', array_merge(request()->all(), [
                                            'sort_by' => 'name',
                                            'sort_direction' => request('sort_direction') == 'asc' ? 'desc' : 'asc'
                                        ])) }}">
                                            Nom
                                            @if(request('sort_by') == 'name')
                                                <i class="fas fa-sort-{{ request('sort_direction') == 'asc' ? 'up' : 'down' }}"></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th>Programme</th>
                                    <th>Date</th>
                                    <th>Lieu</th>
                                    <th>Participants</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($activities as $activity)
                                    <tr>
                                        <td>{{ $activity->name }}</td>
                                        <td>
                                            @if($activity->program)
                                                {{ $activity->program->name }}
                                            @else
                                                <span class="text-muted">Aucun programme</span>
                                            @endif
                                        </td>
                                        <td>{{ $activity->date->format('d/m/Y H:i') }}</td>
                                        <td>{{ $activity->location }}</td>
                                        <td>
                                            <span class="badge badge-{{ $activity->participants->count() >= $activity->max_participants ? 'danger' : 'success' }}">
                                                {{ $activity->participants->count() }}/{{ $activity->max_participants }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('coach.activities.show', $activity) }}" 
                                                   class="btn btn-sm btn-info" title="Voir">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('coach.activities.edit', $activity) }}" 
                                                   class="btn btn-sm btn-primary" title="Modifier">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('coach.activities.destroy', $activity) }}" 
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
                                        <td colspan="6" class="text-center">Aucune activité trouvée</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="d-flex justify-content-center mt-4">
                        {{ $activities->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 