@extends('layouts.app')

@section('content')
<div class="py-12 bg-black">
    <div class="max-w-md mx-auto sm:px-6 lg:px-8">
        <div class="form-container">
            <h1 class="form-title">Créer un compte</h1>

            @if($errors->any())
                <div class="form-error">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Nom complet</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required autofocus
                           class="form-input" placeholder="Votre nom">
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           class="form-input" placeholder="votre@email.com">
                </div>

                <div class="form-group">
                    <label for="phone" class="form-label">Téléphone</label>
                    <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required
                           class="form-input" placeholder="Votre numéro de téléphone">
                </div>

                <div class="form-group">
                    <label for="address" class="form-label">Adresse</label>
                    <textarea name="address" id="address" required class="form-textarea" rows="3"
                              placeholder="Votre adresse complète">{{ old('address') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" name="password" id="password" required
                           class="form-input" placeholder="••••••••">
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="form-input" placeholder="••••••••">
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="form-button-primary">
                        S'inscrire
                    </button>
                </div>

                <div class="text-center mt-4">
                    <span class="text-white">Déjà inscrit ?</span>
                    <a href="{{ route('login') }}" class="text-[#CDFB47] hover:text-white ml-1">
                        Se connecter
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 