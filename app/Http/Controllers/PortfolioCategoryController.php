<?php

namespace App\Http\Controllers;

use App\Models\Portfolio_Category;
use App\Http\Requests\StorePortfolio_CategoryRequest;
use App\Http\Requests\UpdatePortfolio_CategoryRequest;
use App\Http\Resources\PortfolioCategoryResource;

class PortfolioCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PortfolioCategoryResource::collection(Portfolio_Category::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePortfolio_CategoryRequest $request)
    {
        $requestData = $request->all();
        return Portfolio_Category::create($requestData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Portfolio_Category $portfolio_Category)
    {
        return $portfolio_Category;
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePortfolio_CategoryRequest $request, Portfolio_Category $portfolio_Category)
    {
        $portfolio_Category->update($request->all());
        return $portfolio_Category;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Portfolio_Category $portfolio_Category)
    {
        $portfolio_Category->delete();
        return "Deleted";
    }
}
