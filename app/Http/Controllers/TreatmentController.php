<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTreatmentRequest;
use App\Models\Treatment;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Schema(
 *     schema="Treatment",
 *     required={"user_id", "unit_id", "kit_id", "name", "dose", "comment", "status"},
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="unit_id", type="integer", example=1),
 *     @OA\Property(property="kit_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Xanax"),
 *     @OA\Property(property="dose", type="number", format="float", example=1.5),
 *     @OA\Property(property="comment", type="string", example="before"),
 *     @OA\Property(property="status", type="boolean", example=true)
 * )
 */


class TreatmentController extends Controller
{
    /**
     * @OA\Post(
     *     path="/add-treatment",
     *     summary="Create treatment",
     *     description="Create a new treatment",
     *     tags={"Treatments"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *              @OA\Property(property="user_id", type="integer", example=1),
     *              @OA\Property(property="unit_id", type="integer", example=1),
     *              @OA\Property(property="kit_id", type="integer", example=1),
     *              @OA\Property(property="name", type="string", example="Xanax"),
     *              @OA\Property(property="dose", type="number", format="float", example=1.5),
     *              @OA\Property(property="comment", type="string", example="before"),
     *              @OA\Property(property="status", type="boolean", example=true)
     * )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/Treatment"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(StoreTreatmentRequest $request): JsonResponse
    {
        $treatment = Treatment::create($request->all());

        return response()->json(['data' => $treatment], 201);
    }
}
