<?php

namespace App\Http\Controllers\backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\backend\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
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


    // GET method for getting all permissions
    public function allPermissions() {

        if(Auth::user()->can('permissions.view')) {

            $permissions = Permission::orderBy('name', 'ASC')->get();
            return view('backend.auth.permissions.index', compact('permissions'));

        }
        else {

            return redirect()->route('dashboard.home');

        }
    }



    // GET method for create a permission
    public function addPermission() {

        if(Auth::user()->can('permissions.create')) {

            return view('backend.auth.permissions.create');
    
        }
        else {

            return redirect()->route('dashboard.home');

        }

    }

    // POST method for create an account
    public function storePermission(Request $request) {

        if(Auth::user()->can('permissions.create')) {

            $this->validate($request, [
                'name' => 'required|max:50|unique:permissions',
                'per_for' => 'required'
            ]);

            $permissions = new Permission();
            $p_for = $request->per_for;

            if ($p_for == 'networks_post-type' || $p_for == 'attendance_post-type' || $p_for == 'dashboard-panel' || $p_for == 'other_post-type' || $p_for == 'users_post-type' || $p_for == 'permissions_post-type' || $p_for == 'roles_post-type' || $p_for == 'shifts_post-type')
            {
                $permissions->name = $request->name;
                $permissions->for = $p_for;

                $save = $permissions->save();
                
                if ($save)
                {
                    return back()->with('success_msg','Permission has been added successfully!');
                }
            }
            else
            {
                return back()->with('error_msg','You are adding some mailcious be carefull or else!');
            }

        }
        else {

            return redirect()->route('dashboard.home');

        }

    }



    // GET method for edit permission from db
    public function editPermission($id) {
        
        if(Auth::user()->can('permissions.update')) {

            $peredit = Permission::find($id);
            return view('backend.auth.permissions.edit', compact('peredit'));

        }
        else {

            return redirect()->route('dashboard.home');

        }

    }

    public function updatePermission(Request $request, $id) {

        if(Auth::user()->can('permissions.update')) {

            $this->validate($request, [
                'name' => 'required|max:50',
                'per_for' => 'required'
            ]);

            $peredit = Permission::find($id);
            $p_for = $request->per_for;

            if ($peredit->name == $request->name && $peredit->for == $p_for) 
            {
                if ($p_for == 'networks_post-type' || $p_for == 'attendance_post-type' || $p_for == 'dashboard-panel' || $p_for == 'other_post-type' || $p_for == 'posttype_post-type' || $p_for == 'users_post-type' || $p_for == 'permissions_post-type' || $p_for == 'roles_post-type' || $p_for == 'shifts_post-type')
                {
                    $peredit->name = $request->name;
                    $peredit->for = $p_for;

                    $save = $peredit->update();

                    if ($save) 
                    {
                        return back()->with('success_msg','Permission has been updated without any changes!');
                    }
                }
                else
                {
                    return back()->with('error_msg','You are adding some mailcious be carefull or else!');
                }
            }
            else
            {
                if ($p_for == 'networks_post-type' || $p_for == 'attendance_post-type' || $p_for == 'dashboard-panel' || $p_for == 'other_post-type' || $p_for == 'slots_post-type' || $p_for == 'users_post-type' || $p_for == 'permissions_post-type' || $p_for == 'roles_post-type' || $p_for == 'shifts_post-type')
                {
                    $peredit->name = $request->name;
                    $peredit->for = $p_for;

                    $save = $peredit->update();

                    if ($save) 
                    {
                        return back()->with('success_msg','Permission has been updated successfully!');
                    }
                }
                else
                {
                    return back()->with('error_msg','You are adding some mailcious be carefull or else!');
                }
            }

        }
        else {

            return redirect()->route('dashboard.home');

        }

    }



    // Delete Method for deleting permissions
    public function destroyPermission($id) {

        if(Auth::user()->can('permissions.destroy')) {

            $per_del = Permission::find($id);

            $per_del->delete();

            return redirect()->route('permissions.index')->with('error_msg','Permission has been deleted successfully!');

        }
        else {

            return redirect()->route('dashboard.home');

        }
    
    }
}
