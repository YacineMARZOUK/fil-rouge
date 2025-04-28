@extends('layouts.app')

@section('content')
<div class="py-12 bg-black">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-black overflow-hidden shadow-xl sm:rounded-lg border border-[#5B5B5B]">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-[#CDFB47]">Mes Clients</h1>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="mb-6">
                    <form method="GET" action="{{ route('coach.clients.index') }}" class="flex flex-col md:flex-row md:space-x-2 space-y-2 md:space-y-0">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Rechercher un client..." 
                            class="w-full rounded-md bg-[#1A1A1A] border-[#5B5B5B] text-white shadow-sm focus:border-[#CDFB47] focus:ring focus:ring-[#CDFB47] focus:ring-opacity-50 placeholder-gray-400">

                        <select 
                            name="filters[objectif_principal]" 
                            class="w-full rounded-md bg-[#1A1A1A] border-[#5B5B5B] text-white shadow-sm focus:border-[#CDFB47] focus:ring focus:ring-[#CDFB47] focus:ring-opacity-50">
                            <option value="">Tous les objectifs</option>
                            <option value="perte_poids" {{ request('filters.objectif_principal') == 'perte_poids' ? 'selected' : '' }}>Perte de poids</option>
                            <option value="prise_masse" {{ request('filters.objectif_principal') == 'prise_masse' ? 'selected' : '' }}>Prise de masse</option>
                        </select>

                        <button type="submit" 
                            class="bg-[#CDFB47] text-black px-4 py-2 rounded-md hover:bg-[#5B5B5B] hover:text-[#CDFB47] transition-colors duration-300">
                            Filtrer
                        </button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-[#5B5B5B]">
                        <thead class="bg-[#1A1A1A] text-[#CDFB47]">
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
                        <tbody class="bg-black divide-y divide-[#5B5B5B] text-white">
                            @forelse($userGoals as $goal)
                                <tr>
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
                                    <td colspan="8" class="px-6 py-4 text-center text-gray-400">Aucun objectif trouvé</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $userGoals->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
