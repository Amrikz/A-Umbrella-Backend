<?php

namespace App\Http\Controllers\WeekDays;

use App\Http\Controllers\Controller;
use App\Http\Requests\WeekDay\StoreWeekDayRequest;
use App\Http\Requests\WeekDay\UpdateWeekDayRequest;
use App\Http\Resources\WeekDay\WeekDayResource;
use App\Services\WeekDayService;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class WeekDayController extends Controller
{
    public function __construct(WeekDayService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $objs = $this->service->all();
        return $this->sendResponse(
            WeekDayResource::collection($objs),
            'Objects success returned!'
        );
    }

    public function show($id)
    {
        $obj = $this->service->get($id);
        return $this->sendResponse(
            new WeekDayResource($obj),
            'Object success returned!'
        );
    }

    public function store(StoreWeekDayRequest $request)
    {
        $ad = $this->service->create($request);
        return $this->sendResponse(
            new WeekDayResource($ad),
            'Object success created!',
            ResponseAlias::HTTP_CREATED
        );
    }

    public function update(UpdateWeekDayRequest $request, $id)
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
            new WeekDayResource($ad),
            'Object success deleted!'
        );
    }
}
