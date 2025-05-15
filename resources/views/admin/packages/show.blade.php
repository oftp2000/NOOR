{{-- resources/views/admin/packages/show.blade.php --}}
@extends('layouts.admin')

@section('title', $package->name)

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- En-tête avec bouton de retour -->
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('admin.packages.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 transition-all duration-200 hover:shadow-md">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i>
            Retour à la liste
        </a>
        <div class="flex space-x-3">
            <a href="{{ route('admin.packages.edit', $package->id) }}" 
               class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 transition-all duration-200 hover:shadow-md">
                <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                Modifier
            </a>
            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $package->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $package->status ? 'Actif' : 'Inactif' }}
            </span>
        </div>
    </div>

    <!-- Carte principale -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden transition-all duration-300 hover:shadow-md">
        <!-- En-tête avec image -->
        <div class="relative">
            @if($package->image)
            <img src="{{ asset('storage/'.$package->image) }}" alt="{{ $package->name }}" 
                 class="w-full h-64 object-cover object-center">
            @else
            <div class="w-full h-64 bg-gradient-to-r from-gray-100 to-gray-200 flex items-center justify-center">
                <i data-lucide="package" class="w-16 h-16 text-gray-400"></i>
            </div>
            @endif
            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                <h1 class="text-3xl font-bold text-white">{{ $package->name }}</h1>
                <div class="flex items-center mt-2 text-white/90">
                    <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                    <span class="text-sm">{{ $package->duration }} jours</span>
                    <span class="mx-3">•</span>
                    <i data-lucide="tag" class="w-4 h-4 mr-1"></i>
                    <span class="text-sm">{{ number_format($package->price, 0, ',', ' ') }} DH</span>
                </div>
            </div>
        </div>

        <!-- Contenu -->
        <div class="p-6">
            <!-- Description -->
            <div class="mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                    <i data-lucide="align-left" class="w-5 h-5 text-blue-500 mr-2"></i>
                    Description
                </h3>
                <div class="prose max-w-none text-gray-700">
                    {!! nl2br(e($package->description)) !!}
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Services inclus -->
                <div class="bg-gray-50 rounded-lg p-5 transition-all duration-200 hover:shadow-inner">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                        <i data-lucide="check-circle" class="w-5 h-5 text-green-500 mr-2"></i>
                        Services inclus
                    </h3>
                    <ul class="space-y-2">
                        @forelse($package->included_services ?? [] as $service)
                        <li class="flex items-start group">
                            <i data-lucide="check" class="w-4 h-4 text-green-500 mt-1 mr-2 flex-shrink-0"></i>
                            <span class="text-gray-700 group-hover:text-gray-900 transition-colors duration-150">{{ $service }}</span>
                        </li>
                        @empty
                        <li class="text-gray-500 italic">Aucun service spécifié</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Services exclus -->
                <div class="bg-gray-50 rounded-lg p-5 transition-all duration-200 hover:shadow-inner">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                        <i data-lucide="x-circle" class="w-5 h-5 text-red-500 mr-2"></i>
                        Services non inclus
                    </h3>
                    <ul class="space-y-2">
                        @forelse($package->excluded_services ?? [] as $service)
                        <li class="flex items-start group">
                            <i data-lucide="x" class="w-4 h-4 text-red-500 mt-1 mr-2 flex-shrink-0"></i>
                            <span class="text-gray-700 group-hover:text-gray-900 transition-colors duration-150">{{ $service }}</span>
                        </li>
                        @empty
                        <li class="text-gray-500 italic">Aucun service spécifié</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Dates de création/mise à jour -->
            <div class="pt-5 border-t border-gray-200 text-sm text-gray-500">
                <div class="flex flex-wrap gap-x-4 gap-y-1">
                    <div>
                        <i data-lucide="calendar-plus" class="w-4 h-4 inline mr-1"></i>
                        Créé le : {{ $package->created_at->format('d/m/Y H:i') }}
                    </div>
                    <div>
                        <i data-lucide="calendar-check" class="w-4 h-4 inline mr-1"></i>
                        Mis à jour le : {{ $package->updated_at->format('d/m/Y H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Boutons d'action en bas -->
    <div class="mt-6 flex justify-between">
        <form action="{{ route('admin.packages.destroy', $package->id) }}" method="POST" 
              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce forfait?')">
            @csrf
            @method('DELETE')
            <button type="submit" 
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 transition-all duration-200 hover:shadow-md">
                <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                Supprimer ce forfait
            </button>
        </form>
        
        <a href="{{ route('admin.packages.edit', $package->id) }}" 
           class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 transition-all duration-200 hover:shadow-md">
            <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
            Modifier ce forfait
        </a>
    </div>
</div>
@endsection