@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black flex items-center justify-center py-12">
    <div class="max-w-xl w-full mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-black rounded-lg p-8 border-2 border-[#333333] shadow-lg">
            <div class="flex items-center mb-8">
                <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-[#CDFB47] mr-4 transition-colors duration-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                </a>
                <div class="text-center flex-grow">
                    <h1 class="text-4xl font-bold text-[#CDFB47]">Modifier l'utilisateur</h1>
                    <p class="mt-2 text-gray-400">Mettre à jour les informations du compte</p>
                </div>
            </div>

            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="name" class="block text-[#CDFB47] text-sm font-medium mb-2">
                        Nom
                    </label>
                    <div class="relative">
                        <input type="text" name="name" id="name"
                               value="{{ old('name', $user->name) }}"
                               class="w-full bg-[#1A1A1A] border-2 border-[#333333] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-1 focus:ring-[#CDFB47] transition-colors duration-300 @error('name') border-red-500 @enderror"
                               required>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                    </div>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-[#CDFB47] text-sm font-medium mb-2">
                        Email
                    </label>
                    <div class="relative">
                        <input type="email" name="email" id="email"
                               value="{{ old('email', $user->email) }}"
                               class="w-full bg-[#1A1A1A] border-2 border-[#333333] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-1 focus:ring-[#CDFB47] transition-colors duration-300 @error('email') border-red-500 @enderror"
                               required>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="role" class="block text-[#CDFB47] text-sm font-medium mb-2">
                        Rôle
                    </label>
                    <div class="relative">
                        <select name="role" id="role"
                                class="w-full bg-[#1A1A1A] border-2 border-[#333333] rounded-lg px-4 py-3 text-white focus:border-[#CDFB47] focus:ring-1 focus:ring-[#CDFB47] transition-colors duration-300 appearance-none @error('role') border-red-500 @enderror"
                                required>
                            <option value="client" {{ (old('role', $user->role) === 'client') ? 'selected' : '' }}>Client</option>
                            <option value="coach" {{ (old('role', $user->role) === 'coach') ? 'selected' : '' }}>Coach</option>
                            <option value="admin" {{ (old('role', $user->role) === 'admin') ? 'selected' : '' }}>Administrateur</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                    @error('role')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-[#CDFB47] text-sm font-medium mb-2">
                        Nouveau mot de passe
                        <span class="text-gray-400 text-xs">(laisser vide pour ne pas modifier)</span>
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="password"
                               class="w-full bg-[#1A1A1A] border-2 border-[#333333] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-1 focus:ring-[#CDFB47] transition-colors duration-300 @error('password') border-red-500 @enderror"
                               placeholder="Nouveau mot de passe">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                    </div>
                    @error('password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-[#CDFB47] text-sm font-medium mb-2">
                        Confirmer le nouveau mot de passe
                    </label>
                    <div class="relative">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="w-full bg-[#1A1A1A] border-2 border-[#333333] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-1 focus:ring-[#CDFB47] transition-colors duration-300"
                               placeholder="Confirmez le nouveau mot de passe">
                        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-[#CDFB47] text-black px-6 py-3 rounded-lg text-lg font-semibold hover:bg-[#5B5B5B] hover:text-[#CDFB47] transition-all duration-300">
                        Mettre à jour l'utilisateur
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection