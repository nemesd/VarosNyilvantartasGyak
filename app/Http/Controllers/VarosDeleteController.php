<?php

namespace App\Http\Controllers;

use App\Models\Varos;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VarosDeleteController extends Controller
{
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
