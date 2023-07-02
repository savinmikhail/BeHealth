<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      title="Be Health",
 *      version="1.0.0",
 *      @OA\Contact(
 *          email="admin@example.com"
 *      ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="https://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\Tag(
 *     name = "Auth",
 *     description = "Auth description",
 * )
 * @OA\Server(
 *     description="Laravel Swagger API Server",
 *     url="http://localhost:82/api"
 * )
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     name="X-APP-ID",
 *     securityScheme="X-APP-ID"
 *)
 *
 * @OA\Schema(
 *     schema="User",
 *      type="object",
 *      required={"email", "password"},
 *      @OA\Property( property="email", type="string", description="User email"),
 *      @OA\Property( property="password", type="string", description="User password")
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
