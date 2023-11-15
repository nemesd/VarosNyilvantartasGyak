<?php

namespace App\Http\Controllers;

use App\Models\Varos;
use Illuminate\Http\Request;

class VarosController extends Controller
{
    public function varosLekerese($megyeid){
        $varosok = Varos::where('megyeid', $megyeid)->get();
        return response()->json(['varosok' => $varosok]);
    }
    public function varosHozzaad(Request $request){
        $this->validate($request, [
            'nev'=> 'required',
            'megyeId' => 'required',
        ]);
        Varos::create($request->all());
        return response()->json(['message' => 'Adat sikeresen hozzáadva']);
    }
    public function varosModosit(Request $request){
        $varos = Varos::find($request->id);
        $varos->update($request->all());
        return response()->json(['message' => 'Adat sikeresen módosítva']);
    }
    public function varosTorol(Request $request){
        $post = Varos::find($request->id);
        $post->delete();
        return response()->json(['message' => 'Adat sikeresen törölve']);
    }
}
