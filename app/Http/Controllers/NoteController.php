<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Models\Note;
/**
 * @OA\Schema(
 *     schema="Note",
 *     required={"user_id", "header", "note"},
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="header", type="string", example="header"),
 *     @OA\Property(property="note", type="string", example="note")
 * )
 */

class NoteController extends Controller
{
    /**
     * @OA\Post(
     *     path="/add-note",
     *     summary="Create a note",
     *     description="Create a new note",
     *     tags={"Notes"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="header", type="string", example="Сходить к анестезиологу"),
     *             @OA\Property(property="note", type="string", example="Анестезиолог сказал, что мне не поможет наркоз, поэтому будут проводить операцию на живом")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/Note"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     )
     * )
     */
    public function store(StoreNoteRequest $request)
    {
        $kit = Note::create($request->all());

        return response()->json(['data' => $kit], 201);
    }

}
