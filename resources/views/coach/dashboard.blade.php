@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white">Tableau de bord coach</h1>
        <a href="{{ route('coach.programs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg shadow flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nouveau Programme
        </a>
    </div>

    <!-- Statistiques -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-black overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Clients</p>
                        <p class="text-2xl font-semibold text-white">{{ $stats['total_clients'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-black overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Programmes</p>
                        <p class="text-2xl font-semibold text-white">{{ $stats['total_programs'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-black overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Activités</p>
                        <p class="text-2xl font-semibold text-white">{{ $stats['total_activities'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Programmes récents -->
            <div class="bg-black overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-400 mb-4">Programmes Récents</h2>
                    @if($recent_programs->isEmpty())
                        <p class="text-gray-500">Aucun programme récent</p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full">
                                <thead>
                                    <tr class="border-b border-gray-700">
                                        <th class="text-left py-3 px-4 text-gray-400">Nom</th>
                                        <th class="text-left py-3 px-4 text-gray-400">Durée</th>
                                        <th class="text-left py-3 px-4 text-gray-400">Niveau</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recent_programs as $program)
                                        <tr class="border-b border-gray-700">
                                            <td class="py-3 px-4 text-white">{{ $program->name }}</td>
                                            <td class="py-3 px-4 text-gray-400">{{ $program->duration_formatted }}</td>
                                            <td class="py-3 px-4">
                                                <span class="px-2 py-1 rounded-full text-xs font-medium {{ 
                                                    match($program->difficulty_level) {
                                                        'beginner' => 'bg-green-600 text-white',
                                                        'intermediate' => 'bg-yellow-600 text-white',
                                                        'advanced' => 'bg-red-600 text-white',
                                                        default => 'bg-gray-600 text-white'
                                                    }
                                                }}">
                                                    {{ $program->difficulty_level_formatted }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        
        </div>
        
        <!-- Actions rapides -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <a href="{{ route('coach.programs.index') }}" class="bg-black hover:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-6 transition-colors">
                <h3 class="text-xl font-semibold mb-2 text-white">Gérer les programmes</h3>
                <p class="text-gray-400">Créer et modifier les programmes d'entraînement</p>
            </a>
            
            <a href="{{ route('coach.clients.index') }}" class="bg-black hover:bg-gray-900 overflow-hidden shadow-xl sm:rounded-lg p-6 transition-colors">
                <h3 class="text-xl font-semibold mb-2 text-white">Gérer les clients</h3>
                <p class="text-gray-400">Suivre les progrès et objectifs des clients</p>
            </a>
        </div>
    </div>
</div>
@endsection