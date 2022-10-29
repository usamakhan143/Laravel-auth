<?php

namespace App\Http\Controllers\backend\Auth;

use App\Helpers\Fileupload;
use App\Http\Controllers\Controller;
use App\Models\backend\Account;
use App\Models\backend\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:account');
    }


    public function getProfile($id) {

        if(Auth::user()->can('profile.view')) {
            $profile_Id = Profile::where('account_id','=', $id)->value('id');
            $get_Profile = Profile::find($profile_Id);
            return view('backend.auth.users.profile', compact('get_Profile'));
        }
        else {
            return redirect()->route('dashboard.home');
        }
    }

    public function updateMyProfile($id, Request $request) {

        if(Auth::user()->can('profile.view')) {

            $this->validate($request, [

                'profileImage' => ['mimes:webp','dimensions:max_width=500,max_height=500,min_width=500,min_height=500']

            ]);

            $profile_Id = Profile::where('account_id','=', $id)->value('id');
            $get_Profile = Profile::find($profile_Id);

            $profileImage = $request->file('profileImage');

            if($get_Profile->status == 0) {

                $get_Profile->identityNumber = $request->nic;
                $get_Profile->gender = $request->gender;
                $get_Profile->status = 1;

                $update_myProfile = $get_Profile->update();

                if($update_myProfile) {

                    if ($request->hasFile('profileImage'))
                    {
                        $addFile = Account::find($id);
                        $directory = '/profile_images/';
                        $getImageUrl = Fileupload::singleUploadFile($profileImage, $profile_Id, $directory);
                        $addFile->image = $getImageUrl;
                        $saveImage = $addFile->update();
                        if($saveImage) {
                            return back()->with('success_msg', 'Profile has been updated');
                        }
                    }

                    return back()->with('success_msg', 'Profile has been updated without profile picture');

                }

            }

            if ($request->hasFile('profileImage'))
            {
                $addFile = Account::find($id);
                $directory = '/profile_images/';
                $getImageUrl = Fileupload::singleUploadFile($profileImage, $profile_Id, $directory);
                $addFile->image = $getImageUrl;
                $saveImage = $addFile->update();
                if($saveImage) {
                    return back()->with('success_msg', 'Profile picture has been updated');
                }
            }

        }

    }
}
