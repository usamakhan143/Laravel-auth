<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\backend\Account;
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

        if(Auth::user()->can('employees'))
        {
            $employees = Account::whereHas(
                'roles', function($q){
                    $q->where('name', 'Employee');
                }
            )->get();

            $numbers_of_emp = count($employees);
            return view('backend.layouts.dashboard', compact('numbers_of_emp'));
        } else {
            return view('backend.layouts.dashboard');
        }

    }
}