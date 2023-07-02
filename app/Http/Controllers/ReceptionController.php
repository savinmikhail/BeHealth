<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReceptionRequest;
use App\Models\Reception;
use Illuminate\Http\Request;
/**
 * @OA\Schema(
 *     schema="Reception",
 *     required={"treatment_id", "date", "time"},
 *     @OA\Property(property="treatment_id", type="integer", example=1),
 *     @OA\Property(property="date", type="string", format="date", example="2023-07-01"),
 *     @OA\Property(property="time", type="string", format="time", example="18:25:43")
 * )
 */

class ReceptionController extends Controller
{
    /**
     * @OA\Post(
     *     path="/add-reception",
     *     summary="Create reception",
     *     description="Create a new reception",
     *     tags={"Reception"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="treatment_id", type="integer", example=1),
     *             @OA\Property(property="date", type="string", format="date", example="2023-07-01"),
     *             @OA\Property(property="time", type="string", format="time", example="18:25:43")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/Reception"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(StoreReceptionRequest $request)
    {
        $reception = Reception::create($request->all());

        return response()->json(['data' => $reception], 201);
    }

}
