<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Package;
use App\Models\Client;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        $reservations = Reservation::with(['package','client'])->latest()->paginate(15);
        return view('admin.reservations.index', compact('reservations'));
    }

    public function create()
    {
        $packages = Package::orderBy('name')->get();
        $clients = Client::orderBy('name')->get();
        return view('admin.reservations.create', compact('packages', 'clients'));   
    }

public function store(Request $request)
{
    $data = $request->validate([
        'client_id'  => 'required|exists:clients,id',
        'package_id' => 'required|exists:packages,id',
        'date'       => 'required|date',
        'total'      => 'required|numeric|min:0',
        'status'     => 'required|in:Confirmé,En attente,Payé partiellement,Annulé',
    ]);

    Reservation::create($data);

    return redirect()->route('admin.reservations.index')
                     ->with('success','Réservation créée !');
}

    public function edit(Reservation $reservation)
{
    $clients = Client::orderBy('name')->get();
    $packages = Package::orderBy('name')->get();
    
    return view('admin.reservations.edit', compact('reservation', 'clients', 'packages'));
}

    public function update(Request $request, Reservation $reservation)
{
    $data = $request->validate([
        'client_id'  => 'required|exists:clients,id',
        'package_id' => 'required|exists:packages,id',
        'date'       => 'required|date',
        'total'      => 'required|numeric|min:0',
        'status'     => 'required|in:Confirmé,En attente,Payé partiellement,Annulé',
    ]);

    $reservation->update($data);

    return redirect()->route('admin.reservations.index')
                     ->with('success', 'Réservation mise à jour !');
}

    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return redirect()->route('admin.reservations.index')
                         ->with('success', 'Réservation supprimée !');
    }
}