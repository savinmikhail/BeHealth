<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use App\Models\UserIdentity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * @OA\Post(
     *     path="/user/create",
     *     tags={"User"},
     *     summary="Create a new user",
     *     description="Create a new user and associated user identity",
     *     operationId="createUser",
     *     @OA\RequestBody(
     *         required=true,
     *         description="User data",
     *         @OA\JsonContent(ref="#/components/schemas/StoreUserRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="user",
     *                 type="object",
     *                  description="The created user data",
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 description="The validation error message",
     *                 example="The validation error message"
     *             ),
     *         )
     *     )
     * )
     */
    public function create(StoreUserRequest $request): JsonResponse
    {
        $params = $request->validated();
        $user = User::create([
            'name' => $params['name'],
        ]);

        $userIdentity = UserIdentity::create([
            'user_id' => $user->id,
            'token' => Hash::make($user->name),
            // Add other identifiable fields here
        ]);

//        // Log in the newly created user
//        Auth::login($user);

        return response()->json(['user' => $user]);
    }

    /**
     * @OA\Post(
     *     path="/user/login",
     *     tags={"User"},
     *     summary="User login",
     *     description="Authenticate a user using provided credentials",
     *     operationId="loginUser",
     *     @OA\RequestBody(
     *         required=true,
     *         description="User name",
     *         @OA\JsonContent(
     *             required={"name"},
     *             @OA\Property(property="name", type="string", example="Mikhail"),
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="User authenticated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="string",
     *                 description="Success message",
     *                 example="Signed in successfully"
     *             ),
     *             @OA\Property(
     *                 property="token",
     *                 type="string",
     *                  description="User token",
     *                 example="jajhba34jhjkHN32JK12jnk"
     *             ),
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="data",
     *                 type="string",
     *                 description="Error message",
     *                 example="The provided credentials do not match our records"
     *             ),
     *         )
     *     )
     * )
     */
    public function login(StoreUserRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::where('name', $data['name'])->first();

        if ($user) {
            $userIdentity = UserIdentity::where('user_id', $user->id)->first();
            if($userIdentity->token) {
                if (Hash::check($data['name'], $userIdentity->token)) {
                    $request->session()->regenerate();
                    // Redirect the user to the home page
                    return response()->json(['message' => 'Signed in successfully', 'token' => $userIdentity->token]);
                } else {
                    return response()->json(['message' => 'Credentials do not match', 'data' => [$data['name'], $user->name, $userIdentity->token]]);
                }
            } else {
                return response()->json(['message' => 'Table hash is on null', 'data' => [$data['name'], $user->name, $userIdentity->token]]);
            }
        } else {
            // Authentication failed, return an error message
            return response()->json([
                'message' => 'The provided name do not exists',
                'data' => $data,
            ], 401);
        }
    }

    /**
     * @OA\Get(
     *     path="/user/show",
     *     tags={"User"},
     *     summary="Display the specified user",
     *     description="Display the specified user",
     *     operationId="showUser",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="object",
     *                 description="User"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 description="Error message"
     *             )
     *         )
     *     )
     * )
     */
    public function show(): JsonResponse
    {
        $user = auth()->user();
//        $users = User::get();

        return response()->json(['message' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUserRequest $request): JsonResponse
    {
        $params = $request->validated();

        $user = auth()->user();

        if(empty($user))
        {
            return response()->json(['error' => 'Такого пользователя не существует'], 404);
        }


        foreach ($params as $key => $item) {
            switch ($key) {
                case 'first_name':
                    $user->first_name = $params['first_name'];
                    break;
                case 'last_name':
                    $user->last_name = $params['last_name'];
                    break;
                case 'email':
                    $user->email = $params['email'];
                    break;
                case 'password':
                    $user->password = Hash::make($params['password']);
                    break;
                case 'admin':
                    $user->is_admin = $params['admin'];
                    break;
            }
        }

        $user->save();

        return response()->json(['message' => $user]);
    }

    /**
     * Delete the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(DeleteUserRequest $request)
    {
        $params = $request->validated();

        $user = auth()->user();

        if(empty($user))
        {
            return response()->json(['error' => 'Такого пользователя не существует'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'Пользователь успешно удален']);
    }
}
