<?php

namespace App\Http\Controllers\backend\Auth;

use App\Helpers\Fileupload;
use App\Http\Controllers\Controller;
use App\Models\attendance\Attendance;
use App\Models\backend\Account;
use App\Models\backend\Cnic;
use App\Models\backend\Profile;
use App\Models\Cnetwork;
use Carbon\Carbon;
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


    public function getProfile($id)
    {

        if (Auth::user()->can('profile.view')) {
            $profile_Id = Profile::where('account_id', '=', $id)->value('id');
            $get_Profile = Profile::find($profile_Id);
            return view('backend.auth.users.profile', compact('get_Profile'));
        } else {
            return redirect()->route('dashboard.home');
        }
    }

    public function updateMyProfile($id, Request $request)
    {

        if (Auth::user()->can('profile.view')) {

            if (Auth::guard('account')->user()->profile->status < 1) {
                $this->validate($request, [

                    'nic' => ['required'],
                    'id-picture' => ['required'],
                    'profileImage' => ['mimes:png,webp,jpg,jpeg'],
                    'gender' => ['required']

                ]);
            } else {
                $this->validate($request, [

                    'profileImage' => ['required', 'mimes:png,webp,jpg,jpeg'],

                ]);
            }

            $profile_Id = Profile::where('account_id', '=', $id)->value('id');
            $get_Profile = Profile::find($profile_Id);

            $profileImage = $request->file('profileImage');

            if ($get_Profile->status == 0) {

                $id_card = $request->file('id-picture');

                $count_id_photo = count($id_card);
                $fold = 'identity';
                $name = 'NIC';


                if ($count_id_photo == 2) {
                    $user = Cnic::where('account_id', '=', $id)->first();
                    if ($user == null) {
                        $cnic_files = Fileupload::multiUploadFile($id_card, $count_id_photo, $fold, $name);
                        $addCnic = new Cnic();
                        $addCnic->pic_1 = $cnic_files[0];
                        $addCnic->pic_2 = $cnic_files[1];
                        $addCnic->account_id = $id;
                        $addCnic->status = 1;

                        $addCnic->save();
                    } else {
                        $cnic_files = Fileupload::multiUploadFile($id_card, $count_id_photo, $fold, $name);
                        $cnic_find = Cnic::where('account_id', '=', $id)->value('id');
                        $find_cnic = Cnic::find($cnic_find);

                        $path = $find_cnic->pic_1;
                        // dd(storage_path($path));
                        unlink(storage_path($path));
                        $path2 = $find_cnic->pic_2;
                        unlink(storage_path($path2));

                        $find_cnic->pic_1 = $cnic_files[0];
                        $find_cnic->pic_2 = $cnic_files[1];
                        $find_cnic->account_id = $id;
                        $find_cnic->status = 1;

                        $find_cnic->save();
                    }
                } else {
                    return back()->with('primary_msg', 'CNIC Back & Front should not be more than 2');
                }

                $get_Profile->identityNumber = $request->nic;
                $get_Profile->gender = $request->gender;
                $get_Profile->status = 0;

                $update_myProfile = $get_Profile->update();

                if ($update_myProfile) {

                    $network_set = new Cnetwork();
                    $network_set->name = 'Default';
                    $network_set->ip = request()->ip();
                    $network_set->mac = exec('getmac') ?? 'NaN';
                    $network_set->account_id = Auth::guard('account')->user()->id;
                    $network_set->status = 1;
                    $network_set->save();

                    if ($profileImage) {
                        $addFile = Account::find($id);
                        $directory = '/profile_images/';
                        $getImageUrl = Fileupload::singleUploadFile($profileImage, $profile_Id, $directory);
                        $addFile->image = $getImageUrl;
                        $saveImage = $addFile->update();
                        if ($saveImage) {
                            return back()->with('success_msg', 'Profile has been updated');
                        }
                    }

                    return back()->with('success_msg', 'Profile has been updated without profile picture');
                }
            }

            if ($profileImage) {
                $addFile = Account::find($id);
                $directory = 'profile_images/';
                $getImageUrl = Fileupload::singleUploadFile($profileImage, $profile_Id, $directory);
                $addFile->image = $getImageUrl;
                $saveImage = $addFile->update();
                if ($saveImage) {
                    return back()->with('success_msg', 'Profile picture has been updated');
                }
            }
        }
    }

    // Account Details
    public function showAccount($id)
    {
        if (Auth::user()->can('reports.singlepageuserattend')) {
            $getAccount = Account::find($id);
            $getAttendance = Attendance::where([
                ['account_id', $id],
                ['month', date('m')],
                ['year', date('Y')]
            ])->orderBy('created_at', 'desc')->get([
                'startTime',
                'endTime',
                'isLate',
                'isHalfday',
                'workingHours',
                'isOvertime',
                'over_time',
                'atOffice',
                'day'
            ]);


            $get_Atte = [];

            return view('backend.auth.users.show', compact('getAccount', 'getAttendance', 'get_Atte'));
        } else {
            return redirect()->route('dashboard.home');
        }
    }

    // Check Account Attendance
    public function getAccountAttendance($id, Request $request)
    {
        if (Auth::user()->can('reports.singlepageuserattend')) {
            // FROM
            $from_day = Carbon::parse($request->from_date)->format('d');
            $from_month = Carbon::parse($request->from_date)->format('m');
            $from_year = Carbon::parse($request->from_date)->format('Y');
            // TO
            $to_day = Carbon::parse($request->to_date)->format('d');
            $to_month = Carbon::parse($request->to_date)->format('m');
            $to_year = Carbon::parse($request->to_date)->format('Y');

            $getAccount = Account::find($id);
            $getAttendance = Attendance::where([
                ['account_id', $id],
                ['month', date('m')],
                ['year', date('Y')]
            ])->orderBy('created_at', 'desc')->get([
                'startTime',
                'endTime',
                'isLate',
                'isHalfday',
                'workingHours',
                'isOvertime',
                'over_time',
                'atOffice',
                'day'
            ]);

            $get_Atte = Attendance::where('account_id', $id)->where([
                ['day', '>=', $from_day],
                ['month', '>=', $from_month],
                ['year', '>=', $from_year]
            ])->where([
                ['day', '<=', $to_day],
                ['month', '<=', $to_month],
                ['year', '<=', $to_year]
            ])->orderBy('created_at', 'desc')->get();

            return view('backend.auth.users.show', compact('getAccount', 'getAttendance', 'get_Atte'));
        } else {
            return redirect()->route('dashboard.home');
        }
    }


    // Get Pending Profiles
    public function pendingProf()
    {
        if(Auth::user()->can('pending.profiles')){
            $all_profiles = Profile::where('status', 0)->get();
            $all_cnic = Cnic::where('status', 0)->get();
            return view('backend.auth.profiles.pending', compact('all_profiles', 'all_cnic'));
        }
        else {
            return redirect()->route('dashboard.home');
        }
    }
    // Activating Profiles
    public function activateProf($id)
    {
        if (Auth::user()->can('profile.activate')) {
            $profile = Profile::find($id);
            $profile->status = 1;
            $update = $profile->save();
            if ($update) {
                return back()->with('success_msg', 'Profile has been Activated Successfully');
            } else {
                return view('backend.auth.profiles.pending');
            }
        } else {
            return redirect()->route('dashboard.home');
        }
    }

    // Request user to reupload the Identity card
    public function requestReupload($id) {
        $find_idcard = Cnic::find($id);
        $find_idcard->status = 0;
        $find_idcard->save();
        return back()->with('warning_msg', 'Request has been sended successfully to the user');
    }
}
