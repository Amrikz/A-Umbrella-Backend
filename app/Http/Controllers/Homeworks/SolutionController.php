<?php

namespace App\Http\Controllers\Homeworks;

use App\Http\Controllers\Controller;
use App\Http\Requests\Homeworks\StoreSolutionRequest;
use App\Http\Requests\Homeworks\UpdateSolutionRequest;
use App\Http\Resources\Homeworks\SolutionResource;
use App\Services\SolutionService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SolutionController extends Controller
{
    public function __construct(SolutionService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $objs = $this->service->all();
        return $this->sendResponse(
            SolutionResource::collection($objs),
            'Objects success returned!'
        );
    }

    public function show($id)
    {
        $obj = $this->service->get($id);
        return $this->sendResponse(
            new SolutionResource($obj),
            'Object success returned!'
        );
    }

    public function store(StoreSolutionRequest $request)
    {
        $ad = $this->service->create($request);
        return $this->sendResponse(
            new SolutionResource($ad),
            'Object success created!',
            ResponseAlias::HTTP_CREATED
        );
    }

    public function update(UpdateSolutionRequest $request, $id)
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
            new SolutionResource($ad),
            'Object success deleted!'
        );
    }
}
