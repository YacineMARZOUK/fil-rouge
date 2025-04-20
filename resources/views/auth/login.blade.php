@extends('layouts.app')

@section('content')
<div class="py-12 bg-black">
    <div class="max-w-md mx-auto sm:px-6 lg:px-8">
        <div class="form-container">
            <h1 class="form-title">Connexion</h1>

            @if($errors->any())
                <div class="form-error">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                           class="form-input" placeholder="votre@email.com">
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" required
                           class="form-input" placeholder="••••••••">
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember" 
                               class="rounded bg-[#1A1A1A] border-[#5B5B5B] text-[#CDFB47] focus:ring-[#CDFB47]">
                        <label for="remember" class="ml-2 text-sm text-white">Se souvenir de moi</label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" 
                           class="text-sm text-[#CDFB47] hover:text-white">
                            Mot de passe oublié ?
                        </a>
                    @endif
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="form-button-primary">
                        Se connecter
                    </button>
                </div>

                <div class="text-center mt-4">
                    <span class="text-white">Pas encore de compte ?</span>
                    <a href="{{ route('register') }}" class="text-[#CDFB47] hover:text-white ml-1">
                        S'inscrire
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 