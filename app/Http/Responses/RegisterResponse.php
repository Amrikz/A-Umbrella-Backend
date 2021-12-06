<?php

namespace App\Http\Responses;

use App\Http\Traits\CanSendResponses;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseContract;

class RegisterResponse implements RegisterResponseContract
{
    use CanSendResponses;

    public function toResponse($request)
    {
        return $this->sendResponse(
            null,
            'Заявка оставлена успешно, отправлен код подтверждения'
        );
    }
}
