<?php

declare(strict_types=1);

namespace App\Controllers\Services;

use App\Helpers\ResultHelper;
use Firebase\JWT\JWT;
use App\Models\User;

class UserService
{

    /**
     * @return string
     */
    public static function getUser(): string
    {
        $email = self::getCurrentUserEmail();
        $user = User::query()->where('u_email', $email)->get()->makeHidden(['u_password'])->first();
        return $user
            ? ResultHelper::getResultSuccess($user)
            : ResultHelper::getResultFail("User not found!");
    }

    /**
     * @return string
     */
    private static function getCurrentUserEmail(): string
    {
        // Get jwt key from .env
        $secret = env("JWT_KEY");
        // decode jwt token
        $userData = (array)JWT::decode($_COOKIE['token'], $secret, array('HS256'));
        return $userData['jti'];
    }

}
