<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class apiResMaiAnh extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //hien thi user
        $user = User::all();
        $data = json_decode($user, true);

        return response()->json($data);
    }



    public function postUser(Request $request){


        $name = $request->input('name');
        $email = $request->input('email');


          User::factory()->create([
            'name' => $name,
            'email' => $email,
        ]);
        
        return response()->json([
            'result' =>true,
            "name" => $name,
            "email" => $email
    ]);

    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
