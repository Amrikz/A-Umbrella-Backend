<?php

namespace App\Services;

use App\Models\WeekDay;
use Illuminate\Support\Facades\DB;

class WeekDayService
{
    public function all()
    {
        return WeekDay::all();
    }

    public function get($id)
    {
        return WeekDay::findOrFail($id);
    }

    public function create($request) : WeekDay
    {
        $data = $request->validated();
        try {
            $result = DB::transaction(function () use ($data) {
                return WeekDay::create($data);
            });
        } catch (\Exception $e) {
            report($e);
            abort(response()->json(['error' => $e->getMessage()], 500));
        }
        return $result;
    }

    public function update($request, $id) : WeekDay
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

    public function destroy($id) : WeekDay
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
