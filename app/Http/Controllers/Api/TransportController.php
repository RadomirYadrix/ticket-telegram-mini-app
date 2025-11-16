<?php

namespace App\Http\Controllers\Api;

use App\Models\Transport;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TransportController
{
    public function index(Request $request): JsonResponse
    {
        $type = $request->get('type');
        $query = Transport::query();

        if ($type) {
            $query->where('type', $type);
        }

        return response()->json($query->get());
    }

    public function byType(string $type): JsonResponse
    {
        $transports = Transport::where('type', $type)->get();
        return response()->json($transports);
    }
}
