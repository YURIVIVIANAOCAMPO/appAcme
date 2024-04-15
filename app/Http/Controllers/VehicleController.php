<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{
     // Mostrar todos los vehículos
     public function index()
     {
         $vehicles = Vehicle::all();
         return response()->json($vehicles);
     }
 
     // Mostrar un vehículo específico
     public function show($id)
     {
         $vehicle = Vehicle::find($id);
 
         if (!$vehicle) {
             return response()->json(['error' => 'Vehículo no encontrado'], 404);
         }
 
         return response()->json($vehicle);
     }
 
     // Crear un nuevo vehículo
     public function store(Request $request)
     {
         $validator = Validator::make($request->all(), [
             'plate' => 'required|unique:vehicles|max:20',
             'color' => 'required',
             'brand' => 'required',
             'vehicle_type' => 'required|in:particular,público',
             'owner_id' => 'required|exists:owners,id',
         ]);
 
         if ($validator->fails()) {
             return response()->json(['errors' => $validator->errors()], 400);
         }
 
         $vehicle = Vehicle::create($request->all());
 
         return response()->json($vehicle, 201);
     }
 
     // Actualizar un vehículo existente
     public function update(Request $request, $id)
     {
         $vehicle = Vehicle::find($id);
 
         if (!$vehicle) {
             return response()->json(['error' => 'Vehículo no encontrado'], 404);
         }
 
         $validator = Validator::make($request->all(), [
             'plate' => 'required|max:20|unique:vehicles,plate,' . $vehicle->id,
             'color' => 'required',
             'brand' => 'required',
             'vehicle_type' => 'required|in:particular,público',
             'owner_id' => 'required|exists:owners,id',
         ]);
 
         if ($validator->fails()) {
             return response()->json(['errors' => $validator->errors()], 400);
         }
 
         $vehicle->update($request->all());
 
         return response()->json($vehicle, 200);
     }
 
     // Eliminar un vehículo
     public function destroy($id)
     {
         $vehicle = Vehicle::find($id);
 
         if (!$vehicle) {
             return response()->json(['error' => 'Vehículo no encontrado'], 404);
         }
 
         $vehicle->delete();
 
         return response()->json(null, 204);
     }
}
