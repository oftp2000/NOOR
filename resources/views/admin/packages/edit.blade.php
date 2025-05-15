{{-- resources/views/admin/packages/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Modifier le forfait')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm overflow-hidden p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">
                <i data-lucide="edit" class="w-6 h-6 inline mr-2 text-blue-500"></i>
                Modifier le forfait
            </h2>
            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $package->status ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                {{ $package->status ? 'Actif' : 'Inactif' }}
            </span>
        </div>
        
        <form action="{{ route('admin.packages.update', $package->id) }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Image Upload -->
            <div x-data="{ imagePreview: '{{ $package->image ? asset('storage/'.$package->image) : '' }}' }" class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Image du forfait</label>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <div class="h-24 w-24 rounded-md overflow-hidden bg-gray-100 flex items-center justify-center border-2 border-gray-200">
                            <template x-if="imagePreview">
                                <img :src="imagePreview" alt="Preview" class="h-full w-full object-cover">
                            </template>
                            <template x-if="!imagePreview">
                                <i data-lucide="image" class="text-gray-400 w-10 h-10"></i>
                            </template>
                        </div>
                    </div>
                    <div class="flex-1">
                        <input type="file" name="image" id="image" 
                               class="hidden" 
                               @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                        <label for="image" 
                               class="cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <i data-lucide="upload" class="w-4 h-4 mr-2"></i>
                            Changer l'image
                        </label>
                        @if($package->image)
                        <button type="button" x-show="imagePreview" @click="imagePreview = null; document.getElementById('image').value = ''"
                                class="ml-2 inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                            <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                            Supprimer
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Nom -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nom du forfait</label>
                <input type="text" name="name" id="name" 
                       value="{{ old('name', $package->name) }}"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Description -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                          required>{{ old('description', $package->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Prix -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Prix (DH)</label>
                    <input type="number" name="price" id="price" 
                           value="{{ old('price', $package->price) }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           min="0" step="100" required>
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Durée -->
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700">Durée (jours)</label>
                    <input type="number" name="duration" id="duration" 
                           value="{{ old('duration', $package->duration) }}"
                           class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-200"
                           min="1" required>
                    @error('duration')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Statut -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                    <select name="status" id="status"
                            class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        <option value="1" {{ old('status', $package->status) ? 'selected' : '' }}>Actif</option>
                        <option value="0" {{ !old('status', $package->status) ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>
            </div>
            
            <!-- Services Inclus -->
            <div x-data="{ services: {{ json_encode(old('included_services', $package->included_services ?? [])) }}, newService: '' }">
                <label class="block text-sm font-medium text-gray-700">Services inclus</label>
                <div class="mt-1 space-y-2">
                    <template x-for="(service, index) in services" :key="index">
                        <div class="flex items-center space-x-2">
                            <input type="text" x-model="services[index]"
                                   :name="'included_services[' + index + ']'"
                                   class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            <button type="button" @click="services.splice(index, 1)"
                                    class="text-red-500 hover:text-red-700 transition-colors duration-200">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </template>
                    <div class="flex items-center space-x-2">
                        <input type="text" x-model="newService" 
                               placeholder="Ajouter un service"
                               class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        <button type="button" @click="if(newService.trim()) { services.push(newService); newService = ''; }"
                                class="text-green-500 hover:text-green-700 transition-colors duration-200">
                            <i data-lucide="plus" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Services Exclus -->
            <div x-data="{ services: {{ json_encode(old('excluded_services', $package->excluded_services ?? [])) }}, newService: '' }">
                <label class="block text-sm font-medium text-gray-700">Services non inclus</label>
                <div class="mt-1 space-y-2">
                    <template x-for="(service, index) in services" :key="index">
                        <div class="flex items-center space-x-2">
                            <input type="text" x-model="services[index]"
                                   :name="'excluded_services[' + index + ']'"
                                   class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                            <button type="button" @click="services.splice(index, 1)"
                                    class="text-red-500 hover:text-red-700 transition-colors duration-200">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </template>
                    <div class="flex items-center space-x-2">
                        <input type="text" x-model="newService" 
                               placeholder="Ajouter un service"
                               class="flex-1 border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-200">
                        <button type="button" @click="if(newService.trim()) { services.push(newService); newService = ''; }"
                                class="text-green-500 hover:text-green-700 transition-colors duration-200">
                            <i data-lucide="plus" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end space-x-3 pt-