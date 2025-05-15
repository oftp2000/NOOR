<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::latest()->paginate(15);
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:clients,email',
            'status' => 'required|in:Actif,Inactif',
        ]);

        Client::create($data);
        return redirect()->route('admin.clients.index')
                         ->with('success', 'Client créé !');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:clients,email,' . $client->id,
            'status' => 'required|in:Actif,Inactif',
        ]);

        $client->update($data);
        return redirect()->route('admin.clients.index')
                         ->with('success', 'Client mis à jour !');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index')
                         ->with('success', 'Client supprimé !');
    }
}