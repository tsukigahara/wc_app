<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DeliveryData;
use App\Models\Province;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Inertia\Inertia;

class DeliveryDataController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $delivery_datas = DeliveryData::with(['province', 'region', 'delivery_data'])
            ->latest('updated_at')
            ->when(FacadesRequest::input('search'), function ($query, $search) {
                $query->where('sign', 'like', '%' . $search . '%')
                    ->orWhere('reference_name', 'like', '%' . $search . '%');
                //aggiundere altri criteri di ricerca
            })
            ->paginate(20)->appends(FacadesRequest::only('search'));
        return Inertia::render('DeliveryData/Index', [
            'delivery_datas' => $delivery_datas,
            'filters' => FacadesRequest::only(['search', 'filter']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Client $client)
    {
        return Inertia::render('DeliveryData/Create', [
            'provinces' => Province::all(),
            'regions' => Region::all(),
            'client' => $client,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Client $client)
    {
        $data = $request->validate([
            'sign' => 'required|string|min:0|max:128',
            'address' => 'required|string|min:0',
            'city' => 'required|string|min:0',
            'note' => 'nullable|string|min:0',
            'reference_name' => 'required|string|min:0',
            'email' => 'required|email|min:0|max:128',
            'telephone' => 'required|numeric',
            'city' => 'required|string',
            'province_id' => 'required|integer|min:0',
            'region_id' => 'required|integer|min:0',
        ]);

        $delivery_data = DeliveryData::make($data);

        $province = Province::find($data['province_id']);
        $delivery_data->province()->associate($province);

        $delivery_data->client()->associate($client);

        $region = Region::find($data['region_id']);
        $delivery_data->region()->associate($region);

        $delivery_data->save();

        return redirect()->route('dashboard.clients.show', $client);
    }

    /**
     * Display the specified resource.
     */
    public function show(DeliveryData $deliveryData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client, DeliveryData $deliveryData)
    {
        return Inertia::render('DeliveryData/Edit', [
            'provinces' => Province::all(),
            'regions' => Region::all(),
            'deliveryData' => $deliveryData,
            'client' => $client,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client, DeliveryData $deliveryData)
    {
        $data = $request->validate([
            'sign' => 'required|string|min:0|max:128',
            'address' => 'required|string|min:0',
            'city' => 'required|string|min:0',
            'note' => 'nullable|string|min:0',
            'reference_name' => 'required|string|min:0',
            'email' => 'required|email|min:0|max:128',
            'telephone' => 'required|numeric',
            'city' => 'required|string',
            'province_id' => 'required|integer|min:0',
            'region_id' => 'required|integer|min:0',
        ]);

        $deliveryData->update($data);

        $province = Province::find($data['province_id']);
        $deliveryData->province()->associate($province);

        $region = Region::find($data['region_id']);
        $deliveryData->region()->associate($region);

        $deliveryData->save();

        return redirect()->route('dashboard.clients.show', $client);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client, DeliveryData $deliveryData)
    {
        $deliveryData->province()->dissociate();
        $deliveryData->region()->dissociate();
        $deliveryData->client()->dissociate();

        $deliveryData->delete();

        return redirect()->back();
    }
}
