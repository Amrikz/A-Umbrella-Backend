<?php

namespace App\Services;

use App\Models\LessonType;
use Illuminate\Support\Facades\DB;

class LessonTypeService
{
    public function all()
    {
        return LessonType::all();
    }

    public function get($id)
    {
        return LessonType::findOrFail($id);
    }

    public function create($request) : LessonType
    {
        $data = $request->validated();
        try {
            $result = DB::transaction(function () use ($data) {
                return LessonType::create($data);
            });
        } catch (\Exception $e) {
            report($e);
            abort(response()->json(['error' => $e->getMessage()], 500));
        }
        return $result;
    }

    public function update($request, $id) : LessonType
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

    public function destroy($id) : LessonType
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
