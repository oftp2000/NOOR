@extends('layouts.app')

@section('title', 'Créer une réservation')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow">
    <h2 class="text-2xl font-bold mb-6">Créer une nouvelle réservation</h2>
    
    <form action="{{ route('admin.reservations.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Client Selection -->
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Client</label>
               <select name="client_id" required>
  <option value="">Sélectionner un client</option>
  @foreach($clients as $client)
    <option value="{{ $client->id }}" {{ old('client_id')==$client->id?'selected':'' }}>
      {{ $client->name }} ({{ $client->email }})
    </option>
  @endforeach
</select>
                @error('client_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Package Selection -->
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Forfait</label>
                <select name="package_id" required
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Sélectionner un forfait</option>
                    @foreach($packages as $package)
                        <option value="{{ $package->id }}" {{ old('package_id') == $package->id ? 'selected' : '' }}>
                            {{ $package->name }} - {{ number_format($package->price, 0, ',', ' ') }} DH
                        </option>
                    @endforeach
                </select>
                @error('package_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date -->
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                <input type="date" name="date" required
                    value="{{ old('date') }}"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Total Amount -->
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Montant (DH)</label>
                <input type="number" name="total" step="0.01" min="0" required
                    value="{{ old('total') }}"
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @error('total')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div class="col-span-1">
                <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                <select name="status" required
                    class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Sélectionner un statut</option>
                    <option value="Confirmé" {{ old('status') == 'Confirmé' ? 'selected' : '' }}>Confirmé</option>
                    <option value="En attente" {{ old('status') == 'En attente' ? 'selected' : '' }}>En attente</option>
                    <option value="Payé partiellement" {{ old('status') == 'Payé partiellement' ? 'selected' : '' }}>Payé partiellement</option>
                    <option value="Annulé" {{ old('status') == 'Annulé' ? 'selected' : '' }}>Annulé</option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ route('admin.reservations.index') }}"
                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                Annuler
            </a>
            <button type="submit"
                class="px-4 py-2 bg-indigo-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Créer la réservation
            </button>
        </div>
    </form>
</div>
@endsection