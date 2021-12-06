<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Resources\Users\UserProfileResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class UserController extends Controller
{
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function show($id = null)
    {
        if ($id === null) $id = Auth::id();
        $obj = $this->service->get($id);
        return $this->sendResponse(
            new UserProfileResource($obj),
            'Object success returned!'
        );
    }

    public function store(StoreUserRequest $request)
    {
        $obj = $this->service->create($request);
        return $this->sendResponse(
            new UserProfileResource($obj),
            'Object success created!',
            ResponseAlias::HTTP_CREATED
        );
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $result = $this->service->update($request, $id);
        if (!$result)
            return $this->sendError(
                null,
                'Unknown update error',
                ResponseAlias::HTTP_UNPROCESSABLE_ENTITY
            );

        return $this->show($id);
    }

    public function destroy($id)
    {
        $obj = $this->service->destroy($id);
        return $this->sendResponse(
            new UserProfileResource($obj),
            'Object success deleted!'
        );
    }
}
