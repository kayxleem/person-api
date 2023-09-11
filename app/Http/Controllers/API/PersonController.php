<?php

namespace App\Http\Controllers\API;

use App\Models\Person;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonRequest;
use App\Http\Resources\PersonResource;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = Person::all();
        return response()->json($people);

    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonRequest $request)
    {
        $person = Person::create($request->all());
        return response()->json($person);
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        return response()->json($person);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PersonRequest $request, Person $person)
    {
        $person->update($request->all());
        return response()->json($person);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        $name = $person->name;
        $person->delete();
        return response()->json(['status_code'=>204 ,'status'=>'success', 'message' => 'The person with ' . $name . ' was deleted successfully' ] );
    }
}
