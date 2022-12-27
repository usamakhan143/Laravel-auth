<?php

namespace App\Http\Controllers\backend\attendance;

use App\Http\Controllers\Controller;
use App\Models\attendance\Publicholiday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicholidayController extends Controller
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

    public function index()
    {

        if (Auth::user()->can('Holiday.view')) {

            $all_holidays = Publicholiday::get();
            return view('backend.attendance.holidays.index', compact('all_holidays'));
        } else {
            return redirect()->route('dashboard.home');
        }
    }

    // Add a new Holiday GET request
    public function create()
    {
        if (Auth::user()->can('Holiday.create')) {
            return view('backend.attendance.holidays.create');
        } else {
            return redirect()->route('dashboard.home');
        }
    }

    public function holidayStore(Request $request)
    {
        if (Auth::user()->can('Holiday.create')) {
            $this->validate($request, [

                'name' => ['required'],
                'description' => ['required'],
                'status' => ['required']

            ]);

            $day = Carbon::parse($request->date)->format('d');
            $month = Carbon::parse($request->date)->format('m');
            $year = Carbon::parse($request->date)->format('Y');

            $add_Holiday = new Publicholiday();

            $add_Holiday->name = $request->name;
            $add_Holiday->description = $request->description;
            $add_Holiday->day = $day;
            $add_Holiday->month = $month;
            $add_Holiday->year = $year;
            $add_Holiday->status = $request->status;

            $save = $add_Holiday->save();

            if ($save) {
                return back()->with('success_msg', 'Holiday has been added successfully');
            } else {
                return back()->with('error_msg', 'Something went wrong please check');
            }
        } else {
            return redirect()->route('dashboard.home');
        }
    }


    // Edit Holiday
    public function edit($id)
    {
        if (Auth::user()->can('Holiday.edit')) {
            $hol = Publicholiday::find($id);
            return view('backend.attendance.holidays.edit', compact('hol'));
        } else {
            return redirect()->route('dashboard.home');
        }
    }

    public function updateHoliday(Request $request, $id)
    {

        if (Auth::user()->can('Holiday.edit')) {
            // $this->validate($request, [

            //     'name' => ['required'],
            //     'description' => ['required'],
            //     'status' => ['required']

            // ]);

            $day = Carbon::parse($request->date)->format('d');
            $month = Carbon::parse($request->date)->format('m');
            $year = Carbon::parse($request->date)->format('Y');


            $editHol = Publicholiday::find($id);

            $editHol->name = $request->name;
            $editHol->description = $request->description;
            $editHol->day = $day;
            $editHol->month = $month;
            $editHol->year = $year;
            $editHol->status = $request->status;

            $update = $editHol->update();

            if ($update) {
                return back()->with('success_msg', 'Holiday has been updated successfully');
            } else {
                return back()->with('error_msg', 'Something went wrong please check');
            }
        } else {
            return redirect()->route('dashboard.home');
        }
    }


    // Delete Holiday
    public function deleteHoliday($id)
    {
        if (Auth::user()->can('Holiday.delete')) {
            $del = Publicholiday::find($id)->delete();
            if ($del) {
                return back()->with('success_msg', 'Holiday has been deleted successfully');
            } else {
                return back()->with('error_msg', 'Something went wrong please check');
            }
        } else {
            return redirect()->route('dashboard.home');
        }
    }
}
