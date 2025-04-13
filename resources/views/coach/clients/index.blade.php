@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              

                <div class="card-body">
                    <!-- Formulaire de recherche et filtrage -->
                    <form method="GET" action="{{ route('coach.clients.index') }}" class="mb-4">
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
                                    <th>Utilisateur</th>
                                    <th>Sexe</th>
                                    <th>Âge</th>
                                    <th>Taille</th>
                                    <th>Poids</th>
                                    <th>Niveau d'activité</th>
                                    <th>Objectif principal</th>
                                    <th>Besoins caloriques</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($userGoals  as $goal)
                                    <tr>
                                        <td>{{ $goal->user->name }}</td>
                                        <td>{{ ucfirst($goal->sexe) }}</td>
                                        <td>{{ $goal->age }} ans</td>
                                        <td>{{ $goal->taille_formatted }}</td>
                                        <td>{{ $goal->poids_formatted }}</td>
                                        <td>{{ $goal->niveau_activite_formatted }}</td>
                                        <td>{{ $goal->objectif_principal_formatted }}</td>
                                        <td>{{ $goal->besoins_caloriques }} kcal</td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">Aucun objectif trouvé</td>
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