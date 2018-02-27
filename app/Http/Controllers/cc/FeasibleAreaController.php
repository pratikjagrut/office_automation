<?php

namespace App\Http\Controllers\cc;

use App\CcFeasibleArea;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
                return redirect('/feasibleArea')->with('success', 'Successfully submitted request');
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
        	$resellers = DB::table('cc_feasible_areas')
                        ->select('reseller_name as reseller_name')
                        ->groupBy('reseller_name')
                        ->get();

            $societies = DB::table('cc_feasible_areas')
                        ->select('society as society')
                        ->groupBy('society')
                        ->get();

            $areas = DB::table('cc_feasible_areas')
                        ->select('area as area')
                        ->groupBy('area')
                        ->get();

        	$switch_locations = DB::table('cc_feasible_areas')
                        ->select('switch_location as switch_location')
                        ->groupBy('switch_location')
                        ->get();

            $contact_persons = DB::table('cc_feasible_areas')
                        ->select('contact_person_name as contact_person_name')
                        ->groupBy('contact_person_name')
                        ->get();

            $feasibleAreas = CcFeasibleArea::all();
            return view('cc.listFeasibleAreas', [
            										'resellers' => $resellers,
            										'societies' => $societies,
            										'areas' => $areas,
            										'switch_locations' => $switch_locations,
            										'contact_persons' => $contact_persons,
            										'feasibleAreas' => $feasibleAreas
            								    ]);
        }
    }

    public function deleteFeasibleAreas(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            if(isset($_POST['feasibleAreas']))
            {
                $feasibleAreaId = $request->input('feasibleAreaId');
                $delete = false;
                if(count($feasibleAreaId) > 0)
                {
                    for ($i = 0; $i < count($feasibleAreaId); $i++)
                    { 
                        $feasibleArea = CcFeasibleArea::find($feasibleAreaId[$i]);
                        $feasibleArea->delete();
                        $delete = true;
                    }
                }

                if($delete)
                    return redirect('/listFeasibleAreas')->with('success', count($feasibleAreaId).' Feasible Area/s Deleted');
                else
                    return redirect('/listFeasibleAreas')->with('error', 'Select feasible areas to delete');
            }
        }
    }

    public function exportFeasibleAreas()
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Lofin First');
        else
        {
                $resellers = DB::table('cc_feasible_areas')
                            ->select('reseller_name as reseller_name')
                            ->groupBy('reseller_name')
                            ->get();

                $societies = DB::table('cc_feasible_areas')
                            ->select('society as society')
                            ->groupBy('society')
                            ->get();

                $areas = DB::table('cc_feasible_areas')
                            ->select('area as area')
                            ->groupBy('area')
                            ->get();

                $switch_locations = DB::table('cc_feasible_areas')
                            ->select('switch_location as switch_location')
                            ->groupBy('switch_location')
                            ->get();

                $contact_persons = DB::table('cc_feasible_areas')
                            ->select('contact_person_name as contact_person_name')
                            ->groupBy('contact_person_name')
                            ->get();

                $feasibleAreas = CcFeasibleArea::all();
                return view('cc.exportFeasibleAreas', [
                                                        'resellers' => $resellers,
                                                        'societies' => $societies,
                                                        'areas' => $areas,
                                                        'switch_locations' => $switch_locations,
                                                        'contact_persons' => $contact_persons,
                                                        'feasibleAreas' => $feasibleAreas
                                                    ]);   
        }
    }

    public function editFeasibleArea(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
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
            $feasibleAreaId = $request->input('feasibleAreaId');
            $edited_by = $request->input('edited_by');

            $feasibleArea = CcFeasibleArea::find($feasibleAreaId);
            if($reseller_name != null)
                $feasibleArea->reseller_name = $reseller_name;
            if($building != null)
                $feasibleArea->building = $building;
            if($society != null)
                $feasibleArea->society = $society;
            if($area != null)
                $feasibleArea->area = $area;
            if($city != null)
                $feasibleArea->city = $city;
            if($switch_location != null)
                $feasibleArea->switch_location = $switch_location;
            if($contact_person_name != null)
                $feasibleArea->contact_person_name = $contact_person_name;
            if($contact_person_number != null)
                $feasibleArea->contact_person_number = $contact_person_number;
            if($edited_by != null)
                $feasibleArea->edited_by = $edited_by;

            if($feasibleArea->save())
                return redirect('/listFeasibleAreas')->with('success', ucwords($feasibleArea->area).' successfully updated');
            else
                return redirect('/listFeasibleAreas')->with('error', 'Request could not be submitted! Please try again');   
        }
    }
}
	