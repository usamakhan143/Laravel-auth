<?php

namespace App\Http\Controllers\backend\attendance;

use App\Http\Controllers\Controller;
use App\Models\attendance\Attendance;
use App\Models\attendance\Shift;
use App\Models\backend\Account;
use App\Models\Cnetwork;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        // $user_shift = Account::find(Auth::guard('account')->user()->id)->shifts;
        // $user_shift_pusharray = Arr::get($user_shift, 0);
        // $current_user_start_time = Arr::pull($user_shift_pusharray, 'start_time').':00';
        // $time = Carbon::createFromFormat('H:i', date('H:i'))->addMinutes(0)->toTimeString();
        // dd($time);
        // if($current_user_start_time <= date('H:i')) {
        //     dd('you can able to mark attendance');
        // }
        // else{
        //     dd('you are not able to mark attendance');
        // }
        return view('backend.attendance.mark.checkin');
    }

    public function checkInStore(Request $request) {

        $check_in = new Attendance();
        
        // Check Is the candidate is late?
        $user_shift = Account::find(Auth::guard('account')->user()->id)->shifts;
        $user_shift_pusharray = Arr::get($user_shift, 0);
        $current_userShift_start_time = Arr::pull($user_shift_pusharray, 'start_time').':00';
        $actual_start_time_ofUser = Carbon::createFromFormat('H:i:s', date('H:i:s'))->addMinutes(0)->toTimeString();

        ($current_userShift_start_time < $actual_start_time_ofUser) ? $is_late = 1 : $is_late = 0;

        // Check is the candidate is inside office
        $arp = `arp -a`;
        $lines = explode("\n", $arp);
        $devices = array();
        foreach ($lines as $line) {
            $cols = preg_split('/\s+/', trim($line));
            if (isset($cols[2]) && $cols[2] == 'dynamic') {
                $temp = array();
                $temp['ip'] = $cols[0];
                $temp['mac'] = $cols[1];
                $devices[] = $temp;
            }
        }
        $currentNetwork_Address = $devices[0]['mac'];
        $officeNet = Cnetwork::where('name', 'Office')->value('mac');
        $officeStatus = Cnetwork::where('name', 'Office')->value('status');
        ($officeNet == $currentNetwork_Address) ? $atOffice = 1 : $atOffice = 0;
        
        if($officeStatus == 1) {

            $check_in->create([

                'in' => 1,
                'startTime' => $actual_start_time_ofUser,
                'atOffice' => $atOffice,
                'day' => date('d'),
                'year' => date('Y'),
                'month' => date('m'),
                'isHalfDay' => 0,
                'isLate' => $is_late,
                'out' => 'NaN',
                'endTime' => 'NaN',
                'workingHours' => 'NaN',
                'isOvertime' => 'NaN',
                'account_id' => Auth::guard('account')->user()->id,
                'department_id' => 0,
                'team_id' => 0

            ]);

        }
        else {
            return back()->with('success_msg', 'You are not in office');
        }
    }

}
