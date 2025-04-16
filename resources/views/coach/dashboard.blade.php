@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Tableau de bord</h1>
        <a href="{{ route('coach.activities.create') }}" class="btn-primary flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nouvelle Activité
        </a>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="card">
            <h3 class="text-xl font-semibold mb-2">Total Clients</h3>
            <p class="text-4xl font-bold text-primary">{{ $stats['total_clients'] }}</p>
        </div>
        
        <div class="card">
            <h3 class="text-xl font-semibold mb-2">Programmes</h3>
            <p class="text-4xl font-bold text-primary">{{ $stats['total_programs'] }}</p>
        </div>
        
        <div class="card">
            <h3 class="text-xl font-semibold mb-2">Activités</h3>
            <p class="text-4xl font-bold text-primary">{{ $stats['total_activities'] }}</p>
        </div>
    </div>

    <!-- Prochaines activités -->
    <div class="card mb-8">
        <h2 class="text-2xl font-bold mb-4">Prochaines activités</h2>
        @if($stats['upcoming_activities']->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-800">
                            <th class="text-left py-3 px-4">Nom</th>
                            <th class="text-left py-3 px-4">Client</th>
                            <th class="text-left py-3 px-4">Date</th>
                            <th class="text-left py-3 px-4">Durée</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['upcoming_activities'] as $activity)
                            <tr class="border-b border-gray-800">
                                <td class="py-3 px-4">{{ $activity->name }}</td>
                                <td class="py-3 px-4">{{ $activity->user->name }}</td>
                                <td class="py-3 px-4">{{ $activity->date->format('d/m/Y H:i') }}</td>
                                <td class="py-3 px-4">{{ $activity->duration }} minutes</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-400">Aucune activité prévue</p>
        @endif
    </div>

    <!-- Actions rapides -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <a href="{{ route('coach.programs.index') }}" class="card hover:bg-gray-800 transition-colors">
            <h3 class="text-xl font-semibold mb-2">Gérer les programmes</h3>
            <p class="text-gray-400">Créer et gérer vos programmes d'entraînement</p>
        </a>
        
        <a href="{{ route('coach.activities.index') }}" class="card hover:bg-gray-800 transition-colors">
            <h3 class="text-xl font-semibold mb-2">Gérer les activités</h3>
            <p class="text-gray-400">Planifier et gérer vos séances d'entraînement</p>
        </a>
    </div>
</div>
@endsection 