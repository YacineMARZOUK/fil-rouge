@extends('layouts.app')

@section('content')
<div class="bg-dark">
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-4xl font-bold mb-8 text-center text-white">Mon Profil</h1>
            
            @if(session('success'))
                <div class="bg-green-600 text-white px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-900 rounded-lg p-8 shadow-xl">
                <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-400">Nom</label>
                        <input type="text" name="name" id="name" required 
                               class="input-field mt-1 block w-full @error('name') border-red-500 @enderror" 
                               value="{{ old('name', $user->name) }}">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-400">Email</label>
                        <input type="email" name="email" id="email" required 
                               class="input-field mt-1 block w-full @error('email') border-red-500 @enderror" 
                               value="{{ old('email', $user->email) }}">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="border-t border-gray-800 pt-6 mt-6">
                        <h3 class="text-lg font-medium text-white mb-4">Changer le mot de passe</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-400">
                                    Mot de passe actuel
                                </label>
                                <input type="password" name="current_password" id="current_password"
                                       class="input-field mt-1 block w-full @error('current_password') border-red-500 @enderror">
                                @error('current_password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-400">
                                    Nouveau mot de passe
                                </label>
                                <input type="password" name="password" id="password"
                                       class="input-field mt-1 block w-full @error('password') border-red-500 @enderror">
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-400">
                                    Confirmer le nouveau mot de passe
                                </label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="input-field mt-1 block w-full">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end pt-6">
                        <button type="submit" class="btn-primary">
                            Mettre à jour le profil
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection 