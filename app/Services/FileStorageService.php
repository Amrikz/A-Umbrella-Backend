<?php
namespace App\Services;

use App\Http\Requests\Ads\StoreAdRequest;
use App\Http\Requests\FileStorage\StoreFileRequest;
use App\Models\Ads\Ad;
use App\Models\Ads\AdStatus;
use App\Models\FileStorage;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class FileStorageService
{
    public function all() : Collection
    {
        return FileStorage::all();
    }

    public function get($id) : FileStorage
    {
        return FileStorage::findOrFail($id);
    }

    public function store(StoreFileRequest $request) : Collection
    {
        $files = $request->file('files');
        foreach ($files as $file)
            try
            {
                $img = Image::make($file);
                $img->resize(150, 150, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });

                $path = storage_path(join(DIRECTORY_SEPARATOR, ['app', 'public', 'files', $file->hashName()]));
                $img->save($path);

                $rel_path = join('/', ['/storage', 'files', $file->hashName()]);
                $res_files[] = DB::transaction(function() use ($file, $rel_path, $request)
                {
                    $filename = $file->getClientOriginalName();
                    $file = new FileStorage();
                    $file->name = $filename;
                    $file->src = $rel_path;
                    $file->owner_id = $request->user()->id;
                    $file->save();

                    return $file;
                });
            }
            catch (\Exception $e)
            {
                report($e);
                unlink($path);
                abort(response()->json(['error' => $e->getMessage()], 500));
            }
        return collect($res_files);
    }

    public function destroy($id) : FileStorage
    {
        $file = $this->get($id);
        try
        {
            DB::transaction(function() use ($file)
            {
                unlink(public_path($file->src));
                $file->delete();
            });
        }
        catch (\Exception $e)
        {
            report($e);
            abort(response()->json(['error' => $e->getMessage()], 500));
        }
        return $file;
    }
}
