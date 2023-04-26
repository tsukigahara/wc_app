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
        $clients = Client::with(['client_type', 'pricing_type', 'province', 'region'])
            ->latest('updated_at')
            ->when(FacadesRequest::input('search'), function ($query, $search) {
                $query->where('ragione_sociale', 'like', '%' . $search . '%');
            })
            ->when(FacadesRequest::input('filter'), function ($query, $filter) {
                $column = '';
                switch ($filter) {
                    case 'ragione_sociale':
                        $column = 'ragione_sociale';
                        break;
                    case 'partita_iva':
                        $column = 'partita_iva';
                        break;
                    case 'codice_fiscale':
                        $column = 'codice_fiscale';
                        break;
                    case 'sdi':
                        $column = 'sdi';
                        break;
                    case 'pec':
                        $column = 'pec';
                        break;
                    case 'sede_legale':
                        $column = 'sede_legale';
                        break;
                    case 'city':
                        $column = 'city';
                        break;
                        // Aggiungi altri casi per le colonne desiderate
                }
                if ($column !== '') {
                    $query->where($column, 'like', '%' . FacadesRequest::input('search') . '%');
                }
            })->paginate(20)->appends(FacadesRequest::only('search'));
        return Inertia::render('Client/Index', [
            'clients' => $clients,
            'filters' => FacadesRequest::only('search'),
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
            'partita_iva' => 'required|numeric|digits:11|unique:clients',
            'codice_fiscale' => 'required|alpha_num|uppercase|min:16|max:16|unique:clients',
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
