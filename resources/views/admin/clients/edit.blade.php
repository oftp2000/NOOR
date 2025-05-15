@extends('layouts.app')
@section('title', isset($client)? 'Modifier un client':'Créer un client')
@section('content')
<div class="max-w-lg mx-auto p-6 bg-white rounded-lg">
  <h2 class="text-2xl font-bold mb-4">{{ isset($client)? 'Modifier':'Créer' }} un client</h2>
  <form action="{{ isset($client)? route('admin.clients.update',$client): route('admin.clients.store') }}" method="POST">
    @csrf
    @if(isset($client)) @method('PUT') @endif

    <div class="mb-4">
      <label class="block text-sm font-medium">Nom</label>
      <input name="name" value="{{ old('name',$client->name ?? '') }}" required class="mt-1 w-full border p-2 rounded">
      @error('name')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    </div>

    <div class="mb-4">
      <label class="block text-sm font-medium">Email</label>
      <input name="email" type="email" value="{{ old('email',$client->email ?? '') }}" required class="mt-1 w-full border p-2 rounded">
      @error('email')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    </div>

    <div class="mb-4">
      <label class="block text-sm font-medium">Statut</label>
      <select name="status" required class="mt-1 w-full border p-2 rounded">
        <option value="Actif" {{ old('status',$client->status ?? 'Actif')=='Actif'?'selected':'' }}>Actif</option>
        <option value="Inactif" {{ old('status',$client->status)=='Inactif'?'selected':'' }}>Inactif</option>
      </select>
      @error('status')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    </div>

    <div class="flex justify-end">
      <a href="{{route('admin.clients.index')}}" class="mr-2">Annuler</a>
      <button type="submit" class="btn-blue">Enregistrer</button>
    </div>
  </form>
</div>
@endsection