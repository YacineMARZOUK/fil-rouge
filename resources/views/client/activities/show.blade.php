@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 pt-12">
    <div class="flex justify-center">
        <div class="w-full max-w-4xl">
            <div class="bg_black">
                <div class="flex items-center justify-between px-6 py-4 border-b border-gray-800">
                    <h3 class="text-xl font-semibold">Détails de l'activité</h3>
                    <div class="flex gap-2">
                        <a href="{{ route('client.activities.index') }}" class="bg-gray-700 text-light px-4 py-2 rounded-full hover:bg-gray-600 transition-all duration-300 text-sm font-medium">
                            <i class="fas fa-arrow-left mr-2"></i> Retour
                        </a>
                        
                        @if(!$activity->participants()->where('user_id', Auth::id())->exists())
                            <form action="{{ route('client.activities.join', $activity) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="btn-primary">
                                    <i class="fas fa-plus-circle mr-2"></i> Rejoindre
                                </button>
                            </form>
                        @else
                            <span class="bg-green-600 text-white px-4 py-2 rounded-full text-sm font-medium">
                                <i class="fas fa-check-circle mr-2"></i> Inscrit
                            </span>
                        @endif
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
                                    <tr>
                                        <th class="py-2 font-medium text-gray-300">Coach :</th>
                                        <td class="py-2">{{ $activity->coach->name }}</td>
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
                        <h5 class="text-lg font-semibold mb-4 text-primary">Informations sur le coach</h5>
                        <div class="bg-black p-4 rounded-lg">
                            <div class="flex items-center gap-4 mb-4">
                                <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center text-2xl">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div>
                                    <h6 class="text-lg font-semibold">{{ $activity->coach->name }}</h6>
                                    <p class="text-gray-400">{{ $activity->coach->email }}</p>
                                </div>
                            </div>
                            @if($activity->coach->bio)
                                <div class="mb-4">
                                    <h6 class="text-sm font-semibold text-gray-300 mb-2">Biographie</h6>
                                    <p class="text-gray-400 text-sm">{{ $activity->coach->bio }}</p>
                                </div>
                            @endif
                            @if($activity->coach->speciality)
                                <div>
                                    <h6 class="text-sm font-semibold text-gray-300 mb-2">Spécialité</h6>
                                    <p class="text-gray-400 text-sm">{{ $activity->coach->speciality }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection