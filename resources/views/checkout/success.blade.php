@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16">
    <div class="max-w-2xl mx-auto text-center">
        <div class="mb-8">
            <svg class="w-20 h-20 text-green-500 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h1 class="text-4xl font-bold mb-4">Commande confirmée !</h1>
        <p class="text-xl text-gray-400 mb-8">
            Merci pour votre commande. Vous recevrez bientôt un email de confirmation.
        </p>
        <div class="space-x-4">
            <a href="{{ route('shop') }}" class="btn-primary">
                Retourner à la boutique
            </a>
        </div>
    </div>
</div>
@endsection 