<?php

namespace App\Services;

use App\Models\Schedule;
use Illuminate\Support\Facades\DB;

class ScheduleService
{
    public function all()
    {
        return Schedule::all();
    }

    public function get($id)
    {
        return Schedule::findOrFail($id);
    }

    public function create($request) : Schedule
    {
        $data = $request->validated();
        try {
            $result = DB::transaction(function () use ($data) {
                return Schedule::create($data);
            });
        } catch (\Exception $e) {
            report($e);
            abort(response()->json(['error' => $e->getMessage()], 500));
        }
        return $result;
    }

    public function update($request, $id) : Schedule
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

    public function destroy($id) : Schedule
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
