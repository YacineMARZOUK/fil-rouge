@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-center">
        <div class="w-full">
            <div class="bg-black rounded-lg shadow-md">
                <div class="p-6">
                    <!-- Formulaire de recherche et filtrage -->
                    <form method="GET" action="{{ route('coach.clients.index') }}" class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <input type="text" name="search" class="w-full text-black rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                       placeholder="Rechercher..." value="{{ request('search') }}">
                            </div>
                            <div>
                                <select name="filters[objectif_principal]" class="w-full rounded-md text-black border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="">Tous les objectifs</option>
                                    <option value="perte_poids" {{ request('filters.objectif_principal') == 'perte_poids' ? 'selected' : '' }}>Perte de poids</option>
                                    <option value="prise_masse" {{ request('filters.objectif_principal') == 'prise_masse' ? 'selected' : '' }}>Prise de masse</option>
                                </select>
                            </div>
                            
                            
                            <div>
                                <button type="submit" class="w-full bg-lime-400 hover:bg-lime-500 text-gray-900 font-bold py-2 px-4 rounded">
                                    <i class="fas fa-search"></i> Filtrer
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Tableau des objectifs -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-900 text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Utilisateur</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Sexe</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Âge</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Taille</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Poids</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Niveau d'activité</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Objectif principal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Besoins caloriques</th>
                                </tr>
                            </thead>
                            <tbody class="bg-black divide-y divide-gray-200">
                                @forelse($userGoals as $goal)
                                    <tr class="">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $goal->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($goal->sexe) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $goal->age }} ans</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $goal->taille_formatted }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $goal->poids_formatted }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $goal->niveau_activite_formatted }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $goal->objectif_principal_formatted }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $goal->besoins_caloriques }} kcal</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-4 text-center">Aucun objectif trouvé</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center mt-6">
                        {{ $userGoals->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection