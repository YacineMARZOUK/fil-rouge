@extends('layouts.app')

@section('content')
<!-- En-tête de la page -->
<div class="bg-dark py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4">Programmes Recommandés</h1>
        <p class="text-gray-400">Découvrez les programmes personnalisés pour atteindre vos objectifs de fitness</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    @if(session('success'))
        <div class="bg-green-500 text-white px-4 py-3 rounded-lg shadow relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white px-4 py-3 rounded-lg shadow relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if(isset($error))
        <div class="bg-yellow-500 text-dark px-4 py-3 rounded-lg shadow relative mb-6" role="alert">
            <span class="block sm:inline">{{ $error }}</span>
            <a href="{{ route('profile.form') }}" class="text-dark font-semibold underline">Compléter mon profil</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($programs as $programme)
                <div class="card hover:shadow-lg transition-shadow duration-300">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-light mb-3">{{ $programme->name }}</h2>
                        <p class="text-gray-400 mb-4">{{ Str::limit($programme->description, 100) }}</p>
                        
                        <div class="flex items-center mb-4">
                            <span class="text-sm font-medium text-gray-400 mr-2">Difficulté:</span>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                @if($programme->difficulty === 'beginner') bg-green-500 text-dark
                                @elseif($programme->difficulty === 'intermediate') bg-yellow-500 text-dark
                                @else bg-red-500 text-white
                                @endif">
                                {{ ucfirst($programme->difficulty) }}
                            </span>
                        </div>
                        
                        <div class="flex items-center mb-4">
                            <span class="text-sm font-medium text-gray-400 mr-2">Durée:</span>
                            <span class="text-gray-300">{{ $programme->duration }} semaines</span>
                        </div>

                        <form action="{{ route('programs.enroll', $programme) }}" method="POST" class="mt-6">
                            @csrf
                            <button type="submit" class="btn-primary w-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5v14"></path>
                                </svg>
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
</div>
@endsection