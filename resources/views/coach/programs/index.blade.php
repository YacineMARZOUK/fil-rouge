@extends('layouts.app')

@section('content')
<div class="py-12 bg-black">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-black overflow-hidden shadow-xl sm:rounded-lg border border-[#5B5B5B]">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-3xl font-bold text-[#CDFB47]">Mes Programmes</h1>
                    <a href="{{ route('coach.programs.create') }}" class="bg-[#CDFB47] text-black px-4 py-2 rounded-md hover:bg-[#5B5B5B] hover:text-[#CDFB47] transition-colors duration-300">
                        Nouveau Programme
                    </a>
                </div>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <div class="mb-4">
                    <form method="GET" action="{{ route('coach.programs.index') }}" class="flex space-x-2">
                        <input 
                            type="text" 
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Rechercher un programme..." 
                            class="w-full rounded-md bg-[#1A1A1A] border-[#5B5B5B] text-white shadow-sm focus:border-[#CDFB47] focus:ring focus:ring-[#CDFB47] focus:ring-opacity-50 placeholder-gray-400">
                        
                        <button type="submit" class="bg-[#CDFB47] text-black px-4 py-2 rounded-md hover:bg-[#5B5B5B] hover:text-[#CDFB47] transition-colors duration-300">
                            Rechercher
                        </button>
                    </form>
                </div>
                
                

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($programs as $program)
                        <div class="bg-[#1A1A1A] rounded-lg shadow-lg overflow-hidden border border-[#5B5B5B]">
                            <div class="p-6">
                                <div class="flex justify-between items-start">
                                    <h2 class="text-xl font-semibold text-white mb-2">{{ $program->name }}</h2>
                                    <span class="px-2 py-1 text-xs font-semibold rounded
                                        @if($program->difficulty === 'facile') bg-green-100 text-green-800
                                        @elseif($program->difficulty === 'moyen') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ $program->difficulty }}
                                    </span>
                                </div>
                                <p class="text-gray-400 mb-4">{{ Str::limit($program->description, 100) }}</p>
                                <div class="flex items-center mb-4">
                                    <span class="text-sm text-[#CDFB47] mr-2">Durée:</span>
                                    <span class="text-white">{{ $program->duration }} semaines</span>
                                </div>
                                <div class="flex items-center mb-4">
                                    <span class="text-sm text-[#CDFB47] mr-2">Statut:</span>
                                    <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-800">Actif</span>
                                </div>
                                <div class="flex justify-between mt-4">
                                    <a href="{{ route('coach.programs.edit', $program) }}" 
                                       class="text-[#CDFB47] hover:text-white transition-colors duration-300">
                                        Modifier
                                    </a>
                                    <form action="{{ route('coach.programs.destroy', $program) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-500 hover:text-red-700 transition-colors duration-300"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce programme ?')">
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
            </div>
        </div>
    </div>
</div>
@endsection 