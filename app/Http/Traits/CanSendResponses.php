<?php

namespace App\Http\Traits;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

trait CanSendResponses
{
    private function _apiResponse($data, $additional, $status)
    {
        if (is_subclass_of($data,JsonResource::class))
            return $data->additional($additional)->response()->setStatusCode($status);

        $additional['data'] = $data;
        return response()->json($additional, $status);
    }


    public function sendResponse($data, $message = null, $status = Response::HTTP_OK)
    {
        $additional = [
            'success' => true,
            'message' => $message,
        ];
        return $this->_apiResponse($data, $additional, $status);
    }


    public function sendError($data, $message = null, $status = Response::HTTP_BAD_REQUEST)
    {
        $additional = [
            'success' => false,
            'message' => $message,
        ];
        return $this->_apiResponse($data, $additional, $status);
    }
}
