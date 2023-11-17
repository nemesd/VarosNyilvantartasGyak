<?php

namespace App\Http\Controllers;

use App\Models\Varos;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VarosAddController extends Controller
{
    /**
     * Új várost vesz fel vagy ha már volt olyan város csak törölve van visszaállitja
     * Az új városnak egyedinek kell lenije a megyében
     * @param Request $request
     * @return JsonResponse
     */
    public function varosHozzaAd(Request $request): JsonResponse{
        // Ellenőrizzük, hogy van-e soft delete-elt város az adott megyében
        $softDeletedCity = Varos::onlyTrashed()
            ->where('name', $request['name'])
            ->where('county_id', $request['county_id'])
            ->first();

        // Ha találunk soft delete-elt várost, állítsuk vissza
        if ($softDeletedCity) {
            $softDeletedCity->restore();
            return response()->json(['message' => 'Adat sikeresen újra hozzáadva']);
        }
        try{
            // Validáljuk az adatokat
            $this->validate($request, [
                'name'=> 'required|unique:city,name,NULL,id,county_id,'.$request['county_id'],
                'county_id' => 'required',
            ]);
        } catch(Exception $e) {
            return response()->json(['message' => 'Csak egy ilyen nevű lehet a megyében', 'type' => 'danger']);
        }

        // Létrehozzuk és megvizsgáljuk hogy sikeres e
        $varos = Varos::Create($request->all());
        if($varos){
            return response()->json(['message' => 'Adat sikeresen hozzáadva']);
        } else {
            return response()->json(['message' => 'Adatot nem sikerült hozzáadni', 'type' => 'danger']);
        }
    }
}
