@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 pt-12">
    <div class="flex justify-center">
        <div class="w-full max-w-4xl">
            <div class="bg_black">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-800">
                    <h3 class="text-xl font-semibold">Détails de l'activité</h3>
                    <div class="flex gap-2">
                        <a href="{{ route('coach.activities.edit', $activity) }}" class="btn-primary">
                            <i class="fas fa-edit mr-2"></i> Modifier
                        </a>
                        <a href="{{ route('coach.activities.index') }}" class="bg-gray-700 text-light px-4 py-2 rounded-full hover:bg-gray-600 transition-all duration-300 text-sm font-medium">
                            <i class="fas fa-arrow-left mr-2"></i> Retour
                        </a>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <h5 class="text-lg font-semibold mb-4 text-primary">Informations générales</h5>
                            <table class="w-full text-sm text-left">
                                <tbody class="divide-y divide-gray-800">
                                    <tr>
                                        <th class="py-2 font-medium text-gray-300">Nom :</th>
                                        <td class="py-2">{{ $activity->name }}</td>
                                    </tr>
                                    <tr>
                                        <th class="py-2 font-medium text-gray-300">Date :</th>
                                        <td class="py-2">{{ $activity->date->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th class="py-2 font-medium text-gray-300">Durée :</th>
                                        <td class="py-2">{{ $activity->duration }} minutes</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <h5 class="text-lg font-semibold mb-4 text-primary">Description</h5>
                            <p class="text-gray-300">{{ $activity->description ?? 'Aucune description' }}</p>
                        </div>
                    </div>

                    <div>
                        <h5 class="text-lg font-semibold mb-4 text-primary">Liste des participants</h5>
                        @if($activity->participants->count() > 0)
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-gray-900 border border-gray-800 text-sm">
                                    <thead class="bg-gray-800">
                                        <tr>
                                            <th class="py-3 px-4 text-left font-semibold text-gray-300">Nom</th>
                                            <th class="py-3 px-4 text-left font-semibold text-gray-300">Email</th>
                                            <th class="py-3 px-4 text-left font-semibold text-gray-300">Date d'inscription</th>
                                            <th class="py-3 px-4 text-left font-semibold text-gray-300">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-800">
                                        @foreach($activity->participants as $participant)
                                            <tr>
                                                <td class="py-2 px-4">{{ $participant->name }}</td>
                                                <td class="py-2 px-4">{{ $participant->email }}</td>
                                                <td class="py-2 px-4">{{ $participant->pivot->created_at->format('d/m/Y H:i') }}</td>
                                                <td class="py-2 px-4">
                                                    <form action="{{ route('coach.activities.remove-participant', [$activity, $participant]) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700" 
                                                                onclick="return confirm('Êtes-vous sûr de vouloir retirer ce participant ?')">
                                                            <i class="fas fa-user-minus mr-1"></i> Retirer
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="text-gray-500">Aucun participant pour le moment</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 