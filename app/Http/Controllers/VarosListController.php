<?php

namespace App\Http\Controllers;

use App\Models\Megye;
use Illuminate\Http\JsonResponse;

class VarosListController extends Controller
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
}
