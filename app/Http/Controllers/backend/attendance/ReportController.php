<?php

namespace App\Http\Controllers\backend\attendance;

use App\Http\Controllers\Controller;
use App\Models\attendance\Attendance;
use App\Models\backend\Account;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
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

    public function createReport() {
        $getAccount = Account::whereHas(
            'roles', function($q){
                $q->where('name', 'Employee');
            }
        )->get(['name', 'id']);

        $month = [];

        for ($m=1; $m<=12; $m++) {
            $month[] = date('F', mktime(0,0,0,$m, 1, date('Y')));
        }
        return view('backend.attendance.reports.checkreport', compact('getAccount', 'month'));
    }

    
    public function generateReport(Request $request) {

        $this->validate($request, [

            'employee' => ['required'],
            'month' => ['required']

        ]);

        $emp = $request->employee;
        $mnth = $request->month;

        // Count Sundays in a month
        $dateDay = Carbon::now();//use your date to get month and year
        $year = $dateDay->year;
        $month = $dateDay->month;
        $days = $dateDay->daysInMonth;
        $sundays=[];
        foreach (range(1, $days) as $day) {
            $date = Carbon::createFromDate($year, $month, $day);
            if ($date->isSunday()===true) {
                $sundays[]=($date->day);
            }
        }
        $totalSundays = count($sundays);

        // Count days in month
        $d1 = date_create(date('Y').'-'.date('m').'-01'); //current month/year
        $d2 = date_create($d1->format('Y-m-t')); //get last date of the month

        $days = date_diff($d1,$d2);
        $totalDays = $days->days;

        
        // Attendance of Present days
        $getAttendance = Attendance::where([
            ['out', 1],
            ['month', $mnth],
            ['year', date('Y')],
            ['account_id', $emp]
        ])->orderBy('created_at', 'desc')->get([
            'startTime',
            'endTime',
            'month',
            'isLate',
            'isHalfday',
            'workingHours',
            'isOvertime',
            'over_time',
            'atOffice',
            'day'
        ]);

        // Attendance of Absent Days
        // Attendance of Present days
        $getAttendanceWithoutCheckout = Attendance::where([
            ['out', 0],
            ['month', $mnth],
            ['year', date('Y')],
            ['account_id', $emp]
        ])->orderBy('created_at', 'desc')->get([
            'startTime',
            'month',
            'isLate',
            'atOffice',
            'day'
        ]);

        // Late Days
        $getLate = Attendance::where([
            ['out', 1],
            ['month', $mnth],
            ['year', date('Y')],
            ['isLate', 1],
            ['account_id', $emp]
        ])->get('isLate');

        // Half Days
        $getHalfday = Attendance::where([
            ['out', 1],
            ['month', $mnth],
            ['year', date('Y')],
            ['isHalfDay', 1],
            ['account_id', $emp]
        ])->get('isHalfDay');

        // Overtime Days
        $getOvertimedays = Attendance::where([
            ['out', 1],
            ['month', $mnth],
            ['year', date('Y')],
            ['isOvertime', 1],
            ['account_id', $emp]
        ])->get('over_time');

        // Overtime
        $getOvertime = Attendance::where([
            ['out', 1],
            ['month', $mnth],
            ['year', date('Y')],
            ['isOvertime', 1],
            ['account_id', $emp]
        ])->sum('over_time');

        // Employee name
        $name = Account::where('id', $emp)->value('name');
        $userPro = Account::where('id', $emp)->first();
        // Attendance Result
        $totalWorkingDays = $totalDays;
        $totalPresentDays = count($getAttendance) + $totalSundays;
        $totalAbsents = $totalWorkingDays - $totalPresentDays;
        $totalHalfDays = count($getHalfday);
        $totalLate = count($getLate);
        $totalOvertimeDays = count($getOvertimedays);
        $totalOvertime = $getOvertime;

        $month = Carbon::createFromFormat('m', $mnth);
        $monthName = $month->format('F');
        return view('backend.attendance.reports.report', compact('totalOvertime','totalOvertimeDays', 'monthName', 'totalAbsents', 'totalSundays', 'getAttendance', 'userPro', 'totalWorkingDays', 'totalPresentDays', 'totalHalfDays', 'getAttendanceWithoutCheckout'));

    }

    public function getAttendanceReport() {
        $getAttendance = Attendance::where([
            ['out', 1],
            ['month', date('m')],
            ['year', date('Y')]
        ])->orderBy('created_at', 'desc')->get([
            'startTime',
            'endTime',
            'month',
            'isLate',
            'isHalfday',
            'workingHours',
            'isOvertime',
            'over_time',
            'atOffice',
            'day',
            'account_id',
            'year'
        ]);

        return view('backend.attendance.reports.allattendance',compact('getAttendance'));
    }

}