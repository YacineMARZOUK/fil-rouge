@extends('layouts.app')

@section('content')
<!-- En-tête de la page -->
<div class="bg-black py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-4 text-white">Programmes Recommandés</h1>
        <p class="text-gray-400">Découvrez les programmes personnalisés pour atteindre vos objectifs de fitness</p>
    </div>
</div>

<div class="container mx-auto px-4 py-8">
    @if(session('success'))
        <div class="bg-[#CDFB47] text-black px-4 py-3 rounded-lg shadow relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-500 text-white px-4 py-3 rounded-lg shadow relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if(isset($error))
        <div class="bg-[#CDFB47] text-black px-4 py-3 rounded-lg shadow relative mb-6" role="alert">
            <span class="block sm:inline">{{ $error }}</span>
            <a href="{{ route('profile.form') }}" class="text-black font-semibold underline">Compléter mon profil</a>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($programs as $programme)
                <div class="bg-black border border-gray-800 rounded-lg hover:shadow-lg hover:shadow-[#CDFB47]/20 transition-shadow duration-300">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-white mb-3">{{ $programme->name }}</h2>
                        <p class="text-gray-400 mb-4">{{ Str::limit($programme->description, 100) }}</p>
                        
                        <div class="flex items-center mb-4">
                            <span class="text-sm font-medium text-gray-400 mr-2">Difficulté:</span>
                            <span class="px-2 py-1 text-xs font-semibold rounded-full
                                @if($programme->difficulty === 'beginner') bg-[#CDFB47] text-black
                                @elseif($programme->difficulty === 'intermediate') bg-[#CDFB47]/70 text-black
                                @else bg-[#CDFB47]/40 text-black
                                @endif">
                                {{ ucfirst($programme->difficulty) }}
                            </span>
                        </div>
                        
                        <div class="flex items-center mb-4">
                            <span class="text-sm font-medium text-gray-400 mr-2">Durée:</span>
                            <span class="text-white">{{ $programme->duration }} semaines</span>
                        </div>

                        <form action="{{ route('programs.enroll', $programme) }}" method="POST" class="mt-6">
                            @csrf
                            <a href="{{ route('programs.details', $programme) }}" class="bg-[#CDFB47] hover:bg-[#CDFB47]/80 text-black font-medium py-2 px-4 rounded-lg w-full flex items-center justify-center transition-colors duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 12h14"></path>
                                    <path d="M12 5v14"></path>
                                </svg>
                                Commencer ce programme
                            </a>
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