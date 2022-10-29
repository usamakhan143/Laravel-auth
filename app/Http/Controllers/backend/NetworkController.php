<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Cnetwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NetworkController extends Controller
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

    // GET all Networks from db
    public function allNetworks(){

        if(Auth::user()->can('networks.view')) {

            $nw = Cnetwork::all();
            return view('backend.network.index', compact('nw'));
        
        }
        else {
            
            return redirect()->route('dashboard.home');

        }
        
    }



    // GET method for add Networks to db
    public function addNetwork() {

        if(Auth::user()->can('networks.create')) {
            return view('backend.network.create');
        }
        else {
            return redirect()->route('dashboard.home');
        }
	}

    // POST method for add Networks to db
    public function storeNetwork(Request $request) {

        if(Auth::user()->can('networks.create')) {

            $this->validate($request, [
                'name' => 'required|max:50|unique:cnetworks',
                'ip' => 'required',
                'mac' => 'required|unique:cnetworks'
            ]);

            $network = new Cnetwork();

            $network->name = $request->name;
            $network->ip = $request->ip;
            $network->mac = $request->mac;
            $network->status = $request->status ?? 0;

            $save = $network->save();

            if ($save) {
                return back()->with('success_msg', 'Network has been added successfully!');
            }

        }
        else {

            return redirect()->route('dashboard.home');

        }
    }



    // GET method for update any Network from db
    public function editNetwork($id) {
        
        if(Auth::user()->can('networks.update')) {

            $network_edit = Cnetwork::find($id);
            return view('backend.network.edit', compact('network_edit'));
        
        }
        else {
            
            return redirect()->route('dashboard.home');

        }
    
    }

    // PUT method for update any Network from db
    public function updateNetwork(Request $request, $id) {

        if(Auth::user()->can('networks.update')) {

            $this->validate($request, [
                'name' => 'required|max:50',
                'ip' => 'required',
                'mac' => 'required'
            ]);

            $network_edit = Cnetwork::find($id);

            $network_edit->name = $request->name;
            $network_edit->ip = $request->ip;
            $network_edit->mac = $request->mac;
            $network_edit->status = $request->status ?? 0;

            $save = $network_edit->update();

            if ($save) {
                return back()->with('success_msg', 'Network has been updated successfully!');
            }
            
        }
        else {

            return redirect()->route('dashboard.home');

        }

    }


    // DELETE method for deleting network from db
    public function destroyNetwork($id){

        if(Auth::user()->can('networks.delete')) {

            $networkdel = Cnetwork::find($id);
            $networkdel->delete();

            return back()->with('error_msg', 'Network has been deleted successfully!');

        }
        else {

            return redirect()->route('dashboard.home');

        }
    }
}
