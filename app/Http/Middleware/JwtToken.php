<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use PHPOpenSourceSaver\JWTAuth\Exceptions\JWTException;
use PHPOpenSourceSaver\JWTAuth\Exceptions\TokenInvalidException;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class JwtToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            $token = JWTAuth::getToken();
            $user = JWTAuth::toUser($token);
            $payload = JWTAuth::getPayload($token);
            if($payload['exp'] - strtotime("now") <= env('JWT_TTL_BUFFER')) {
                $refresh_token = (string)JWTAuth::refresh($token);
            }
            else {
                $refresh_token = (string)$token;
            }

            if ($user) {
                if (in_array($user->status, [80])) {
                    if (in_array($user->lang, ['id'])) {
                        App::setLocale($user->lang);
                    }

                    $request->attributes->add([
                        '_refresh_token' => $refresh_token,
                        '_user' => $user
                    ]);

                    return $next($request);
                }
                else {
                    return response()->json([
                        'success' => 0,
                        'login' => 1,
                        'message' => ['User inactive'],
                    ], 403);
                }
            }
            else {
                return response()->json([
                    'success' => 0,
                    'login' => 1,
                    'message' => ['Token Not Found'],
                ], 403);
            }
        }
        catch (TokenInvalidException $e) {
            return response()->json([
                'success' => 0,
                'login' => 1,
                'message' => [$e->getMessage()],
            ], 403);
        }
        catch (JWTException $e) {
            return response()->json([
                'success' => 0,
                'login' => 1,
                'message' => [$e->getMessage()],
            ], 403);
        }
        catch (\Exception $e) {
            return response()->json([
                'success' => 0,
                'login' => 1,
                'message' => [$e->getMessage()],
            ], 403);
        }

    }
}
