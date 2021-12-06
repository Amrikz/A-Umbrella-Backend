<?php

namespace App\Services;

use App\Models\Lesson;
use Illuminate\Support\Facades\DB;

class LessonService
{
    public function all()
    {
        return Lesson::all();
    }

    public function get($id)
    {
        return Lesson::findOrFail($id);
    }

    public function create($request) : Lesson
    {
        $data = $request->validated();
        try {
            $result = DB::transaction(function () use ($data) {
                return Lesson::create($data);
            });
        } catch (\Exception $e) {
            report($e);
            abort(response()->json(['error' => $e->getMessage()], 500));
        }
        return $result;
    }

    public function update($request, $id) : Lesson
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

    public function destroy($id) : Lesson
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
