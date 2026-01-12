<?php

namespace App\Http\Controllers;
use App\Models\Filma;
use Illuminate\Http\JsonResponse;

use Illuminate\Http\Request;

class DataController extends Controller
{
    // Return 3 published Filmas in random order
    public function getTopFilmas(): JsonResponse
    {
        $filmas = Filma::where('display', true)
        ->inRandomOrder()
        ->take(3)
        ->get();
        return response()->json($filmas);
    }
    // Return selected Filma if it's published
    public function getFilmas(Filma $filmas): JsonResponse
    {
        $selectedFilmas = Filma::where([
        'id' => $filmas->id,
        'display' => true,
        ])
        ->firstOrFail();
        return response()->json($selectedFilmas);
    }
    // Return 3 published Filmas in random order- except the selected Filma
    public function getRelatedFilmas(Filma $filmas): JsonResponse
    {
        $filmas = Filma::where('display', true)
        ->where('id', '<>', $filmas->id)
        ->inRandomOrder()
        ->take(3)
        ->get();
        return response()->json($filmas);
    }

}
