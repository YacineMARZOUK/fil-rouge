@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex items-center mb-8">
        <a href="{{ route('admin.users.index') }}" class="text-gray-400 hover:text-white mr-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
        </a>
        <h1 class="text-3xl font-bold">Créer un utilisateur</h1>
    </div>

    <div class="card max-w-2xl">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="name" class="block text-sm font-medium mb-2">Nom</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="form-input w-full @error('name') border-red-500 @enderror"
                       required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium mb-2">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}"
                       class="form-input w-full @error('email') border-red-500 @enderror"
                       required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="role" class="block text-sm font-medium mb-2">Rôle</label>
                <select name="role" id="role" 
                        class="form-select w-full @error('role') border-red-500 @enderror"
                        required>
                    <option value="">Sélectionnez un rôle</option>
                    <option value="client" {{ old('role') === 'client' ? 'selected' : '' }}>Client</option>
                    <option value="coach" {{ old('role') === 'coach' ? 'selected' : '' }}>Coach</option>
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrateur</option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password" class="block text-sm font-medium mb-2">Mot de passe</label>
                <input type="password" name="password" id="password"
                       class="form-input w-full @error('password') border-red-500 @enderror"
                       required>
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="password_confirmation" class="block text-sm font-medium mb-2">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="form-input w-full"
                       required>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="btn-primary">
                    Créer l'utilisateur
                </button>
            </div>
        </form>
    </div>
</div>
@endsection 