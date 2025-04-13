@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-black py-12">
    <div class="max-w-md mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-black rounded-lg p-6">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-[#CDFB47]">Inscription</h1>
                <p class="mt-2 text-gray-400">Créez votre compte</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-[#CDFB47] text-lg font-medium mb-2">
                        Nom complet
                    </label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                           class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300"
                           placeholder="Entrez votre nom">
                </div>

                <div>
                    <label for="email" class="block text-[#CDFB47] text-lg font-medium mb-2">
                        Adresse email
                    </label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required
                           class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300"
                           placeholder="Entrez votre email">
                </div>

                <div>
                    <label for="password" class="block text-[#CDFB47] text-lg font-medium mb-2">
                        Mot de passe
                    </label>
                    <input id="password" type="password" name="password" required
                           class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300"
                           placeholder="Créez votre mot de passe">
                </div>

                <div>
                    <label for="password_confirmation" class="block text-[#CDFB47] text-lg font-medium mb-2">
                        Confirmer le mot de passe
                    </label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                           class="w-full bg-[#1A1A1A] border-2 border-[#5B5B5B] rounded-lg px-4 py-3 text-white placeholder-gray-500 focus:border-[#CDFB47] focus:ring-0 transition-colors duration-300"
                           placeholder="Confirmez votre mot de passe">
                </div>

                @if($errors->any())
                    <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <button type="submit"
                            class="w-full bg-[#CDFB47] text-black px-6 py-3 rounded-lg text-lg font-semibold hover:bg-[#5B5B5B] hover:text-[#CDFB47] transition-all duration-300">
                        S'inscrire
                    </button>
                </div>

                <div class="text-center mt-6">
                    <p class="text-gray-400">
                        Déjà un compte ?
                        <a href="{{ route('login') }}" class="text-[#CDFB47] hover:text-[#5B5B5B] transition-colors duration-300">
                            Se connecter
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 