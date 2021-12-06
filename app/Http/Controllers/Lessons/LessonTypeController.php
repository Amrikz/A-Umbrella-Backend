<?php

namespace App\Http\Controllers\Lessons;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lessons\StoreLessonTypeRequest;
use App\Http\Requests\Lessons\UpdateLessonTypeRequest;
use App\Http\Resources\Lessons\LessonTypeResource;
use App\Services\LessonTypeService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LessonTypeController extends Controller
{
    public function __construct(LessonTypeService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $objs = $this->service->all();
        return $this->sendResponse(
            LessonTypeResource::collection($objs),
            'Objects success returned!'
        );
    }

    public function show($id)
    {
        $obj = $this->service->get($id);
        return $this->sendResponse(
            new LessonTypeResource($obj),
            'Object success returned!'
        );
    }

    public function store(StoreLessonTypeRequest $request)
    {
        $ad = $this->service->create($request);
        return $this->sendResponse(
            new LessonTypeResource($ad),
            'Object success created!',
            ResponseAlias::HTTP_CREATED
        );
    }

    public function update(UpdateLessonTypeRequest $request, $id)
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
            new LessonTypeResource($ad),
            'Object success deleted!'
        );
    }
}
