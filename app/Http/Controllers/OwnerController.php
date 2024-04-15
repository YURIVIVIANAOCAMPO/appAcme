<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OwnerController extends Controller
{
    // Mostrar todos los propietarios
    public function index()
    {
        $owners = Owner::all();
        return response()->json($owners);
    }

    // Mostrar un propietario específico
    public function show($id)
    {
        $owner = Owner::find($id);

        if (!$owner) {
            return response()->json(['error' => 'Propietario no encontrado'], 404);
        }

        return response()->json($owner);
    }

    // Crear un nuevo propietario
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identification_number' => 'required|unique:owners|max:20',
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'city' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $owner = Owner::create($request->all());

        return response()->json($owner, 201);
    }

    // Actualizar un propietario existente
    public function update(Request $request, $id)
    {
        $owner = Owner::find($id);

        if (!$owner) {
            return response()->json(['error' => 'Propietario no encontrado'], 404);
        }

        $validator = Validator::make($request->all(), [
            'identification_number' => 'required|max:20|unique:owners,identification_number,' . $owner->id,
            'first_name' => 'required',
            'last_name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'city' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $owner->update($request->all());

        return response()->json($owner, 200);
    }

    // Eliminar un propietario
    public function destroy($id)
    {
        $owner = Owner::find($id);

        if (!$owner) {
            return response()->json(['error' => 'Propietario no encontrado'], 404);
        }

        $owner->delete();

        return response()->json(null, 204);
    }
}
