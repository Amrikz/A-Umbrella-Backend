<?php

namespace App\Http\Controllers\Homeworks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Homeworks\StoreHomeworkRequest;
use App\Http\Requests\Homeworks\UpdateHomeworkRequest;
use App\Http\Resources\Homeworks\HomeworkResource;
use App\Services\HomeworkService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class HomeworkController extends Controller
{
    public function __construct(HomeworkService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $objs = $this->service->all();
        return $this->sendResponse(
            HomeworkResource::collection($objs),
            'Objects success returned!'
        );
    }

    public function show($id)
    {
        $obj = $this->service->get($id);
        return $this->sendResponse(
            new HomeworkResource($obj),
            'Object success returned!'
        );
    }

    public function store(StoreHomeworkRequest $request)
    {
        $ad = $this->service->create($request);
        return $this->sendResponse(
            new HomeworkResource($ad),
            'Object success created!',
            ResponseAlias::HTTP_CREATED
        );
    }

    public function update(UpdateHomeworkRequest $request, $id)
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
            new HomeworkResource($ad),
            'Object success deleted!'
        );
    }
}
