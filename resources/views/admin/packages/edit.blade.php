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

        <form action="{{ route('admin.packages.update', $package->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

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
                        <input type="file" name="image" id="image" class="hidden" @change="imagePreview = URL.createObjectURL($event.target.files[0])">
                        <label for="image" class="cursor-pointer inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50"> <i data-lucide="upload" class="w-4 h-4 mr-2"></i>Changer l'image</label>
                        <button type="button" x-show="imagePreview" @click="imagePreview = null; document.getElementById('image').value = ''" class="ml-2 inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>Supprimer
                        </button>
                    </div>
                </div>
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nom du forfait</label>
                <input type="text" name="name" id="name" value="{{ old('name', $package->name) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" required>{{ old('description', $package->description) }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Prix (DH)</label>
                    <input type="number" name="price" id="price" value="{{ old('price', $package->price) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" min="0" step="100" required>
                </div>

                <div>
                    <label for="duration" class="block text-sm font-medium text-gray-700">Durée (jours)</label>
                    <input type="number" name="duration" id="duration" value="{{ old('duration', $package->duration) }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500" min="1" required>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Statut</label>
                    <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="1" {{ old('status', $package->status) ? 'selected' : '' }}>Actif</option>
                        <option value="0" {{ !old('status', $package->status) ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>
            </div>

            <input type="hidden" name="included_services[]" value="">
            <input type="hidden" name="excluded_services[]" value="">

            <div x-data="{
                includedServices: {{ json_encode(old('included_services', $package->included_services ?? [])) }},
                excludedServices: {{ json_encode(old('excluded_services', $package->excluded_services ?? [])) }},
                newIncludedService: '',
                newExcludedService: '',
                addIncludedService() {
                    if (this.newIncludedService.trim()) {
                        this.includedServices.push(this.newIncludedService.trim());
                        this.newIncludedService = '';
                    }
                },
                addExcludedService() {
                    if (this.newExcludedService.trim()) {
                        this.excludedServices.push(this.newExcludedService.trim());
                        this.newExcludedService = '';
                    }
                },
                removeIncludedService(i) { this.includedServices.splice(i, 1) },
                removeExcludedService(i) { this.excludedServices.splice(i, 1) }
            }">
                <div class="space-y-4">
                    <label class="block text-sm font-medium text-gray-700">Services inclus</label>
                    <template x-for="(service, i) in includedServices" :key="i">
                        <div class="flex items-center space-x-2">
                            <input type="text" x-model="includedServices[i]" name="included_services[]" class="flex-1 border border-gray-300 rounded-md py-2 px-3">
                            <button type="button" @click="removeIncludedService(i)" class="text-red-500 hover:text-red-700">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </template>
                    <div class="flex items-center space-x-2">
                        <input type="text" x-model="newIncludedService" @keyup.enter="addIncludedService" placeholder="Ajouter un service inclus" class="flex-1 border border-gray-300 rounded-md py-2 px-3">
                        <button type="button" @click="addIncludedService" class="text-green-500 hover:text-green-700">
                            <i data-lucide="plus" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <div class="mt-6 space-y-4">
                    <label class="block text-sm font-medium text-gray-700">Services non inclus</label>
                    <template x-for="(service, i) in excludedServices" :key="i">
                        <div class="flex items-center space-x-2">
                            <input type="text" x-model="excludedServices[i]" name="excluded_services[]" class="flex-1 border border-gray-300 rounded-md py-2 px-3">
                            <button type="button" @click="removeExcludedService(i)" class="text-red-500 hover:text-red-700">
                                <i data-lucide="x" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </template>
                    <div class="flex items-center space-x-2">
                        <input type="text" x-model="newExcludedService" @keyup.enter="addExcludedService" placeholder="Ajouter un service non inclus" class="flex-1 border border-gray-300 rounded-md py-2 px-3">
                        <button type="button" @click="addExcludedService" class="text-green-500 hover:text-green-700">
                            <i data-lucide="plus" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>

             <div class="flex justify-end pt-6 space-x-3">
                <a href="{{ route('admin.packages.index') }}" class="inline-flex items-center px-6 py-2 border border-gray-300 text-sm font-medium rounded-md shadow-sm text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i data-lucide="x" class="w-4 h-4 mr-2"></i>Annuler
                </a>
                <button type="submit" class="inline-flex items-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
