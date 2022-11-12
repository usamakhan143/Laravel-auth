<?php

namespace App\Http\Controllers\backend\attendance;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Models\attendance\Attendance;
use App\Models\backend\Account;
use App\Models\Cnetwork;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
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
    


    public function markAttendance() {
        
        // $get_working_Minutes = $mins;
        // $whrsM = 480;
        // $check_Late = 1;

        // // Check the candidate late and overtime status
        
        // if($check_Late > 0)
        // {
        //     if ($get_working_Minutes >= $whrsM && $get_working_Minutes < $whrsM + 31) {
        //         $is_late = 0;
        //         $is_overtime = 0;
        //         $condition = 'if';
        //         // Candidate working mins should be greater than or equal to shift hours and also Candidate working mins less than overtime (started after 30mins of shift ended).
        //     } elseif($get_working_Minutes > $whrsM + 30) {
        //         $is_overtime = 1;
        //         $is_late = 0;
        //         $over_time = $get_working_Minutes - $whrsM;
        //         $condition = 'elseif';
        //         // Candidate working mins should be greater than overtime (started after 30mins of shift ended)
        //     } else {
        //         $is_late = 1;
        //         $isHalfday = 1;
        //         $is_overtime = 0;
        //         $condition = 'else';
        //         // Candidate working mins should be less than shift hours
        //     }
        // }
        // else {
        //     if ($get_working_Minutes >= $whrsM && $get_working_Minutes < $whrsM + 31) {
        //         $isHalfday = 0;
        //         $is_overtime = 0;
        //         $condition = 'if of else';
        //         // Candidate working mins should be greater than or equal to shift hours and also Candidate working mins less than overtime (started after 30mins of shift ended).
        //     } elseif($get_working_Minutes > $whrsM + 30) {
        //         $is_overtime = 1;
        //         $isHalfday = 0;
        //         $over_time = $get_working_Minutes - $whrsM;
        //         $condition = 'elseif of else';
        //         // Candidate working mins should be greater than overtime (started after 30mins of shift ended)
        //     }
        //     else {
        //         $isHalfday = 1;
        //         $is_overtime = 0;
        //         $condition = 'else of else';
        //         // Candidate working mins should be less than shift hours
        //     }
        // }


        // $arry = [
        //     'isLate' => $is_late ?? 0,
        //     'isOvertime' => $is_overtime,
        //     'overtime' => $over_time ?? 0,
        //     'isHalfday' => $isHalfday ?? 0,
        //     'condition' => $condition
        // ];

        // dd($arry);
        
    
        $getCurrentIP = Helper::getCurrentIp();
        
        $currentUser_whosLogin = Auth::guard('account')->user()->id;

        $officeNet = Cnetwork::where([
            ['status', 1],
            ['account_id', $currentUser_whosLogin]
        ])->get()->pluck('ip')->toArray();

        $checkIP = in_array($getCurrentIP, $officeNet);
        $officeStatus = Cnetwork::where('name', 'Office')->value('status');
        
        $check_Is_marked = Attendance::where([
            ['day', date('d')],
            ['month', date('m')],
            ['year', date('Y')],
            ['account_id', $currentUser_whosLogin]
        ])->value('in');

        $get_out_status = Attendance::where([
            ['day', date('d')],
            ['month', date('m')],
            ['year', date('Y')],
            ['out', 1],
            ['account_id', $currentUser_whosLogin]
        ])->value('out');

        // current user attendance
        $get_my_attendance = Attendance::where([
            ['day', date('d')],
            ['month', date('m')],
            ['year', date('Y')],
            ['account_id', $currentUser_whosLogin]
        ])->first();

        // all attendance of current user
        $get_my_all_attendance = Attendance::where([
            ['year', date('Y')],
            ['out', 1],
            ['account_id', $currentUser_whosLogin]
        ])->get();
        
        return view('backend.attendance.mark.attendance', compact('checkIP', 'officeStatus', 'check_Is_marked', 'get_out_status', 'get_my_attendance', 'get_my_all_attendance'));
    }



    // Check IN
    public function checkInStore() {

        $check_in = new Attendance();
        
        // Check Is the candidate is late?
        $user_shift = Account::find(Auth::guard('account')->user()->id)->shifts;
        $user_shift_pusharray = Arr::get($user_shift, 0);
        $current_userShift_start_time = Arr::pull($user_shift_pusharray, 'start_time').':00';
        $current_userShift_extraMin = Carbon::createFromFormat('H:i:s', $current_userShift_start_time)->addMinutes(15)->toTimeString();
        $actual_start_time_ofUser = Carbon::createFromFormat('H:i:s', date('H:i:s'))->addMinutes(0)->toTimeString();

        ($current_userShift_extraMin < $actual_start_time_ofUser) ? $is_late = 1 : $is_late = 0;

        // Check is the candidate is inside office
        $currentNetwork_Address = Helper::getCurrentIp();
        $officeStatus = Cnetwork::where('name', 'Office')->value('status');

        $data = [

            'in' => 1,
            'startTime' => $actual_start_time_ofUser,
            'atOffice' => $officeStatus,
            'day' => date('d'),
            'year' => date('Y'),
            'month' => date('m'),
            'isHalfDay' => 0,
            'isLate' => $is_late,
            'out' => 0,
            'endTime' => 'NaN',
            'workingHours' => 0,
            'isOvertime' => 0,
            'over_time' => 0,
            'account_id' => Auth::guard('account')->user()->id,
            'department_id' => 0,
            'team_id' => 0

        ];

        

        if($officeStatus == 1){

            $officeNet = Cnetwork::where([
                ['status', 1],
                ['account_id', Auth::guard('account')->user()->id]
            ])->get()->pluck('ip')->toArray();
            
            $checkIP = in_array($currentNetwork_Address, $officeNet);

            if($checkIP == true){
                // dd($data);
                $check_in->create($data);
                return redirect()->route('mark.in')->with('success_msg', 'Your attendance has been successfully marked');

            }
            else {
                return back()->with('error_msg', 'Oops! I think you are not currently inside office');
            }

        }
        else {
            dd($data);
            $check_in->create($data);
            return redirect()->route('mark.in')->with('success_msg', 'Your remote attendance has been successfully marked');
        }


    }


    //Check OUT
    public function checkOut() {

        $loggedInUser = Auth::guard('account')->user()->id;


        $get_out_status = Attendance::where([
            ['day', date('d')],
            ['month', date('m')],
            ['year', date('Y')],
            ['out', 1],
            ['account_id', $loggedInUser]
        ])->value('out');

        if($get_out_status < 1)
        {
            
            $who_is = Attendance::where([
                ['day', date('d')],
                ['month', date('m')],
                ['year', date('Y')],
                ['in', 1],
                ['out', 0],
                ['account_id', $loggedInUser]
            ])->value('id');

            $check_out = Attendance::find($who_is);

            // Check Is the candidate is late?
            $user_shift = Account::find($loggedInUser)->shifts->toArray();
            $user_shift_pusharray = Arr::get($user_shift, 0);
            
            // $current_userShift_end_time = Arr::pull($user_shift_pusharray, 'end_time').':00';
            // $current_userShift_extraMin = Carbon::createFromFormat('H:i:s', $current_userShift_end_time)->addMinutes(12)->toTimeString();
            $actual_end_time_ofUser = Carbon::createFromFormat('H:i:s', date('H:i:s'))->addMinutes(0)->toTimeString();
            
            // Get Working Hours from Shift 
            $whrs = Arr::pull($user_shift_pusharray, 'working_hours');
            // Hours into minutes
            $whrsM = $whrs * 60;
            
            // Check the candidate current working hours
            $to = Carbon::createFromFormat('H:i:s', $check_out->startTime);
            $from = Carbon::createFromFormat('H:i:s', $actual_end_time_ofUser);
            $get_working_Minutes = $to->diffInMinutes($from);

            // Check when the candidate is late
            if($check_out->isLate > 0)
            {
                // Candidate working hours should be equal to shift hours or less than shift hours with adding 30mins
                if ($get_working_Minutes >= $whrsM && $get_working_Minutes < $whrsM + 31) {
                    $is_late = 0;
                    $is_overtime = 0;
                }
                // Candidate working hours should be greater than shift hours with adding 30mins
                elseif($get_working_Minutes > $whrsM + 30) {
                    $is_overtime = 1;
                    $is_late = 0;
                    $over_time = $get_working_Minutes - $whrsM;
                }
                // Candidate working hours should be less than shift hours
                else {
                    $is_late = 1;
                    $isHalfday = 1;
                    $is_overtime = 0;
                }
            }
            // check when candidate is on time
            else {
                // Candidate working hours should be equal to shift hours or less than shift hours with adding 30mins
                if ($get_working_Minutes >= $whrsM && $get_working_Minutes < $whrsM + 31) {
                    $isHalfday = 0;
                    $is_overtime = 0;
                }
                // Candidate working hours should be greater than shift hours with adding 30mins
                elseif($get_working_Minutes > $whrsM + 30) {
                    $is_overtime = 1;
                    $over_time = $get_working_Minutes - $whrsM;
                    $isHalfday = 0;
                }
                // Candidate working hours should be less than shift hours
                else {
                    $isHalfday = 1;
                    $is_overtime = 0;
                }
            }

            $data = [
                
                'isHalfDay' => $isHalfday ?? 0,
                'isLate' => $is_late ?? 0,
                'out' => 1,
                'endTime' => $actual_end_time_ofUser,
                'workingHours' => $get_working_Minutes,
                'isOvertime' => $is_overtime,
                'over_time' => $over_time ?? 0,
                'account_id' => $loggedInUser,
                'department_id' => 0,
                'team_id' => 0

            ];

            // dd($data);
            $currentNetwork_Address = Helper::getCurrentIp();
            $officeNet = Cnetwork::where([
                ['status', 1],
                ['account_id', Auth::guard('account')->user()->id]
            ])->get()->pluck('ip')->toArray();
            
            $checkIP = in_array($currentNetwork_Address, $officeNet);

            if($checkIP == true){
                $check_out->update($data);
            }
            else {
                return back()->with('error_msg', 'Oops! I think you are not currently inside office');
            }

            return back()->with('error_msg', 'Good bye! have a great day');
        }
        else {
            return back()->with('error_msg', 'You have already marked that you leave the office');
        }
        
    }

}
