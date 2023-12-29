<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Region;
use App\Models\Commune;
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function register(Request $request)
    {
        try {
            $regionId = $request->region_id;
            $communeId = $request->commune_id;

            $region = Region::findOrFail($regionId);

            if (!$region || !$region->communes()->where('id_com', $communeId)->exists()) {
                Log::info("register: La comuna no está relacionada con la región. Detalles: " . json_encode($request->all()));
                return response()->json(['error' => 'La comuna no está relacionada con la región.'], 400);
            }

            $existingRecord = Customer::where('dni', $request->dni)
                ->where('email', $request->email)
                ->first();

            if ($existingRecord) {
                Log::info("register: El cliente ya está registrado. Detalles: " . json_encode($request->all()));
                return response()->json(['error' => 'El cliente ya está registrado.'], 400);
            }

            $customer = Customer::create([
                'dni' => $request->dni,
                'id_reg' => $regionId,
                'id_com' => $communeId,
                'email' => $request->email,
                'name' => $request->name,
                'last_name' => $request->last_name,
                'address' => $request->address,
                'status' => "A",
            ]);

            Log::info("register: Cliente registrado con éxito. Detalles: " . json_encode($customer));
            return response()->json(['message' => 'Cliente registrado con éxito.'], 201);
        } catch (\Exception $e) {
            Log::error("register: Error al procesar la solicitud. Detalles: " . $e->getMessage() . ". Datos de la solicitud: " . json_encode($request->all()));
            return response()->json(['error' => 'Error al procesar la solicitud. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function getRecord(Request $request)
    {
        try {
            $customer = Customer::when($request->has('email'), function ($query) use ($request) {
                    $query->where('email', $request->email);
                })
                ->when($request->has('dni'), function ($query) use ($request) {
                    $query->orWhere('dni', $request->dni);
                })
                ->where('status', 'A')
                ->first(['name', 'last_name', 'address', 'id_reg', 'id_com']);

            if (!$customer) {
                Log::info("getRecord: No se encontró ningún cliente activo con la información proporcionada. Detalles: " . json_encode($request->all()));
                return response()->json(['error' => 'No se encontró ningún cliente activo con la información proporcionada.'], 404);
            }

            $customer['address'] = $customer->address ?? null;

            Log::info("getRecord: Cliente encontrado con éxito. Detalles: " . json_encode($customer));
            return response()->json(['customer' => $customer], 200);
        } catch (\Exception $e) {
            Log::error("getRecord: Error al procesar la solicitud. Detalles: " . $e->getMessage() . ". Datos de la solicitud: " . json_encode($request->all()));
            return response()->json(['error' => 'Error al procesar la solicitud. Detalles: ' . $e->getMessage()], 500);
        }
    }

    public function deleteRecord(Request $request)
    {
        try {

            $customer = Customer::where('dni', $request->dni)
                ->whereIn('status', ['A', 'I'])
                ->first();

            if (!$customer) {
                Log::info("deleteRecord: Registro no existe. Detalles: " . json_encode($request->all()));
                return response()->json(['error' => 'Registro no existe.'], 404);
            }

            if ($customer->status === 'trash') {
                Log::info("deleteRecord: Registro en estado 'trash', no se puede eliminar. Detalles: " . json_encode($request->all()));
                return response()->json(['error' => 'Registro en estado "trash", no se puede eliminar.'], 400);
            }

            $customer->status = 'trash';
            $customer->save();
            $customer->delete();

            Log::info("deleteRecord: Cliente eliminado con éxito. Detalles: " . json_encode($customer));
            return response()->json(['message' => 'Cliente eliminado con éxito.'], 200);
        } catch (\Exception $e) {
            Log::error("deleteRecord: Error al procesar la solicitud. Detalles: " . $e->getMessage() . ". Datos de la solicitud: " . json_encode($request->all()));
            return response()->json(['error' => 'Error al procesar la solicitud. Detalles: ' . $e->getMessage()], 500);
        }
    }
}
