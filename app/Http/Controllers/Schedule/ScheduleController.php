<?php

namespace App\Http\Controllers\Schedule;

use App\Http\Controllers\Controller;
use App\Http\Requests\Schedule\StoreScheduleRequest;
use App\Http\Requests\Schedule\UpdateScheduleRequest;
use App\Http\Resources\Schedule\ScheduleResource;
use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class ScheduleController extends Controller
{
    public function __construct(ScheduleService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $objs = $this->service->all();
        return $this->sendResponse(
            ScheduleResource::collection($objs),
            'Objects success returned!'
        );
    }

    public function show($id)
    {
        $obj = $this->service->get($id);
        return $this->sendResponse(
            new ScheduleResource($obj),
            'Object success returned!'
        );
    }

    public function store(StoreScheduleRequest $request)
    {
        $ad = $this->service->create($request);
        return $this->sendResponse(
            new ScheduleResource($ad),
            'Object success created!',
            ResponseAlias::HTTP_CREATED
        );
    }

    public function update(UpdateScheduleRequest $request, $id)
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
        $ad = $this->service->destroy($id);
        return $this->sendResponse(
            new ScheduleResource($ad),
            'Object success deleted!'
        );
    }
}
