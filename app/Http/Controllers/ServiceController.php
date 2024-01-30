<?php

namespace App\Http\Controllers;

use App\Events\NewServiceEvent;
use App\Models\Service;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Service::paginate(10);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        $requestData = $request->all();
        $service = Service::create($requestData);

        // Emit the event after creating the service
        event(new NewServiceEvent('A new service has been created!', $service->id));

        return $service;
        }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        return $service;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        $service->update($request->all());
        return $service;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(null, 204);
    }
}
