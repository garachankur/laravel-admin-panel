<?php

namespace App\Helpers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Storage;
use Image;

class ProjectHelper
{

    public static function uploadImageWithThumb($file, $image, $image_thumb, $id = "", $type = "add", $resultImg = null, $isGalleryImage = false)
    {
        if ($id != "") {
            $directoryPath = $image . $id;
        } else {
            $directoryPath = $image;
            if (substr($directoryPath, -1) == "/") {
                $directoryPath = substr($directoryPath, 0, -1);
            }
        }

        if ($type == "update" && !empty($resultImg)) {
            $thumb_img_name = $directoryPath . '/' . $image_thumb;
            if (Storage::exists($directoryPath . '/' . $resultImg)) {
                Storage::delete($directoryPath . '/' . $resultImg);
            }
            if (Storage::exists($thumb_img_name . $resultImg)) {
                Storage::delete($thumb_img_name . $resultImg);
            }
        }

        if (strtolower($file->extension()) == "svg") {
            $path = Storage::put($directoryPath, $file);
            $path = explode("/", $path);
            $thumb_img_name = $directoryPath . '/' . $image_thumb;
            Storage::put($thumb_img_name, $file);
        } else {
            $path = $file->store($directoryPath);

            $thumbWidth = config('laraveladminpanel.image.thumb_width');
            $thumbHeight = config('laraveladminpanel.image.thumb_height');

            $thumb_image = Image::make(Storage::get($path))->resize($thumbWidth, $thumbHeight, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })
                ->orientate()
                ->encode();

            $path = explode("/", $path);
            $thumb_img_name = $directoryPath . '/' . $image_thumb . last($path);

            Storage::put($thumb_img_name, $thumb_image);
        }

        return last($path);
    }
}
