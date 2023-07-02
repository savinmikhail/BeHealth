<?php

namespace App\Http\Controllers;

use App\Models\Kit;
use App\Models\Treatment;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Kit",
 *     required={"user_id", "unit_id", "name", "amount"},
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="unit_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Xanax"),
 *     @OA\Property(property="amount", type="number", format="float", example=18),
 * )
 */
class KitController extends Controller
{
    /**
     * @OA\Get(
     *     path="/treatment-amount/{treatment_id}",
     *     summary="Get kit amount",
     *     description="Retrieve the amount of a kit associated with a specific treatment",
     *     tags={"Kit"},
     *     @OA\Parameter(
     *         name="treatment_id",
     *         in="path",
     *         description="ID of the treatment",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64",
     *             example=1
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="number",
     *                 format="float",
     *                 example=1.23
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Treatment or kit not found"
     *     )
     * )
     */
    public function kitAmount($treatment_id)
    {
        $treatment = Treatment::find($treatment_id);
        $kit = Kit::find($treatment->kit_id);

        if (!$kit) {
            return response()->json(['error' => 'Kit not found'], 404);
        }

        return response()->json(['data' => $kit->amount], 201);
    }

}
