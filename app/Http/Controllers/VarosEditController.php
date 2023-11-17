<?php

namespace App\Http\Controllers;

use App\Models\Varos;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

use function Laravel\Prompts\error;

class VarosEditController extends Controller
{
    /**
     * Várost módosít de csak olyanra mi nincs már a megyében
     * @param Request $request
     * @return JsonResponse
     */
    public function varosModosit(Request $request): JsonResponse{
        try{
            // Validáljuk az adatot
            $this->validate($request, [
                'name'=> 'required|unique:city,name,NULL,id,county_id,'.$request['county_id'],
            ]);
        } catch(Exception $e) {
            return response()->json(['message' => 'Csak egy ilyen nevű lehet a megyében', 'type' => 'danger']);
        }
        $varos = Varos::find($request->id);
        $varos->update($request->all());
        return response()->json(['message' => 'Adat sikeresen módosítva']);
    }
}
