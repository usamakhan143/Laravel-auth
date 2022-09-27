<?php

namespace App\Http\Controllers\backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\backend\Account_role;
use App\Models\backend\Permission;
use App\Models\backend\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
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

    // GET all roles from db
    public function allRoles(){

        if(Auth::user()->can('roles.view')) {

            $roles = Role::where('id', '<>', 1)->get();
            return view('backend.auth.roles.index', compact('roles'));
        
        }
        else {
            
            return redirect()->route('dashboard.home');

        }
        
    }



    // GET method for add roles to db
    public function addRole() {

        if(Auth::user()->can('roles.create')) {
                
            $permissions = Permission::all();
            return view('backend.auth.roles.create', compact('permissions'));
        }
        else {
            return redirect()->route('dashboard.home');
        }
	}

    // POST method for add roles to db
    public function storeRole(Request $request) {

        if(Auth::user()->can('roles.create')) {

            $this->validate($request, [
                'name' => 'required|max:50|unique:roles',
            ]);

            $role = new Role();

            $role->name = $request->name;

            $save = $role->save();

            $role->permission()->sync($request->permissions);

            if ($save) {
                return back()->with('success_msg', 'Role has been added successfully!');
            }

        }
        else {

            return redirect()->route('dashboard.home');

        }
    }



    // GET method for update any role from db
    public function editRole($id) {
        
        if(Auth::user()->can('roles.update')) {

            $roleedit = Role::find($id);
            $permissions = Permission::all();
            $rolepr = $roleedit->permission()->pluck('permission_id')->toArray();
            return view('backend.auth.roles.edit', compact('roleedit', 'permissions', 'rolepr'));
        
        }
        else {
            
            return redirect()->route('dashboard.home');

        }
    
    }

    // PUT method for update any role from db
    public function updateRole(Request $request, $id) {

        if(Auth::user()->can('roles.update')) {

            $this->validate($request, [
                'name' => 'required|max:50',
            ]);

            $roleedit = role::find($id);

            $roleedit->name = $request->name;

            $roleedit->permission()->sync($request->permissions);

            $save = $roleedit->update();

            if ($save) {
                return back()->with('success_msg', 'Role has been updated successfully!');
            }
            
        }
        else {

            return redirect()->route('dashboard.home');

        }

    }


    // DELETE method for deleting role from db
    public function destroyRole($id){

        if(Auth::user()->can('roles.delete')) {

            $roledel = role::find($id);

            DB::table('permission_roles')->where('role_id', $id)->delete();

            $del_relation = Account_role::where('role_id', '=', $id)->delete();

            $roledel->delete();

            return back()->with('error_msg', 'Role has been deleted successfully!');

        }
        else {

            return redirect()->route('dashboard.home');

        }
    }
}