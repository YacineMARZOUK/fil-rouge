@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 bg-black min-h-screen">
    <div class="flex justify-around items-center mb-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white">Tableau de bord administrateur</h1>
        <a href="{{ route('admin.products.create') }}" class="bg-[#CDFB47] hover:bg-[#b9e735] text-black py-2 px-4 rounded-lg shadow flex items-center transition-colors duration-200">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nouveau Produit
        </a>
    </div>

    <!-- Statistiques -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-black border border-[#5B5B5B] shadow-xl rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-2 text-white">Utilisateurs</h3>
                <p class="text-4xl font-bold text-[#CDFB47]">{{ $stats['total_users'] }}</p>
                <div class="mt-2 text-gray-400 text-sm">
                    Clients: {{ $stats['total_clients'] }} <span class="ml-4">Coachs: {{ $stats['total_coaches'] }}</span>
                </div>
            </div>

            <div class="bg-black border border-[#5B5B5B] shadow-xl rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-2 text-white">Produits</h3>
                <p class="text-4xl font-bold text-[#CDFB47]">{{ $stats['total_products'] }}</p>
            </div>

            <div class="bg-black border border-[#5B5B5B] shadow-xl rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-2 text-white">Commandes</h3>
                <p class="text-4xl font-bold text-[#CDFB47]">{{ $stats['total_cart_items'] }}</p>
            </div>
        </div>

        <!-- Commandes récentes -->
        <!-- Commandes récentes -->
<div class="bg-black border border-[#5B5B5B] shadow-xl rounded-lg p-6 mb-8">
    <h2 class="text-2xl font-bold text-white mb-4">Articles récents du panier</h2>
    @if($stats['recent_cart_items']->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full text-white">
                <thead>
                    <tr class="border-b border-[#5B5B5B]">
                        <th class="text-left py-3 px-4">ID</th>
                        <th class="text-left py-3 px-4">Client</th>
                        <th class="text-left py-3 px-4">Produit</th>
                        <th class="text-left py-3 px-4">Quantité</th>
                        <th class="text-left py-3 px-4">Prix total</th>
                        <th class="text-left py-3 px-4">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stats['recent_cart_items'] as $cartItem)
                        <tr class="border-b border-[#5B5B5B]">
                            <td class="py-3 px-4">#{{ $cartItem->id }}</td>
                            <td class="py-3 px-4">{{ $cartItem->user->name }}</td>
                            <td class="py-3 px-4">{{ $cartItem->product->name }}</td>
                            <td class="py-3 px-4">{{ $cartItem->quantity }}</td>
                            <td class="py-3 px-4">{{ number_format($cartItem->total_price, 2) }} €</td>
                            <td class="py-3 px-4">{{ $cartItem->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-400">Aucun article récent dans le panier</p>
    @endif
</div>


        <!-- Nouveaux utilisateurs -->
        <div class="bg-black border border-[#5B5B5B] shadow-xl rounded-lg p-6">
            <h2 class="text-2xl font-bold text-white mb-4">Nouveaux utilisateurs</h2>
            @if($stats['recent_users']->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full text-white">
                        <thead>
                            <tr class="border-b border-[#5B5B5B]">
                                <th class="text-left py-3 px-4">Nom</th>
                                <th class="text-left py-3 px-4">Email</th>
                                <th class="text-left py-3 px-4">Rôle</th>
                                <th class="text-left py-3 px-4">Date d'inscription</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($stats['recent_users'] as $user)
                                <tr class="border-b border-[#5B5B5B]">
                                    <td class="py-3 px-4">{{ $user->name }}</td>
                                    <td class="py-3 px-4">{{ $user->email }}</td>
                                    <td class="py-3 px-4">
                                        <span class="px-2 py-1 rounded text-xs font-semibold
                                            @if($user->role === 'admin') bg-red-600
                                            @elseif($user->role === 'coach') bg-blue-600
                                            @else bg-green-600 @endif">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4">{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-400">Aucun nouvel utilisateur</p>
            @endif
        </div>

        <!-- Actions rapides -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
            <a href="{{ route('admin.products.index') }}" class="bg-black border border-[#5B5B5B] hover:border-[#CDFB47] overflow-hidden shadow-xl sm:rounded-lg p-6 transition-colors duration-200">
                <h3 class="text-xl font-semibold mb-2 text-[#CDFB47]">Gérer les produits</h3>
                <p class="text-[#5B5B5B]">Ajouter et gérer les produits du catalogue</p>
            </a>
            
            <a href="{{ route('admin.users.index') }}" class="bg-black border border-[#5B5B5B] hover:border-[#CDFB47] overflow-hidden shadow-xl sm:rounded-lg p-6 transition-colors duration-200">
                <h3 class="text-xl font-semibold mb-2 text-[#CDFB47]">Gérer les utilisateurs</h3>
                <p class="text-[#5B5B5B]">Gérer les comptes utilisateurs et leurs rôles</p>
            </a>
        </div>
        
    </div>
</div>
@endsection
