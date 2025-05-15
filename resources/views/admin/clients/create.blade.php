@extends('layouts.app')
@section('title', isset($client) ? 'Modifier un client' : 'Créer un client')
@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-4">
        {{ isset($client) ? 'Modifier' : 'Créer' }} un client
    </h2>
    <form action="{{ isset($client) ? route('admin.clients.update', $client) : route('admin.clients.store') }}" method="POST" class="space-y-6">
        @csrf
        @if(isset($client)) @method('PUT') @endif

        <div>
            <label class="block text-sm font-medium text-gray-700">Nom</label>
            <input name="name" value="{{ old('name', $client->name ?? '') }}" required
                   class="mt-1 block w-full border-gray-300 rounded-md p-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input name="email" type="email" value="{{ old('email', $client->email ?? '') }}" required
                   class="mt-1 block w-full border-gray-300 rounded-md p-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
            @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700">Statut</label>
            <select name="status" required
                    class="mt-1 block w-full border-gray-300 rounded-md p-2 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option value="Actif" {{ old('status', $client->status ?? '')=='Actif'?'selected':'' }}>Actif</option>
                <option value="Inactif" {{ old('status', $client->status ?? '')=='Inactif'?'selected':'' }}>Inactif</option>
            </select>
            @error('status')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex justify-end space-x-3 pt-6">
            <a href="{{ route('admin.clients.index') }}"
               class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                Annuler
            </a>
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Enregistrer
            </button>
        </div>
    </form>
</div>
@endsection