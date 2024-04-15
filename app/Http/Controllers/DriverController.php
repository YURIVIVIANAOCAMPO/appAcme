<?php

namespace App\Http\Controllers;
use App\Models\Driver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class DriverController extends Controller
{
 // Mostrar todos los conductores
 public function index()
 {
     $drivers = Driver::all();
     return response()->json($drivers);
 }

 // Mostrar un conductor específico
 public function show($id)
 {
     $driver = Driver::find($id);

     if (!$driver) {
         return response()->json(['error' => 'Conductor no encontrado'], 404);
     }

     return response()->json($driver);
 }

 // Crear un nuevo conductor
 public function store(Request $request)
 {
     $validator = Validator::make($request->all(), [
         'identification_number' => 'required|unique:drivers|max:20',
         'first_name' => 'required',
         'last_name' => 'required',
         'address' => 'required',
         'phone' => 'required',
         'city' => 'required',
     ]);

     if ($validator->fails()) {
         return response()->json(['errors' => $validator->errors()], 400);
     }

     $driver = Driver::create($request->all());

     return response()->json($driver, 201);
 }

 // Actualizar un conductor existente
 public function update(Request $request, $id)
 {
     $driver = Driver::find($id);

     if (!$driver) {
         return response()->json(['error' => 'Conductor no encontrado'], 404);
     }

     $validator = Validator::make($request->all(), [
         'identification_number' => 'required|max:20|unique:drivers,identification_number,' . $driver->id,
         'first_name' => 'required',
         'last_name' => 'required',
         'address' => 'required',
         'phone' => 'required',
         'city' => 'required',
     ]);

     if ($validator->fails()) {
         return response()->json(['errors' => $validator->errors()], 400);
     }

     $driver->update($request->all());

     return response()->json($driver, 200);
 }

 // Eliminar un conductor
 public function destroy($id)
 {
     $driver = Driver::find($id);

     if (!$driver) {
         return response()->json(['error' => 'Conductor no encontrado'], 404);
     }

     $driver->delete();

     return response()->json(null, 204);
 }
}
