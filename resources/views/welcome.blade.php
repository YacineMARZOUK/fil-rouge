@extends('layouts.app')

@section('content')
<div class="relative min-h-screen">
    <!-- Hero Section avec image de fond -->
    <div class="relative h-screen">
        <!-- Image de fond avec overlay sombre -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/hero-bg.jpg') }}" alt="Background" class="w-full h-full object-cover filter brightness-50">
        </div>

        <!-- Navigation spéciale pour la page d'accueil -->
        <div class="absolute top-0 w-full z-10 bg-transparent">
            <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
                <div class="text-2xl font-bold text-white">
                    GainZone
                </div>
                <div class="flex items-center space-x-8">
                    <a href="#services" class="text-white hover:text-green-400 transition">Services</a>
                    <a href="#facility" class="text-white hover:text-green-400 transition">Facility</a>
                    <a href="{{ route('shop.index') }}" class="text-white hover:text-green-400 transition">Marchandise</a>
                    <a href="{{ route('register') }}" class="bg-green-400 hover:bg-green-500 text-black px-6 py-2 rounded-full font-bold transition">JOIN NOW</a>
                </div>
            </nav>
        </div>

        <!-- Contenu Hero -->
        <div class="absolute inset-0 flex items-center">
            <div class="container mx-auto px-6">
                <div class="max-w-3xl">
                    <h1 class="text-6xl font-bold text-white mb-6">
                        Unleash Your<br>
                        Inner Athlete
                    </h1>
                    <p class="text-lg text-green-400 mb-8">
                        We are dedicated to helping you transform your transform<br>
                        your body and mind through the power of fitness
                    </p>
                    <div class="flex items-center space-x-8">
                        <div class="text-white">
                            <span class="text-4xl font-bold text-green-400">500+</span>
                            <p class="text-sm">Members happy</p>
                        </div>
                        <a href="{{ route('register') }}" 
                           class="inline-block bg-green-400 hover:bg-green-500 text-black px-8 py-3 rounded-full font-bold transition transform hover:scale-105">
                            START YOUR JOURNEY
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Services -->
    <section id="services" class="py-20 bg-black">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-white mb-12">Nos Services</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-900 p-6 rounded-lg">
                    <div class="w-12 h-12 bg-green-400 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Personal Training</h3>
                    <p class="text-gray-400">Programmes personnalisés adaptés à vos objectifs spécifiques.</p>
                </div>
                <div class="bg-gray-900 p-6 rounded-lg">
                    <div class="w-12 h-12 bg-green-400 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Group Classes</h3>
                    <p class="text-gray-400">Des cours collectifs dynamiques et motivants.</p>
                </div>
                <div class="bg-gray-900 p-6 rounded-lg">
                    <div class="w-12 h-12 bg-green-400 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-black" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-2">Nutrition Planning</h3>
                    <p class="text-gray-400">Conseils nutritionnels pour optimiser vos résultats.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section Facility -->
    <section id="facility" class="py-20 bg-gray-900">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-white mb-12">Nos Installations</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="relative group">
                    <img src="{{ asset('images/facility/weights.jpg') }}" alt="Weights Area" class="w-full h-64 object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-50 group-hover:bg-opacity-75 transition rounded-lg flex items-center justify-center">
                        <h3 class="text-xl font-bold text-white">Zone de Musculation</h3>
                    </div>
                </div>
                <div class="relative group">
                    <img src="{{ asset('images/facility/cardio.jpg') }}" alt="Cardio Area" class="w-full h-64 object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-50 group-hover:bg-opacity-75 transition rounded-lg flex items-center justify-center">
                        <h3 class="text-xl font-bold text-white">Zone Cardio</h3>
                    </div>
                </div>
                <div class="relative group">
                    <img src="{{ asset('images/facility/studio.jpg') }}" alt="Studio" class="w-full h-64 object-cover rounded-lg">
                    <div class="absolute inset-0 bg-black bg-opacity-50 group-hover:bg-opacity-75 transition rounded-lg flex items-center justify-center">
                        <h3 class="text-xl font-bold text-white">Studio de Cours</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-black">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-white mb-8">Prêt à commencer votre transformation ?</h2>
            <a href="{{ route('register') }}" 
               class="inline-block bg-green-400 hover:bg-green-500 text-black px-8 py-3 rounded-full font-bold transition transform hover:scale-105">
                REJOIGNEZ-NOUS MAINTENANT
            </a>
        </div>
    </section>
</div>

@push('styles')
<style>
    .filter.brightness-50 {
        filter: brightness(0.5);
    }
</style>
@endpush
@endsection
