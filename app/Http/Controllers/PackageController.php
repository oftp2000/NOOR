<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    /**
     * Affiche la liste des forfaits
     */
    public function index()
    {
        $packages = Package::latest()->paginate(10);
        return view('admin.packages.index', compact('packages'));
    }

    /**
     * Affiche le formulaire de création
     */
    public function create()
    {
        return view('admin.packages.create');
    }

    /**
     * Enregistre un nouveau forfait
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            'name'                   => 'required|string|max:255',
            'description'            => 'required|string',
            'price'                  => 'required|numeric|min:0',
            'duration'               => 'required|integer|min:1',
            'status'                 => 'required|boolean',
            'image'                  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'included_services'      => 'nullable|array',
            'included_services.*'    => 'nullable|string|max:255',
            'excluded_services'      => 'nullable|array',
            'excluded_services.*'    => 'nullable|string|max:255',
        ]);

        // Filtrer les valeurs vides
        $validated['included_services'] = array_values(array_filter(
            $request->input('included_services', []),
            fn($s) => trim($s) !== ''
        ));
        $validated['excluded_services'] = array_values(array_filter(
            $request->input('excluded_services', []),
            fn($s) => trim($s) !== ''
        ));

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('packages', 'public');
        }

        Package::create($validated);

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Forfait créé avec succès !');
    }

    /**
     * Affiche les détails d'un forfait
     */
    public function show(Package $package)
    {
        return view('admin.packages.show', compact('package'));
    }

    /**
     * Affiche le formulaire d'édition
     */
    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    /**
     * Met à jour un forfait
     */
    public function update(Request $request, Package $package)
    {
        $validated = $request->validate([
            'name'                   => 'required|string|max:255',
            'description'            => 'required|string',
            'price'                  => 'required|numeric|min:0',
            'duration'               => 'required|integer|min:1',
            'status'                 => 'required|boolean',
            'image'                  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'included_services'      => 'nullable|array',
            'included_services.*'    => 'nullable|string|max:255',
            'excluded_services'      => 'nullable|array',
            'excluded_services.*'    => 'nullable|string|max:255',
        ]);

        // Filtrer les valeurs vides
        $validated['included_services'] = array_values(array_filter(
            $request->input('included_services', []),
            fn($s) => trim($s) !== ''
        ));
        $validated['excluded_services'] = array_values(array_filter(
            $request->input('excluded_services', []),
            fn($s) => trim($s) !== ''
        ));

        // Si nouvelle image, on supprime l'ancienne
        if ($request->hasFile('image')) {
            if ($package->image) {
                Storage::disk('public')->delete($package->image);
            }
            $validated['image'] = $request->file('image')->store('packages', 'public');
        }

        $package->update($validated);

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Forfait mis à jour avec succès !');
    }

    /**
     * Supprime un forfait
     */
    public function destroy(Package $package)
    {
        if ($package->image) {
            Storage::disk('public')->delete($package->image);
        }

        $package->delete();

        return redirect()
            ->route('admin.packages.index')
            ->with('success', 'Forfait supprimé avec succès !');
    }
}
