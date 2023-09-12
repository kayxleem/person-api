<?php

namespace App\Http\Controllers\API;

use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\PersonRequest;
use App\Http\Resources\PersonResource;
use Symfony\Component\HttpFoundation\Response;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {

        $people = Person::all();
        if ($people->count() > 0) {
            return response()->json($people);
        } else {
            return response()->json(['status_code' => Response::HTTP_NOT_FOUND, 'status' => 'success', 'message' => 'No person found']);
            ;
        }

    }



    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function store(PersonRequest $request): JsonResponse
    {
        $person = Person::create($request->all());
        return response()->json($person);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        $person = Person::find($id);
        if (!$person) {
            return response()->json(['status_code' => Response::HTTP_NOT_FOUND, 'status' => 'error', 'message' => 'person does not exist']);
        } else {
            return response()->json($person);
        }

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $person = Person::find($id);
        if (!$person) {
            return response()->json(['status_code' => Response::HTTP_NOT_FOUND, 'status' => 'error', 'message' => 'person does not exist']);
        } else {
            $person->update($request->all());
            return response()->json($person);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $person = Person::find($id);
        if (!$person) {
            return response()->json(['status_code' => Response::HTTP_NOT_FOUND, 'status' => 'error', 'message' => 'person does not exist']);
        } else {
            $name = $person->name;
            $person->delete();
            return response()->json(['status_code' => Response::HTTP_NO_CONTENT, 'status' => 'success', 'message' => 'The person with name ' . $name . ' was deleted successfully']);
        }

    }
}
