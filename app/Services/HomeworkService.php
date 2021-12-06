<?php

namespace App\Services;

use App\Models\Homeworks\Homework;
use Illuminate\Support\Facades\DB;

class HomeworkService
{
    public function all()
    {
        return Homework::all();
    }

    public function get($id)
    {
        return Homework::findOrFail($id);
    }

    public function create($request) : Homework
    {
        $data = $request->validated();
        try {
            $result = DB::transaction(function () use ($data) {
                return Homework::create($data);
            });
        } catch (\Exception $e) {
            report($e);
            abort(response()->json(['error' => $e->getMessage()], 500));
        }
        return $result;
    }

    public function update($request, $id) : Homework
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

    public function destroy($id) : Homework
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
