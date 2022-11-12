<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Account;
use App\Models\attendance\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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



    
    public function index(){

            $employees = Account::whereHas(
                'roles', function($q){
                    $q->where('name', 'Employee');
                }
            )->get(['email']);

            $numbers_of_emp = count($employees);

            $who_is_inside = Attendance::where([
                ['day', date('d')],
                ['month', date('m')],
                ['year', date('Y')],
                ['in', 1],
            ])->get();

            $total_present = count($who_is_inside);

            $check_record = count($who_is_inside);

            return view('backend.layouts.dashboard', compact('check_record', 'numbers_of_emp', 'who_is_inside', 'total_present'));

    }
}