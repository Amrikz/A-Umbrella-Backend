<?php

namespace App\Http\Responses;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Traits\CanSendResponses;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    use CanSendResponses, PasswordValidationRules;

    public function toResponse($request)
    {
        if ($request->user())
        {
            $token = $request->user()->createToken($request->login)->plainTextToken;

            return $this->sendResponse(
                [
                    'token' => $token
                ],
                'Успешный вход'
            );
        }
        return $this->sendError(
            null,
            'Произошло что-то страшное и непонятное'
        );
    }
}
