<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQuestionRequest;
use App\Models\Question;

/**
 * @OA\Schema(
 *     schema="Question",
 *     required={"appointment_id", "question"},
 *     @OA\Property(property="appointment_id", type="integer", example=1),
 *     @OA\Property(property="question", type="string", example="Question 1")
 * )
 */

class QuestionController extends Controller
{
    /**
     * @OA\Post(
     *     path="/add-question",
     *     summary="Create questions",
     *     description="Create new questions",
     *     tags={"Questions"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="questions",
     *                 type="array",
     *                 @OA\Items(
     *                     allOf={
     *                         @OA\Schema(
     *                             required={"appointment_id", "question"},
     *                             @OA\Property(property="appointment_id", type="integer", example=1),
     *                             @OA\Property(property="question", type="string", example="How to breathe?")
     *                         ),
     *                         @OA\Schema(
     *                             required={"appointment_id", "question"},
     *                             @OA\Property(property="appointment_id", type="integer", example=1),
     *                             @OA\Property(property="question", type="string", example="How to walk?")
     *                         )
     *                     }
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Question")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */

    public function store(StoreQuestionRequest $request)
    {
        $questionsData = $request->input('questions', []);
        $questions = [];

        foreach ($questionsData as $questionData) {
            $question = Question::create($questionData);
            $questions[] = $question;
        }

        return response()->json(['data' => $questions], 201);
    }

}
