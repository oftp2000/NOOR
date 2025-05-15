@extends('layouts.app')
@section('title','Clients')
@section('content')
<div class="max-w-7xl mx-auto p-6 space-y-6">
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold">Gestion des Clients</h2>
        <a href="{{ route('admin.clients.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            <i data-lucide="users" class="w-4 h-4 mr-2"></i>
            Ajouter un client
        </a>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                    <th class="px-6 py-3"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($clients as $c)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $c->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $c->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $c->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 rounded-full text-xs {{ $c->status=='Actif'?'bg-green-100 text-green-800':'bg-red-100 text-red-800' }}">
                            {{ $c->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right space-x-2">
                        <a href="{{ route('admin.clients.edit', $c) }}" class="text-blue-600 hover:text-blue-800">
                            <i data-lucide="settings" class="w-4 h-4"></i>
                        </a>
                        <form action="{{ route('admin.clients.destroy', $c) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Supprimer ce client ?')">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $clients->links() }}
        </div>
    </div>
</div>
@endsection