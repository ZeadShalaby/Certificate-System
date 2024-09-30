<?php

namespace App\Traits;

use App\Models\Role;


trait ImageTrait
{   // save image 
    public function saveimage($image, $folder, $path)
    {
        $image_name = time() . '.' . $image->extension();
        $destination_path = "/api/rev/images/$folder/$path/";
        $path = $destination_path . $image_name;

        return $path;
    }

    // todo return image users I Want it
    public function returnimageusers($value)
    {
        return response()->download(public_path('images/users/' . $value));
    }


    // todo add new media 
    protected function Addmedia($info, $media)
    {
        $info->media()->create([
            'media' => $media
        ]);
    }


    // todo save pdf
    public function sendFile($file, $folder)
    {
        $folderPath = public_path($folder);
        //? Ensure the folder exists
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true);
        }
        $fileName = time() . '.' . $file->extension();
        try {
            $file->move($folderPath, $fileName);
            $url = 'api/imageschatgpt/' . $folder . '/' . $fileName;
            $path = $folder . '/' . $fileName;
            return [$path, $url];
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }

    }




}





