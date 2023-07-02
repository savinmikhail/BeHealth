<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Appointment",
 *     required={"id", "user_id", "specialist", "date", "time", "place"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="specialist", type="string", example="demiurge"),
 *     @OA\Property(property="date", type="string", format="date", example="2023-07-01"),
 *     @OA\Property(property="time", type="string", format="time", example="18:25:43"),
 *     @OA\Property(property="place", type="string", example="North hemisphere")
 * )
 */

class AppointmentController extends Controller
{
    /**
     * @OA\Post(
     *     path="/add-appointment",
     *     summary="Create an appointment",
     *     description="Create a new appointment",
     *     tags={"Appointment"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="specialist", type="string", example="demiurge"),
     *             @OA\Property(property="date", type="string", format="date", example="2023-07-01"),
     *             @OA\Property(property="time", type="string", format="time", example="18:25:43"),
     *             @OA\Property(property="place", type="string", example="North hemisphere")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/Appointment"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(StoreAppointmentRequest $request)
    {
        $appointment = Appointment::create($request->all());

        return response()->json(['data' => $appointment], 201);
    }
}
