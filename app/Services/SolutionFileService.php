<?php

namespace App\Services;

use App\Models\Homeworks\SolutionFile;
use Illuminate\Support\Facades\DB;

class SolutionFileService
{
    public function all()
    {
        return SolutionFile::all();
    }

    public function get($id)
    {
        return SolutionFile::findOrFail($id);
    }

    public function create($request) : SolutionFile
    {
        $data = $request->validated();
        try {
            $result = DB::transaction(function () use ($data, $request) {
                return SolutionFile::create($data);
            });
        } catch (\Exception $e) {
            report($e);
            abort(response()->json(['error' => $e->getMessage()], 500));
        }
        return $result;
    }

    public function update($request, $id) : SolutionFile
    {
        $data = $request->validated();
        $result = DB::transaction(function() use ($data, $id)
        {
            $obj = $this->get($id);
            $obj->update($data);

            return $obj;
        });

        return $result;
    }

    public function destroy($id) : SolutionFile
    {
        $obj = $this->get($id);
        try
        {
            DB::transaction(function() use ($obj)
            {
                $obj->delete();
            });
        }
        catch (\Exception $e)
        {
            report($e);
            abort(response()->json(['error' => $e->getMessage()], 500));
        }
        return $obj;
    }
}
