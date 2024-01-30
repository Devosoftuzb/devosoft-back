<?php

namespace App\Http\Controllers;

use App\Models\Partnership;
use App\Http\Requests\StorePartnershipRequest;
use App\Http\Requests\UpdatePartnershipRequest;

class PartnershipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Partnership::paginate(10);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePartnershipRequest $request, Partnership $partnership)
    {
        $requestData = $request->all();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            $file->move('images/', $imageName);
            $requestData['image'] = $imageName;
        }else {
            // If no new image is provided, keep the existing image
            $image = $partnership->image;
        }     

        return Partnership::create($requestData);

    }

    /**
     * Display the specified resource.
     */
    public function show(Partnership $partnership)
    {
        return $partnership;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePartnershipRequest $request, Partnership $partnership)
    {
        $requestData = $request->all();

        $requestData = $request->all();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            $file->move('images/', $imageName);
            $requestData['image'] = $imageName;
        }else {
            // If no new image is provided, keep the existing image
            $image = $partnership->image;
        }   

        $partnership->update($requestData);
        return $partnership;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partnership $partnership)
    {
        $partnership->delete();
        return response()->json(null, 204);
    }
}
