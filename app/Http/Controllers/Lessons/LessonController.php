<?php

namespace App\Http\Controllers\Lessons;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lessons\StoreLessonRequest;
use App\Http\Requests\Lessons\UpdateLessonRequest;
use App\Http\Resources\Lessons\LessonResource;
use App\Services\LessonService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class LessonController extends Controller
{
    public function __construct(LessonService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $objs = $this->service->all();
        return $this->sendResponse(
            LessonResource::collection($objs),
            'Objects success returned!'
        );
    }

    public function show($id)
    {
        $obj = $this->service->get($id);
        return $this->sendResponse(
            new LessonResource($obj),
            'Object success returned!'
        );
    }

    public function store(StoreLessonRequest $request)
    {
        $ad = $this->service->create($request);
        return $this->sendResponse(
            new LessonResource($ad),
            'Object success created!',
            ResponseAlias::HTTP_CREATED
        );
    }

    public function update(UpdateLessonRequest $request, $id)
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
            new LessonResource($ad),
            'Object success deleted!'
        );
    }
}
