<?php

namespace App\Helpers;

class Fileupload {

    static function singleUploadFile($uploadedFile, $profileId, $folderName) {

        // $file_size = $uploadedFile->getSize();
        
        $file_ext = $uploadedFile->getClientOriginalExtension();

        $file_name = $profileId.".".$file_ext;

        if(request()->getHttpHost() == '127.0.0.1:8000') {
            $path = public_path($folderName); // '/profile_images/'
        }else {
            $path = storage_path($folderName); // '/profile_images/'
        }

        $uploadedFile->move($path, $file_name);

        $fullpath = $folderName.''.$file_name;

        return $fullpath;

    }

    function multiUploadFile($photo_array, $countPhoto) {

        for ($i=0; $i < $countPhoto; $i++)
        { 
            // $addslotpic = new Media_file();

            $photo_size = $photo_array[$i]->getSize();
            $photo_ext = $photo_array[$i]->getClientOriginalExtension();

            $image_name = rand(123456,999999).".".$photo_ext;

            $path = storage_path('/slot_images/');

            $photo_array[$i]->move($path, $image_name);

            $fullpath = 'slot_images/'.$image_name;

            // $addslotpic->image_slug = $fullpath;
            // $addslotpic->name = $image_name;
            // $addslotpic->size = $photo_size;
            // $addslotpic->parkingslot_id = $addslot->id;

            // $saveimage = $addslotpic->save();	    		

        }
        // if ($saveimage) 
        // {
        //     $getimageurl = Media_file::where('parkingslot_id', '=', $addslot->id)->value('image_slug');
        //     Parkingslot::where('id','=',$addslot->id)->update([ 'thumbnail' => $getimageurl ]);
        //     return redirect()->route('all.slots')->with('success_msg','Parking Slot has been added successfully!');
        // }

    }


}


