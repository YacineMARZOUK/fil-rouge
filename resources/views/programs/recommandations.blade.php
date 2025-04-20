@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-8">Programmes Recommandés</h1>

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
                @endif

                @if($programmes->isEmpty())
                    <div class="text-center py-12">
                        <p class="text-gray-500 text-lg">Aucun programme recommandé pour le moment.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($programmes as $programme)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow duration-300">
                                @if($programme->image)
                                    <img src="{{ asset('storage/' . $programme->image) }}" alt="{{ $programme->name }}" class="w-full h-48 object-cover">
                                @else
                                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                                
                                <div class="p-6">
                                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $programme->name }}</h2>
                                    <p class="text-gray-600 mb-4">{{ Str::limit($programme->description, 100) }}</p>
                                    
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ 
                                            match($programme->difficulty_level) {
                                                'beginner' => 'bg-green-100 text-green-800',
                                                'intermediate' => 'bg-yellow-100 text-yellow-800',
                                                'advanced' => 'bg-red-100 text-red-800',
                                                default => 'bg-gray-100 text-gray-800'
                                            }
                                        }}">
                                            {{ ucfirst($programme->difficulty_level) }}
                                        </span>
                                        <span class="text-sm text-gray-500">
                                            {{ $programme->duration }} semaines
                                        </span>
                                    </div>

                                    <form action="{{ route('programs.assign', $programme) }}" method="POST" class="mt-4">
                                        @csrf
                                        <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition-colors duration-300">
                                            S'inscrire au programme
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6">
                        {{ $programmes->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 