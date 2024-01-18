<?php

namespace App\Http\Controllers;

use App\Models\Advantage;
use App\Http\Requests\StoreAdvantageRequest;
use App\Http\Requests\UpdateAdvantageRequest;

class AdvantageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Advantage::all(); 
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdvantageRequest $request, Advantage $advantage)
    {
        $requestData = $request->all();
        
        if($request->hasFile('image')){
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            $file->move('images/', $imageName);
            $requestData['image'] = $imageName;
        }else {
            // If no new image is provided, keep the existing image
            $image = $advantage->image;
        }            

        return Advantage::create($requestData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Advantage $advantage)
    {
        return $advantage;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAdvantageRequest $request, Advantage $advantage)
    {
        $requestData = $request->all();
        
        if($request->hasFile('image')){
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            $file->move('images/', $imageName);
            $requestData['image'] = $imageName;
        }else {
            // If no new image is provided, keep the existing image
            $image = $advantage->image;
        }   

        $advantage->update($requestData);
        return $advantage;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Advantage $advantage)
    {
        $advantage->delete();
        return response()->json(null, 204);
    }
}
