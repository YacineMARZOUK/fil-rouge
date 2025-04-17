@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Tableau de bord administrateur</h1>
        <a href="{{ route('admin.products.create') }}" class="btn-primary flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Nouveau Produit
        </a>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="card">
            <h3 class="text-xl font-semibold mb-2">Utilisateurs</h3>
            <p class="text-4xl font-bold text-primary">{{ $stats['total_users'] }}</p>
            <div class="mt-2 text-gray-400">
                <span>Clients: {{ $stats['total_clients'] }}</span>
                <span class="ml-4">Coachs: {{ $stats['total_coaches'] }}</span>
            </div>
        </div>
        
        <div class="card">
            <h3 class="text-xl font-semibold mb-2">Produits</h3>
            <p class="text-4xl font-bold text-primary">{{ $stats['total_products'] }}</p>
        </div>
        
        <div class="card">
            <h3 class="text-xl font-semibold mb-2">Commandes</h3>
            <p class="text-4xl font-bold text-primary">{{ $stats['total_orders'] }}</p>
        </div>
    </div>

    <!-- Commandes récentes -->
    <div class="card mb-8">
        <h2 class="text-2xl font-bold mb-4">Commandes récentes</h2>
        @if($stats['recent_orders']->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-800">
                            <th class="text-left py-3 px-4">ID</th>
                            <th class="text-left py-3 px-4">Client</th>
                            <th class="text-left py-3 px-4">Montant</th>
                            <th class="text-left py-3 px-4">Date</th>
                            <th class="text-left py-3 px-4">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['recent_orders'] as $order)
                            <tr class="border-b border-gray-800">
                                <td class="py-3 px-4">#{{ $order->id }}</td>
                                <td class="py-3 px-4">{{ $order->user->name }}</td>
                                <td class="py-3 px-4">{{ number_format($order->total_amount, 2) }} €</td>
                                <td class="py-3 px-4">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 rounded text-xs 
                                        @if($order->status === 'completed') bg-green-600
                                        @elseif($order->status === 'pending') bg-yellow-600
                                        @else bg-red-600 @endif">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-gray-400">Aucune commande récente</p>
        @endif
    </div>

    <!-- Nouveaux utilisateurs -->
    <div class="card">
        <h2 class="text-2xl font-bold mb-4">Nouveaux utilisateurs</h2>
        @if($stats['recent_users']->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-800">
                            <th class="text-left py-3 px-4">Nom</th>
                            <th class="text-left py-3 px-4">Email</th>
                            <th class="text-left py-3 px-4">Rôle</th>
                            <th class="text-left py-3 px-4">Date d'inscription</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stats['recent_users'] as $user)
                            <tr class="border-b border-gray-800">
                                <td class="py-3 px-4">{{ $user->name }}</td>
                                <td class="py-3 px-4">{{ $user->email }}</td>
                                <td class="py-3 px-4">
                                    <span class="px-2 py-1 rounded text-xs
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
        <a href="{{ route('admin.products.index') }}" class="card hover:bg-gray-800 transition-colors">
            <h3 class="text-xl font-semibold mb-2">Gérer les produits</h3>
            <p class="text-gray-400">Ajouter et gérer les produits du catalogue</p>
        </a>
        
        <a href="{{ route('admin.users.index') }}" class="card hover:bg-gray-800 transition-colors">
            <h3 class="text-xl font-semibold mb-2">Gérer les utilisateurs</h3>
            <p class="text-gray-400">Gérer les comptes utilisateurs et leurs rôles</p>
        </a>
    </div>
</div>
@endsection 