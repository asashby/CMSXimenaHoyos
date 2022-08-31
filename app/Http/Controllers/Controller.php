<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function destroyFile($pathFile)
    {
        if (File::exists(public_path($pathFile))) {
            File::delete(public_path($pathFile));
        }
    }

    public function loadFile(Request $request, $key, $path_image, $disk)
    {
        $path_complete = null;
        if ($request->file($key)) {
            if (!file_exists(public_path() . '/' . $path_image)) {
                if (File::makeDirectory(public_path() . '/' . $path_image, 0777, true)) {
                    $folder_base = $string = Str::of($path_image)->dirname(1);
                    chmod(public_path() . '/' . $folder_base, 0777);
                    chmod(public_path() . '/' . $path_image, 0777);
                }
            }
            $file = $request->file($key);
            $name = "file-" . rand(111, 99999) . '.' . $file->getClientOriginalExtension();
            //$r2 = Storage::disk($disk)->put(utf8_decode($name), \File::get($file));
            //$path_complete = env('URL_BASE') . $path_image . '/' . $name;
            //return $path_complete;
            $file->move(public_path($path_image), $name);
            $path_complete = env('URL_DOMAIN') . '/' . $path_image . '/' . $name;
            chmod(public_path() . '/' . $path_image . '/' . $name, 0777);
            return $path_complete;
        }
        return $path_complete;
    }
}
