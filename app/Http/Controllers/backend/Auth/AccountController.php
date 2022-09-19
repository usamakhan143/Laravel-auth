<?php

namespace App\Http\Controllers\backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\backend\Account;
use App\Models\backend\Account_role;
use App\Models\backend\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    // GET method for getting all accounts
    public function allAccounts(){
        // $accounts = Account::where('id', '<>', 1)->get();
        $accounts = Account::all();
		return view('backend.auth.users.index', compact('accounts'));
    }

    
    
    // GET method for create an account
    public function addAccount(){
        $roles = Role::where('id', '<>', 1)->get();
		return view('backend.auth.users.create', compact('roles'));
    }

    // POST method for create an account
    public function storeAccount(Request $request){

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



    // GET method for edit account from db
    public function accountEdit($id){
        
        $user = Account::find($id);
        $roles = role::where('id', '<>', 1)->get();
        $user_role = $user->roles()->pluck('role_id')->toArray();
        return view('backend.auth.users.edit', compact('user', 'roles', 'user_role'));
    
    }

    // PUT method for edit account from db
    public function accountUpdate(Request $request, $id){

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


    // DELETE method for deleting accounts from db
    public function accountDestroy($id){
        $del = Account::find($id);
        Account_role::where('account_id', '=', $id)->delete();

        $del->delete();

        return back()->with('error-msg', 'Account has been deleted!');
    }
}
