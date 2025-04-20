@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Clients</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_clients'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Programmes</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_programs'] }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-500">Total Activités</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $stats['total_activities'] }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Programmes récents -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Programmes Récents</h2>
                    @if($recent_programs->isEmpty())
                        <p class="text-gray-500">Aucun programme récent</p>
                    @else
                        <div class="space-y-4">
                            @foreach($recent_programs as $program)
                                <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                    <div>
                                        <h3 class="font-medium text-gray-900">{{ $program->name }}</h3>
                                        <p class="text-sm text-gray-500">{{ $program->duration_formatted }}</p>
                                    </div>
                                    <span class="px-3 py-1 rounded-full text-sm font-medium {{ 
                                        match($program->difficulty_level) {
                                            'beginner' => 'bg-green-100 text-green-800',
                                            'intermediate' => 'bg-yellow-100 text-yellow-800',
                                            'advanced' => 'bg-red-100 text-red-800',
                                            default => 'bg-gray-100 text-gray-800'
                                        }
                                    }}">
                                        {{ $program->difficulty_level_formatted }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Objectifs récents -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Objectifs Clients Récents</h2>
                    @if($recent_goals->isEmpty())
                        <p class="text-gray-500">Aucun objectif récent</p>
                    @else
                        <div class="space-y-4">
                            @foreach($recent_goals as $goal)
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <div class="flex justify-between items-start mb-2">
                                        <h3 class="font-medium text-gray-900">{{ $goal->user->name }}</h3>
                                        <span class="text-sm text-gray-500">{{ $goal->created_at->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        <p><span class="font-medium">Objectif:</span> {{ ucfirst($goal->objectif_principal) }}</p>
                                        <p><span class="font-medium">Niveau:</span> {{ ucfirst($goal->niveau_activite) }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 