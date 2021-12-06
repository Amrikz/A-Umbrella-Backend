<?php

namespace App\Http\Controllers\FileStorage;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileStorage\StoreFileRequest;
use App\Http\Resources\FileStorage\FileResource;
use App\Services\FileStorageService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FileStorageController extends Controller
{
    public function __construct(FileStorageService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        if (Auth::user()->role->slug != 'admin')
            abort(404);

        $files = $this->service->all();
        return $this->sendResponse(
            FileResource::collection($files),
            'Files success returned!'
        );
    }

    public function show($id)
    {
        $file = $this->service->get($id);
        return $this->sendResponse(
            new FileResource($file),
            'File success returned!'
        );
    }

    public function store(StoreFileRequest $request)
    {
        $files = $this->service->store($request);
        return $this->sendResponse(
            FileResource::collection($files),
            'Files success uploaded!',
            Response::HTTP_CREATED
        );
    }

    public function destroy($id)
    {
        $file = $this->service->destroy($id);
        return $this->sendResponse(
            new FileResource($file),
            'File success deleted!'
        );
    }
}
