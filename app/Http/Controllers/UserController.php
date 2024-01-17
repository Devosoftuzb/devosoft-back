<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return $user;
    }
   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => "required",
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user->update($request->all());
        return $user;
    }


}
