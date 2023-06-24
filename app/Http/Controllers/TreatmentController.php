<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTreatmentRequest;
use App\Models\Treatment;
use Illuminate\Http\JsonResponse;

class TreatmentController extends Controller
{
    public function store(StoreTreatmentRequest $request): JsonResponse
    {
        $treatment = Treatment::create($request->all());

        return response()->json(['data' => $treatment], 201);
    }
}
