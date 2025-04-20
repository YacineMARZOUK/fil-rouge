@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">Mes Programmes</h1>
                    <a href="{{ route('coach.programs.create') }}" class="bg-primary text-dark px-6 py-2 rounded-full hover:bg-primary-dark transition-colors duration-300">
                        <i class="fas fa-plus mr-2"></i>Nouveau Programme
                    </a>
                </div>

                <!-- Barre de recherche et filtres -->
                <div class="mb-6 flex flex-col sm:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" placeholder="Rechercher un programme..." 
                               class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                    </div>
                    <div class="flex gap-4">
                        <select class="rounded-lg border border-gray-300 px-4 py-2 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            <option value="">Tous les niveaux</option>
                            <option value="beginner">Débutant</option>
                            <option value="intermediate">Intermédiaire</option>
                            <option value="advanced">Avancé</option>
                        </select>
                        <select class="rounded-lg border border-gray-300 px-4 py-2 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50">
                            <option value="">Tous les objectifs</option>
                            <option value="perte_poids">Perte de poids</option>
                            <option value="prise_muscle">Prise de muscle</option>
                            <option value="maintien">Maintien</option>
                            <option value="endurance">Endurance</option>
                        </select>
                    </div>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                @if($programs->isEmpty())
                    <div class="text-center py-12">
                        <div class="text-gray-500 text-lg mb-4">Aucun programme trouvé</div>
                        <a href="{{ route('coach.programs.create') }}" class="text-primary hover:text-primary-dark">
                            Créer votre premier programme
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($programs as $program)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow duration-300">
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <h2 class="text-xl font-semibold text-gray-900">{{ $program->name }}</h2>
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

                                    <p class="text-gray-600 mb-4">{{ Str::limit($program->description, 100) }}</p>

                                    <div class="flex items-center justify-between mb-4">
                                        <span class="text-sm text-gray-500">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ $program->duration_formatted }}
                                        </span>
                                        <span class="text-sm px-2 py-1 rounded {{ 
                                            $program->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'
                                        }}">
                                            {{ $program->status_formatted }}
                                        </span>
                                    </div>

                                    <div class="flex justify-between items-center pt-4 border-t border-gray-200">
                                        <a href="{{ route('coach.programs.edit', $program) }}" 
                                           class="text-blue-600 hover:text-blue-800 transition-colors duration-300">
                                            <i class="fas fa-edit mr-1"></i>
                                            Modifier
                                        </a>
                                        <form action="{{ route('coach.programs.destroy', $program) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800 transition-colors duration-300"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce programme ?')">
                                                <i class="fas fa-trash-alt mr-1"></i>
                                                Supprimer
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $programs->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 