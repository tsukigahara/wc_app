<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientType;
use App\Models\PricingType;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        $clients->load(['client_type', 'pricing_type', 'province', 'region']);

        return Inertia::render('Client/Index', [
            'clients' => $clients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Client/Create', [
            'client_types' => ClientType::all(),
            'pricing_types' => PricingType::all(),
            'provinces' => Province::all(),
            'regions' => Region::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'ragione_sociale' => 'required|string|min:0|max:128',
            'client_type_id' => 'required|integer|min:0',
            'pricing_type_id' => 'required|integer|min:0',
            'partita_iva' => 'required|string|min:11|max:11',
            'codice_fiscale' => 'required|string|min:16|max:16',
            'sdi' => 'required|string|min:7|max:7',
            'pec' => 'required|string|min:0|max:128',
            'sede_legale' => 'required|string',
            'city' => 'required|string',
            'province_id' => 'required|integer|min:0',
            'region_id' => 'required|integer|min:0',
        ]);
        //manca validazione dei dati unique 

        $client = Client::make($data);

        $client_type = ClientType::find($data['client_type_id']);
        $client->client_type()->associate($client_type);

        $pricing_type = PricingType::find($data['pricing_type_id']);
        $client->pricing_type()->associate($pricing_type);

        $province = Province::find($data['province_id']);
        $client->province()->associate($province);

        $region = Region::find($data['region_id']);
        $client->region()->associate($region);

        $client->save();

        return redirect()->route('dashboard.clients.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        //
    }
}
