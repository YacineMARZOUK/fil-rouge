@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if(isset($error))
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ $error }}</span>
            <a href="{{ route('profile.form') }}" class="underline">Compléter mon profil</a>
        </div>
    @else
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Programmes Recommandés</h1>

        @if($programs->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-600">Aucun programme ne correspond à vos critères pour le moment.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($programs as $program)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $program->name }}</h2>
                            <p class="text-gray-600 mb-4">{{ Str::limit($program->description, 100) }}</p>
                            
                            <div class="flex items-center mb-4">
                                <span class="text-sm font-medium text-gray-500 mr-2">Difficulté:</span>
                                <span class="px-2 py-1 text-xs font-semibold rounded
                                    @if($program->difficulty === 'beginner') bg-green-100 text-green-800
                                    @elseif($program->difficulty === 'intermediate') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($program->difficulty) }}
                                </span>
                            </div>
                            
                            <div class="flex items-center mb-4">
                                <span class="text-sm font-medium text-gray-500 mr-2">Durée:</span>
                                <span class="text-gray-700">{{ $program->duration }} semaines</span>
                            </div>

                            <form action="{{ route('programs.assign', $program) }}" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 transition duration-200">
                                    Commencer ce programme
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $programs->links() }}
            </div>
        @endif
    @endif
</div>
@endsection 