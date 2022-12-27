<?php

namespace App\Helpers;

use Image;

class Fileupload {

    static function singleUploadFile($uploadedFile, $profileId, $folderName) {

        // $file_size = $uploadedFile->getSize();
        // dd($uploadedFile->getRealPath());
        $file_ext = $uploadedFile->getClientOriginalExtension();

        $file_name = $profileId.".".$file_ext;

        if(request()->getHttpHost() == '127.0.0.1:8000') {
            $path = public_path($folderName); // '/profile_images/'
        }else {
            $path = storage_path($folderName); // '/profile_images/'
        }

        $img = Image::make($uploadedFile->getRealPath());
        $img->resize(300, 300)->save($path.'/'.$file_name);

        // $img->move($path, $file_name);

        $fullpath = $folderName.''.$file_name;

        return $fullpath;

    }

    static function multiUploadFile($photo_array, $countPhoto, $folderName, $name) {

        for ($i=0; $i < $countPhoto; $i++)
        {
            // $photo_size = $photo_array[$i]->getSize();
            $photo_ext = $photo_array[$i]->getClientOriginalExtension();

            $image_name = $name.rand(123456,999999).".".$photo_ext;

            if(request()->getHttpHost() == '127.0.0.1:8000') {
                $path = public_path($folderName); 
            }else {
                $path = storage_path($folderName);
            }

            $photo_array[$i]->move($path, $image_name);

            $fullpath[$i] = $folderName.'/'.$image_name;    		

        }
        
        $fullpath_array = $fullpath;
        return $fullpath_array;

    }


}


