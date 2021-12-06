<?php

namespace App\Services;

use App\Models\Homeworks\Solution;
use Illuminate\Support\Facades\DB;

class SolutionService
{
    public function all()
    {
        return Solution::all();
    }

    public function get($id)
    {
        return Solution::findOrFail($id);
    }

    public function create($request) : Solution
    {
        $data = $request->validated();
        try {
            $result = DB::transaction(function () use ($data, $request) {
                $data['owner_id'] = $request->user()->id;
                return Solution::create($data);
            });
        } catch (\Exception $e) {
            report($e);
            abort(response()->json(['error' => $e->getMessage()], 500));
        }
        return $result;
    }

    public function update($request, $id) : Solution
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

    public function destroy($id) : Solution
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
