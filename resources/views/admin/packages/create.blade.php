{{-- resources/views/admin/packages/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Créer un nouveau forfait')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm overflow-hidden p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">
            <i data-lucide="plus-circle" class="w-6 h-6 inline mr-2 text-blue-500"></i>
            Créer un nouveau forfait
        </h2>
        
        <form action="{{ route('admin.packages.store') }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="space-y-6">
            @csrf
            
            {{-- Image Upload --}}
            <div x-data="{ imagePreview: '' }" class="space-y-2">
                <label class="block text-sm font-medium text-gray-700">Image du forfait</label>
                <div class="flex items-center space-x-4">
                    <div class="h-24 w-24 rounded-md overflow-hidden bg-gray-100 flex items-center justify-center border-2 border-dashed border-gray-300">
                        <template x-if="imagePreview">
                            <img :src="imagePreview" alt="Preview" class="h-full w-full object-cover">
                        </template>
                        <template x-if="!imagePreview">
                            <i data-lucide="image" class="text-gray-400 w-10 h-10"></i>
                        </template>
                    </div>
                    <div class="flex-1">
                        <input type="file" name="image" id="image" class="hidden" 
                               @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                        <label for="image" 
                               class="cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <i data-lucide="upload" class="w-4 h-4 mr-2"></i>
                            Choisir une image
                        </label>
                        <button type="button" x-show="imagePreview" @click="imagePreview = null; $refs.imageInput.value = ''"
                                class="ml-2 inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                            Supprimer
                        </button>
                    </div>
                </div>
            </div>
            
            {{-- Nom --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nom du forfait</label>
                <input type="text" name="name" id="name" 
                       value="{{ old('name') }}"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                       required>
                @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            
            {{-- Description --}}
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                          required>{{ old('description') }}</textarea>
                @error('description')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Prix --}}
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Prix (DH)</label>
                    <input type="number" name="price" id="price" 
                           value="{{ old('price') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                           min="0" step="100" required>
                    @error('price')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                
                {{-- Durée --}}
                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700">Durée (jours)</label>
                    <input type="number" name="duration" id="duration" 
                           value="{{ old('duration') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500"
                           min="1" required>
                    @error('duration')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                
                {{-- Statut --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                    <select name="status" id="status"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="1"{{ old('status','1')==='1'?' selected':'' }}>Actif</option>
                        <option value="0"{{ old('status')==='0'?' selected':'' }}>Inactif</option>
                    </select>
                </div>
            </div>
            
            {{-- Services inclus/exclus --}}
            <div x-data="{
                includedServices: {{ json_encode(old('included_services', [])) }},
                excludedServices: {{ json_encode(old('excluded_services', [])) }},
                newIncluded: '', newExcluded: '',
                addIncluded() {
                    if (this.newIncluded.trim()) {
                        this.includedServices.push(this.newIncluded.trim());
                        this.newIncluded = '';
                    }
                },
                addExcluded() {
                    if (this.newExcluded.trim()) {
                        this.excludedServices.push(this.newExcluded.trim());
                        this.newExcluded = '';
                    }
                },
                removeIncluded(i) { this.includedServices.splice(i,1) },
                removeExcluded(i) { this.excludedServices.splice(i,1) }
            }" class="space-y-6">
                
                {{-- inclus --}}
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Services inclus</label>
                    <template x-for="(srv,i) in includedServices" :key="i">
                        <div class="flex items-center space-x-2">
                            <input type="text" x-model="includedServices[i]" name="included_services[]" 
                                   class="flex-1 border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                            <button type="button" @click="removeIncluded(i)" class="text-red-500 hover:text-red-700">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </template>
                    <div class="flex items-center space-x-2">
                        <input type="text" x-model="newIncluded" @keyup.enter="addIncluded" placeholder="Ajouter un service inclus"
                               class="flex-1 border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                        <button type="button" @click="addIncluded" class="text-green-500 hover:text-green-700">
                            <i data-lucide="plus" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
                
                {{-- exclus --}}
                <div class="space-y-2">
                    <label class="block text-sm font-medium text-gray-700">Services non inclus</label>
                    <template x-for="(srv,i) in excludedServices" :key="i">
                        <div class="flex items-center space-x-2">
                            <input type="text" x-model="excludedServices[i]" name="excluded_services[]" 
                                   class="flex-1 border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                            <button type="button" @click="removeExcluded(i)" class="text-red-500 hover:text-red-700">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </template>
                    <div class="flex items-center space-x-2">
                        <input type="text" x-model="newExcluded" @keyup.enter="addExcluded" placeholder="Ajouter un service non inclus"
                               class="flex-1 border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500">
                        <button type="button" @click="addExcluded" class="text-green-500 hover:text-green-700">
                            <i data-lucide="plus" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
            
            {{-- Boutons --}}
            <div class="flex justify-end space-x-3 pt-6">
                <a href="{{ route('admin.packages.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium bg-white hover:bg-gray-50">
                    <i data-lucide="arrow-left" class="w-4 h-4 mr-2 inline"></i>Annuler
                </a>
                <button type="submit" 
                        class="px-4 py-2 rounded-md text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                    <i data-lucide="save" class="w-4 h-4 mr-2 inline"></i>Créer le forfait
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
