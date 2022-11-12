<?php

namespace App\Http\Controllers\backend\Auth;

use App\Helpers\Fileupload;
use App\Http\Controllers\Controller;
use App\Models\backend\Account;
use App\Models\backend\Profile;
use App\Models\Cnetwork;
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

            if($request->nic) {
                $this->validate($request, [

                    'nic' => ['required'],
                    'profileImage' => ['mimes:webp','dimensions:max_width=500,max_height=500,min_width=500,min_height=500'],
                    'gender' => ['required']

                ]);
            }
            else{
                $this->validate($request, [

                    'profileImage' => ['mimes:webp','dimensions:max_width=500,max_height=500,min_width=500,min_height=500']

                ]);
            }
            $profile_Id = Profile::where('account_id','=', $id)->value('id');
            $get_Profile = Profile::find($profile_Id);

            $profileImage = $request->file('profileImage');

            if($get_Profile->status == 0) {

                $get_Profile->identityNumber = $request->nic;
                $get_Profile->gender = $request->gender;
                $get_Profile->status = 1;

                $update_myProfile = $get_Profile->update();

                if($update_myProfile) {

                    $network_set = new Cnetwork();
                    $network_set->name = 'Default';
                    $network_set->ip = request()->ip();
                    $network_set->mac = exec('getmac') ?? 'NaN';
                    $network_set->account_id = Auth::guard('account')->user()->id;
                    $network_set->status = 1;
                    $network_set->save();

                    if ($profileImage)
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

            if ($profileImage)
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

    // Account Details
    public function showAccount($id) {
        $getAccount = Account::find($id);
        dd($getAccount);
        return view('backend.auth.users.show');
    }
}
