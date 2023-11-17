<?php
namespace App\Http\Controllers;

use App\Models\Megye;
use App\Models\Varos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VarosController extends Controller
{
    public function varosLekerese($megyeid){
        $varosok = Megye::find($megyeid);
        return response()->json(['varosok' => $varosok->cities]);
    }
    public function varosHozzaad(Request $request){ // Új város felvétele
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

        // Validáljuk az adatokat
        $this->validate($request, [
            'name'=> 'required|unique:city,name,NULL,id,county_id,'.$request['county_id'],
            'county_id' => 'required',
        ]);

        // Létrehozzuk és megvizsgáljuk hogy sikeres e
        $varos = Varos::Create($request->all());
        if($varos){
            return response()->json(['message' => 'Adat sikeresen hozzáadva', 'type' => 'success']);
        } else {
            return response()->json(['message' => 'Adat sikertelen hozzáadva', 'type' => 'fail']);
        }
    }
    public function varosModosit(Request $request){ // Város módosítása
        // Validáljuk az adatot
        $this->validate($request, [
            'name'=> 'required|unique:city,name,NULL,id,county_id,'.$request['county_id'],
            'county_id' => 'required',
        ]);
        $varos = Varos::find($request->id);
        $varos->update($request->all());
        return response()->json(['message' => 'Adat sikeresen módosítva']);
    }
    public function varosTorol(Request $request){ //Város törlése
        $post = Varos::find($request->id);
        $post->delete();
        return response()->json(['message' => 'Adat sikeresen törölve']);
    }
}
