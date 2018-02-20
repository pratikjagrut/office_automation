<?php

namespace App\Http\Controllers\cc;

use App\CcFeasibleArea;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeasibleAreaController extends Controller
{
    public function index()
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
            return view('cc.feasibleArea');
    }

    public function store(Request $request)
    {
       if(Auth::guest())
            return redirect('/login')->with('error', 'Login first');
        else
        {
            $reseller_name = $request->input('reseller_name');
            $building = $request->input('building');
            $society = $request->input('society');
            $area = $request->input('area');
            $city = $request->input('city');
            $switch_location = $request->input('switch_location');
            $contact_person_name = $request->input('contact_person_name');
            $contact_person_number = $request->input('contact_person_number');
            $generated_by = $request->input('generated_by');

            $new_request = new CcFeasibleArea;
            $new_request->reseller_name = $reseller_name;
            $new_request->building = $building;
            $new_request->society = $society;
            $new_request->area = $area;
            $new_request->city = $city;
            $new_request->switch_location = $switch_location;
            $new_request->contact_person_name = $contact_person_name;
            $new_request->contact_person_number = $contact_person_number;
            $new_request->generated_by = $generated_by;

            if($new_request->save())
                return redirect('/feasibleArea')->with('success', 'Successfuly submitted request');
            else
                return redirect('/feasibleArea')->with('error', 'Request could not be submitted! Please try again');
        }
    }

    public function listFeasibleAreas()
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		$feasibleAreas = CcFeasibleArea::all();
    		return view('cc.listFeasibleAreas')->with('feasibleAreas', $feasibleAreas);
    	}
    }
}
