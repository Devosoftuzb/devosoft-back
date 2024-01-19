<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Http\Requests\StoreTeamRequest;
use App\Http\Requests\UpdateTeamRequest;


class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Team::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTeamRequest $request, Team $team)
    {
        $requestData = $request->all();
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = $file->hashName(); 
            $path = $file->storeAs('images', $imageName);
            $requestData['image'] = $path;
        } else {
            $requestData['image'] = $team->image;
        }          

        return Team::create($requestData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Team $team)
    {
        return $team;
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTeamRequest $request, Team $team)
    {
        $requestData = $request->all();
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = $file->hashName(); 
            $path = $file->storeAs('images', $imageName);
            $requestData['image'] = $path;
        } else {
            $requestData['image'] = $team->image;
        }            

        $team->update($requestData);
        return $team;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return response()->json(null, 204);
    }
}
