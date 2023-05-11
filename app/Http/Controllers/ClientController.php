<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\ClientType;
use App\Models\PricingType;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::with(['client_type', 'pricing_type', 'province', 'region', 'delivery_data'])
            ->latest('updated_at')
            ->when(FacadesRequest::input('search'), function ($query, $search) {
                $query->where('ragione_sociale', 'like', '%' . $search . '%')
                    ->orWhere('partita_iva', 'like', '%' . $search . '%')
                    ->orWhere('codice_fiscale', 'like', '%' . $search . '%')
                    ->orWhere('sdi', 'like', '%' . $search . '%')
                    ->orWhere('pec', 'like', '%' . $search . '%')
                    ->orWhere('sede_legale', 'like', '%' . $search . '%')
                    ->orWhere('city', 'like', '%' . $search . '%')
                    // per la ricerca in tabelle diverse
                    ->orWhereHas('delivery_data', function ($query) use ($search) {
                        $query->where('sign', 'like', '%' . $search . '%')
                            ->orWhere('reference_name', 'like', '%' . $search . '%')
                            ->orWhere('telephone', 'like', '%' . $search . '%');
                    });
            })
            // ->when(FacadesRequest::input('filter'), function ($query, $filter) {
            //     $column = '';
            //     switch ($filter) {
            //         case 'ragione_sociale':
            //             $column = 'ragione_sociale';
            //             break;
            //         case 'partita_iva':
            //             $column = 'partita_iva';
            //             break;
            //         case 'codice_fiscale':
            //             $column = 'codice_fiscale';
            //             break;
            //         case 'sdi':
            //             $column = 'sdi';
            //             break;
            //         case 'pec':
            //             $column = 'pec';
            //             break;
            //         case 'sede_legale':
            //             $column = 'sede_legale';
            //             break;
            //         case 'city':
            //             $column = 'city';
            //             break;
            //             // Aggiungi altri casi per le colonne desiderate
            //     }
            //     if ($column !== '') {
            //         $query->where($column, 'like', '%' . FacadesRequest::input('search') . '%');
            //     }
            // })
            ->paginate(8)->appends(FacadesRequest::only('search'));
        return Inertia::render('Client/Index', [
            'clients' => $clients,
            'filters' => FacadesRequest::only(['search', 'filter']),
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
            'partita_iva' => 'nullable|required_without:codice_fiscale|numeric|digits:11|unique:clients',
            'codice_fiscale' => 'nullable|required_without:partita_iva|alpha_num|uppercase|min:16|max:16|unique:clients',
            'sdi' => 'required|alpha_num|uppercase|min:7|max:7|unique:clients',
            'pec' => 'required|email|min:0|max:128',
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

        return redirect()->route('dashboard.clients.show', $client);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return Inertia::render('Client/Show', [
            'client' => $client->load(['client_type', 'pricing_type', 'province', 'region', 'delivery_data' => ['province', 'region']]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return Inertia::render('Client/Edit', [
            'client' => $client,
            'client_types' => ClientType::all(),
            'pricing_types' => PricingType::all(),
            'provinces' => Province::all(),
            'regions' => Region::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'ragione_sociale' => 'required|string|min:0|max:128',
            'client_type_id' => 'required|integer|min:0',
            'pricing_type_id' => 'required|integer|min:0',
            'partita_iva' => 'nullable|required_without:codice_fiscale|numeric|digits:11|unique:clients,partita_iva,' . $client->id,
            'codice_fiscale' => 'nullable|required_without:partita_iva|alpha_num|uppercase|min:16|max:16|unique:clients,codice_fiscale,' . $client->id,
            'sdi' => 'required|alpha_num|uppercase|min:7|max:7|unique:clients,sdi,' . $client->id,
            'pec' => 'required|email|min:0|max:128',
            'sede_legale' => 'required|string',
            'city' => 'required|string',
            'province_id' => 'required|integer|min:0',
            'region_id' => 'required|integer|min:0',
        ]);

        $client->update($data);

        $client_type = ClientType::find($data['client_type_id']);
        $client->client_type()->associate($client_type);

        $pricing_type = PricingType::find($data['pricing_type_id']);
        $client->pricing_type()->associate($pricing_type);

        $province = Province::find($data['province_id']);
        $client->province()->associate($province);

        $region = Region::find($data['region_id']);
        $client->region()->associate($region);

        $client->save();

        return redirect()->route('dashboard.clients.show', $client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->client_type()->dissociate();

        $client->pricing_type()->dissociate();

        $client->province()->dissociate();

        $client->region()->dissociate();

        $client->delete();

        return redirect()->route('dashboard.clients.index');
    }
}
