<?php

namespace App\Http\Controllers\Homeworks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Homeworks\StoreSolutionFileRequest;
use App\Http\Requests\Homeworks\UpdateSolutionFileRequest;
use App\Http\Resources\Homeworks\SolutionFileResource;
use App\Services\SolutionFileService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SolutionFileController extends Controller
{
    public function __construct(SolutionFileService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $objs = $this->service->all();
        return $this->sendResponse(
            SolutionFileResource::collection($objs),
            'Objects success returned!'
        );
    }

    public function show($id)
    {
        $obj = $this->service->get($id);
        return $this->sendResponse(
            new SolutionFileResource($obj),
            'Object success returned!'
        );
    }

    public function store(StoreSolutionFileRequest $request)
    {
        $ad = $this->service->create($request);
        return $this->sendResponse(
            new SolutionFileResource($ad),
            'Object success created!',
            ResponseAlias::HTTP_CREATED
        );
    }

    public function update(UpdateSolutionFileRequest $request, $id)
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
            new SolutionFileResource($ad),
            'Object success deleted!'
        );
    }
}
