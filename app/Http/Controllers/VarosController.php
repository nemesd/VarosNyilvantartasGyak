<?php
namespace App\Http\Controllers;

use App\Models\Megye;
use App\Models\Varos;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VarosController extends Controller
{
    /**
     * Visszaadja a kért megyéből a városokat
     * 
     * @param int $megyeid A megye id-je
     * @return JsonResponse
     */
    public function varosLekerese(int $megyeid): JsonResponse{
        $varosok = Megye::find($megyeid);
        return response()->json(['varosok' => $varosok->cities]);
    }

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
            return response()->json(['message' => 'Adat sikeresen újra hozzáadva', 'type' => 'success']);
        }
        try{
        // Validáljuk az adatokat
        $this->validate($request, [
            'name'=> 'required|unique:city,name,NULL,id,county_id,'.$request['county_id'],
            'county_id' => 'required',
        ]);
        } catch(Exception $e) {
            return response()->json(['message' => 'Csak egy ilyen város lehet egy megyében', 'type' => 'fail']);
        }

        // Létrehozzuk és megvizsgáljuk hogy sikeres e
        $varos = Varos::Create($request->all());
        if($varos){
            return response()->json(['message' => 'Adat sikeresen hozzáadva', 'type' => 'success']);
        } else {
            return response()->json(['message' => 'Adatot nem sikerült hozzáadni', 'type' => 'fail']);
        }
    }

    /**
     * Várost módosít de csak olyanra mi nincs már a megyében
     * @param Request $request
     * @return JsonResponse
     */
    public function varosModosit(Request $request): JsonResponse{
        // Validáljuk az adatot
        $this->validate($request, [
            'name'=> 'required|unique:city,name,NULL,id,county_id,'.$request['county_id'],
        ]);
        $varos = Varos::find($request->id);
        $varos->update($request->all());
        return response()->json(['message' => 'Adat sikeresen módosítva']);
    }

    /**
     * Az id alapján kért várost kitörli
     * @param Reques $request
     * @return JsonResponse
     */
    public function varosTorol(Request $request): JsonResponse{
        $post = Varos::find($request->id);
        $post->delete();
        return response()->json(['message' => 'Adat sikeresen törölve']);
    }
}
