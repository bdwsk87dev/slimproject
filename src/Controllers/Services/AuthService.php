<?php

declare(strict_types=1);

namespace App\Controllers\Services;

use App\Controllers\Validators\AuthValidator;
use App\Helpers\ResultHelper;
use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Support\Collection;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Respect\Validation\Validator as v;

class AuthService
{
    /**
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public static function register(Request $request, Response $response) : string
    {
        $validator = new AuthValidator();
        $validator->validate($request, [
            "u_first_name" => v::notEmpty(),
            "u_last_name" => v::notEmpty(),
            "u_email" => v::notEmpty()->email(),
            "u_password" => v::notEmpty()
        ]);
        if ($validator->failed()) {
            return self::validatorError($validator->errors);
        }

        // Проверяем указанный email на существование в базе данных
        if (self::EmailExist(self::getParam($request, "u_email"))) {
            $responseMessage = "this email already exists";
            return ResultHelper::getResultFail($responseMessage);
        }

        // Шифруем пароль
        $passwordHash = self::hashPassword(self::getParam($request, "u_password"));

        // Создаём нового пользователя
        $user = new User();
        $user->create([
            "u_first_name" => self::getParam($request, "u_first_name"),
            "u_last_name" => self::getParam($request, "u_last_name"),
            "u_email" => self::getParam($request, "u_email"),
            "u_middle_name" => self::getParam($request, "u_middle_name"),
            "u_password" => $passwordHash
        ]);
        $responseMessage = "new user created successfully";
        return ResultHelper::getResultSuccess($responseMessage);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return string
     */
    public static function login (Request $request, Response $response) : string
    {
        $validator = new AuthValidator();
        $validator->validate($request, [
            "u_email" => v::notEmpty()->email(),
            "u_password" => v::notEmpty()
        ]);

        if ($validator->failed()) {
            return self::validatorError($validator->errors);
        }

        $verifyAccount = self::verifyAccount(self::getParam($request, "u_password"),
            self::getParam($request, "u_email"));

        if (!$verifyAccount) {
            $responseMessage = "invalid username or password";
            return ResultHelper::getResultFail($responseMessage);
        }

        return ResultHelper::getResultSuccess(self::generateToken(self::getParam($request, "u_email")));
    }

    /**
     * @param string $password
     * @param string $email
     * @return bool
     */
    public static function verifyAccount(string $password, string $email): bool
    {
        $user = new User();
        $users = $user->where(["u_email" => $email])->get();
        if ($users->isEmpty()) {
            return false;
        }
        foreach ($users as $user) {
            $hashPassword = $user->u_password;
        }
        $verify = password_verify($password, $hashPassword);
        if (!$verify) {
            return false;
        }
        return true;
    }

    /**
     * @param string $email
     * @return bool
     */
    public static function EmailExist(string $email): bool
    {
        $user = new User();
        $count = $user->where(["u_email" => $email])->count();
        if ($count == 0) {
            return false;
        }
        return true;
    }

    /**
     * @param $password
     * @return string
     */
    public static function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @param string $token
     * @return void
     */
    public static function setCookie(string $token)
    {
        setcookie('token', $token, time() + (86400 * 30), "/");
    }

    /**
     * @param string $email
     * @return string
     */
    public static function generateToken(string $email): string
    {
        $now = time();
        $future = strtotime('+24 hours', $now);
        $secret = env("JWT_KEY");
        $payload = [
            "jti" => $email,
            "iat" => $now,
            "exp" => $future
        ];
        $jwtToken = JWT::encode($payload, $secret);
        self::setCookie($jwtToken);
        return $jwtToken;
    }

    /**
     * @param Request $request
     * @param string $key
     * @param $default
     * @return string
     */
    public static function getParam(Request $request, string $key, $default = null)
    {
        $postParams = $request->getParsedBody();
        $getParams = $request->getQueryParams();
        $getBody = json_decode($request->getBody(), true);
        $result = $default;

        if (is_array($postParams) && isset($postParams[$key])) {
            $result = $postParams[$key];
        } else {
            if (is_object($postParams) && property_exists($postParams, $key)) {
                $result = $postParams->$key;
            } else {
                if (is_array($getBody) && isset($getBody[$key])) {
                    $result = $getBody[$key];
                } else {
                    if (isset($getParams[$key])) {
                        $result = $getParams[$key];
                    }
                }
            }
        }
        return $result;
    }

    /**
     * @param array $errors
     * @return string
     */
    public static function validatorError(array $errors)
    {
        $res = Collection::make($errors)->toJson();
        $res = str_replace('"', "'", $res);
        return ResultHelper::getResultFail($res);
    }
}