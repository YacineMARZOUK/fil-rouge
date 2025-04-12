@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow-md p-6">
    <h2 class="text-2xl font-bold mb-6 text-center text-[#000000]">Connexion</h2>
    
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf
        
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#CDFB47] focus:ring-[#CDFB47]" required autofocus>
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#CDFB47] focus:ring-[#CDFB47]" required>
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-[#CDFB47] focus:ring-[#CDFB47] border-gray-300 rounded">
                <label for="remember" class="ml-2 block text-sm text-gray-900">Se souvenir de moi</label>
            </div>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-[#000000] hover:bg-[#5B5B5B] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#CDFB47]">
                Se connecter
            </button>
        </div>
    </form>

    <div class="mt-4 text-center">
        <p class="text-sm text-gray-600">
            Pas encore de compte ? 
            <a href="{{ route('register') }}" class="font-medium text-[#CDFB47] hover:text-[#5B5B5B]">
                S'inscrire
            </a>
        </p>
    </div>
</div>
@endsection 