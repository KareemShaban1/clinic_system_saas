<?php

namespace App\Http\Traits;

trait UploadImageTrait
{
    // custom function to upload images
    protected function uploadImage($request, $fileName, $storeFolderName, $disk)
    {
        // check if input of type 'file' with name 'image' is exist or not
        if(!$request->hasFile($fileName)) {
            return;
        }
        $file = $request->file($fileName); // UploadedFile Object
        // $file->store('folder_name','disk_name'[default=>'local'] );
        $path = $file->store($storeFolderName, [
            'disk'=>$disk
        ]);
        return  $path;

    }



}
