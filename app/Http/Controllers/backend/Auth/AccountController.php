<?php

namespace App\Http\Controllers\backend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Changepass;
use App\Models\backend\Account;
use App\Models\backend\Account_role;
use App\Models\backend\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AccountController extends Controller
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

    // GET method for getting all accounts
    public function allAccounts() {

        if(Auth::user()->can('accounts.view')) {

            // $accounts = Account::where('id', '<>', 1)->get();
            $accounts = Account::all();
            return view('backend.auth.users.index', compact('accounts'));

        }
        else {

            return redirect()->route('dashboard.home');

        }
    }

    
    
    // GET method for create an account
    public function addAccount() {

        if(Auth::user()->can('accounts.create')) {

            $roles = Role::where('id', '<>', 1)->get();
            return view('backend.auth.users.create', compact('roles'));

        }
        else {

            return redirect()->route('dashboard.home');

        }

    }

    // POST method for create an account
    public function storeAccount(Request $request) {

        if(Auth::user()->can('accounts.create')) {

            $this->validate($request, [

                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:accounts'],
                'phone' => ['required', 'numeric'],
                //'image' => ['required'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'role' => ['required'],

            ]);

            $user = new Account();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->image = 'backend/images/usama.png';
            $user->phone = $request->phone;
            $user->status = $request->status;
            $user->save();

            $user->roles()->sync($request->role);

            return redirect()->route('all.accounts')->with('success-msg', 'New Account has been Created!');

        }
        else {

            return redirect()->route('dashboard.home');

        }
    }



    // GET method for edit account from db
    public function accountEdit($id) {
        
        if(Auth::user()->can('accounts.update')) {

            $user = Account::find($id);
            $roles = role::where('id', '<>', 1)->get();
            $user_role = $user->roles()->pluck('role_id')->toArray();
            return view('backend.auth.users.edit', compact('user', 'roles', 'user_role'));

        }
        else {

            return redirect()->route('dashboard.home');

        }
    
    }

    // PUT method for edit account from db
    public function accountUpdate(Request $request, $id) {

        if(Auth::user()->can('accounts.update')) {

            $this->validate($request, [

                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255'],
                'phone' => ['required', 'numeric'],

            ]);

            $user = Account::find($id);

            if (!empty($request->input('password'))) {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = bcrypt($request->password);
                $user->image = 'backend/images/usama.png';
                $user->phone = $request->phone;
                $user->status = $request->status ?? 0;
                $user->update();
            } else {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->image = 'backend/images/usama.png';
                $user->phone = $request->phone;
                $user->status = $request->status ?? 0;
                $user->update();
            }

            $user->roles()->sync($request->role);

            return redirect()->route('all.accounts')->with('success-msg', 'Account has been updated!');

        }
        else {

            return redirect()->route('dashboard.home');

        }
    }


    // DELETE method for deleting accounts from db
    public function accountDestroy($id) {

        if(Auth::user()->can('accounts.delete')) {

            $del = Account::find($id);
            Account_role::where('account_id', '=', $id)->delete();

            $del->delete();

            return back()->with('error-msg', 'Account has been deleted!');

        }
        else {

            return redirect()->route('dashboard.home');

        }
    }


    	//Change Password
	public function newPass($id) {

		if (Auth::user()->can('accounts.chgPassword')) {
		
            $user = Account::find($id);
			return view('backend.auth.users.changepass', compact('user'));
		
        } 
        else {
		
            return redirect()->route('dashboard.home');
		
        }
	}

	public function passChanged($id, Changepass $request) {
		
        if (Auth::user()->can('accounts.chgPassword')) {
			
            $user = Account::find($id);
			// $getemail = Emailsetting::find(4);

			// $data = [
			// 	'email' => $user->email,
			// 	'lastpass' => $request->lpass,
			// 	'newpass' => $request->newpass,
			// ];

			// $user_email = [$getemail->emails];

			if (Hash::check($request->lpass, $user->password)) {
				$user->password = Hash::make($request->newpass);
				$save = $user->update();
				if ($save) {
					// Mail::send('admin.users.emailTemp', $data, function ($msgs) use ($user_email) {
					// 	$msgs->to($user_email);
					// 	$msgs->subject('New Update for Password');
					// });
					return back()->with('success-msg', 'Password has been changed successfully');
				}
			} else {
				return back()->with('error_msg', 'Password doesnot match please try again.');
			}
		
        } 
        else 
        {
		
            return redirect()->route('dashboard.home');
		
        }
	}
}
