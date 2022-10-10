<?php

namespace App\Http\Controllers\backend\attendance;

use App\Http\Controllers\Controller;
use App\Models\attendance\Shift;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ShiftController extends Controller
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


    public function allShifts() {
        
        if(Auth::user()->can('shift.view')) {

            $get_all_shifts = Shift::all();
            return view('backend.attendance.shifts.index', compact('get_all_shifts'));
            
        }
        else {
            return redirect()->route('dashboard.home');
        }
    }

    // Add shifts [GET]
    public function addShift() {
        
        if(Auth::user()->can('shift.create')) {
            return view('backend.attendance.shifts.create');
        }
        else {
            return redirect()->route('dashboard.home');
        }

    }

    // Add Shift [POST]
    public function shiftStore(Request $request) {
        
        
        if(Auth::user()->can('shift.create')) {

            $this->validate($request, [

                'name' => ['required', 'string', 'max:255'],
                'start_time' => ['required'],
                'end_time' => ['required'],

            ]);

            $add_shift = new Shift();

            $to = Carbon::createFromFormat('H:s', $request->start_time);
            $from = Carbon::createFromFormat('H:s', $request->end_time);
            $getHours = $to->diffInHours($from);

            if($getHours > 5) {

                $add_shift->create([

                    'name' => $request->name,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                    'working_hours' => $getHours,
                    'status' => $request->status ?? 0

                ]);

                return back()->with('success_msg', 'Shift has been created successfully');
            }
            else {
                return back()->with('error_msg', 'Working hours cannot be less than 6');
            }

        }
        else {
            return redirect()->route('dashboard.home');
        }

    }

    // Edit Shift [GET]
    public function shiftEdit($id) {

        if(Auth::user()->can('shift.update')) {
            $findShift = Shift::find($id);
            return view('backend.attendance.shifts.edit', compact('findShift'));
        } else {
            return redirect()->route('dashboard.home');
        }
    }

    // Update Shift [PUT]
    public function shiftUpdate(Request $request, $id) {
        
        if(Auth::user()->can('shift.update')) {

            $this->validate($request, [

                'name' => ['required', 'string', 'max:255'],
                'start_time' => ['required'],
                'end_time' => ['required'],

            ]);

            $findShift = Shift::find($id);

            $to = Carbon::createFromFormat('H:s', $request->start_time);
            $from = Carbon::createFromFormat('H:s', $request->end_time);
            $updatedHours = $to->diffInHours($from);
 
            if($updatedHours > 5) {

                $findShift->update([

                    'name' => $request->name,
                    'start_time' => $request->start_time,
                    'end_time' => $request->end_time,
                    'working_hours' => $updatedHours,
                    'status' => $request->status ?? 0

                ]);

                return back()->with('success_msg', 'Shift has been updated successfully');
            }
            else {
                return back()->with('error_msg', 'Working hours cannot be less than 6');
            }
        }
        else {
            return redirect()->route('dashboard.home');
        }
    }


    // [GET] Delete shift 
    public function shiftDelete($id) {
        
        if(Auth::user()->can('shift.delete')) {

            Shift::find($id)->delete();
            return back()->with('error_msg', 'Shift has been deleted successfully!');
        
        }
        else {
            return redirect()->route('dashboard.home');
        }
    }

}
