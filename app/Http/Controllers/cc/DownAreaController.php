<?php
namespace App\Http\Controllers\cc;

use App\CcDownArea;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DownAreaController extends Controller
{
    public function index()
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
            return view('cc.downArea');
    }

    public function store(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login first');
        else
        {
            $area = $request->input('area');
            $assigned_to = $request->input('assigned_to');
            $reason = $request->input('reason');
            $down_day_time = $request->input('down_day_time');
            $up_day_time = $request->input('up_day_time');
            $tat = $request->input('tat');
            $generated_by = $request->input('generated_by');

            $new_request = new CcDownArea;
            $new_request->area = $area;
            $new_request->assigned_to = $assigned_to;
            $new_request->reason = $reason;
            $new_request->down_day_time = $down_day_time;
            $new_request->up_day_time = $up_day_time;
 			$new_request->tat = $tat;
            $new_request->generated_by = $generated_by;

            if($new_request->save())
                return redirect('/downArea')->with('success', 'Successfuly submitted request');
            else
                return redirect('/downArea')->with('error', 'Request could not be submitted! Please try again');
        }
    }

    public function listDownAreas(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{  
            if(isset($_GET['filter']))
            {
                if($request->input('downArea') != null)
                    $downAreas = CcDownArea::where([
                                                      ['status', 'down'],
                                                      ['area', $request->input('downArea')]
                                                   ])
                                    ->orderBy('created_at', 'dsc')
                                    ->paginate(30);

                elseif($request->input('assigned_to') != null)
                    $downAreas = CcDownArea::where([
                                                      ['status', 'down'],
                                                      ['assigned_to', $request->input('assigned_to')]
                                                   ])
                                    ->orderBy('created_at', 'dsc')
                                    ->paginate(30);

                elseif($request->input('reason') != null)
                    $downAreas = CcDownArea::where([
                                                      ['status', 'down'],
                                                      ['reason', $request->input('reason')]
                                                   ])
                                    ->orderBy('created_at', 'dsc')
                                    ->paginate(30);

                else
                    $downAreas = CcDownArea::where('status', 'down')
                                    ->orderBy('created_at', 'dsc')
                                    ->paginate(30);
            }
            else
    		    $downAreas = CcDownArea::where('status', 'down')
    								->orderBy('created_at', 'dsc')
    								->paginate(30);
            
            $areas = DB::table('cc_down_areas')
                        ->select('area as area')
                        ->where('status', 'down')
                        ->groupBy('area')
                        ->get();

            $engineers = DB::table('cc_down_areas')
                            ->select('assigned_to as assigned_to')
                            ->where('status', 'down')
                            ->groupBy('assigned_to')
                            ->get();

            $reasons = DB::table('cc_down_areas')
                            ->select('reason as reason')
                            ->where('status', 'down')
                            ->groupBy('reason')
                            ->get();
                            
    		return view('cc.listDownAreas', [
                                                'downAreas' => $downAreas,
                                                'areas' => $areas,
                                                'engineers' => $engineers,
                                                'reasons' => $reasons
                                            ]);	
    	}
    }

    public function closeDownArea(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		$downAreaId = $request->input('downAreaId');
    		$downAreaName = $request->input('downArea');
    		$upTime = $request->input('upTime');
    		$closed_by = $request->input('closed_by');

    		$downArea = CcDownArea::find($downAreaId);
    		$downArea->up_day_time = $upTime;
    		$downArea->status = 'up';
    		$downArea->closed_by = $closed_by;

    		if($downArea->save())
    			return redirect('/listDownAreas')->with('success', ucwords($downAreaName).' is up now!');
    		else
    			return redirect('/listDownAreas')->with('error', 'Something went wrong');
    	}
    }

    public function listClosedDownAreas()
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		$downAreas = CcDownArea::where('status', 'up')
    									 ->orderBy('created_at', 'dsc')
    									 ->paginate(30);
    		return view('cc.listClosedDownAreas')->with('downAreas', $downAreas);
    	}
    }

    public function deleteClosedDownAreas(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login first');
        else
        {
            $downArea_id = array();
            $delete = false;
            for ($i = 0; $i < 10; $i++) { 
                if($request->input('delete_'.($i+1)) != null)
                {
                    $downArea = CcDownArea::find($request->input('delete_'.($i+1)));
                    $downArea->delete();
                    $delete  = true;
                }
            }
            if(!$delete)
                return redirect('/listClosedDownAreas')->with('error', 'Select at least one record to delete');
            else
                return redirect('/listClosedDownAreas')->with('delete', 'Record deleted');
        }
    }
}
