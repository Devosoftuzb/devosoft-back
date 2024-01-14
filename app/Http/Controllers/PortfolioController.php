<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Portfolio::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePortfolioRequest $request, Portfolio $portfolio)
    {
        $requestData = $request->all();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            $file->move('images/', $imageName);
            $requestData['image'] = $imageName;
        }else {
            // If no new image is provided, keep the existing image
            $image = $portfolio->image;
        }  
        return Portfolio::create($requestData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio $portfolio)
    {
        return $portfolio;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio)
    {
        $requestData = $request->all();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $imageName = $file->getClientOriginalName();
            $file->move('images/', $imageName);
            $requestData['image'] = $imageName;
        }else {
            // If no new image is provided, keep the existing image
            $image = $portfolio->image;
        }  

        $portfolio->update($requestData);

        return $portfolio;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio $portfolio)
    {
        $portfolio->delete();
        return "Deleted";
    }
}