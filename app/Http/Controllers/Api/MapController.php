<?php

namespace App\Http\Controllers\Api;

use App\Services\YandexMapService;
use Illuminate\Http\JsonResponse;

class MapController
{
    public function getMapData(): JsonResponse
    {
        $service = new YandexMapService();
        $points = $service->getPoints();

        return response()->json($points);
    }
}
