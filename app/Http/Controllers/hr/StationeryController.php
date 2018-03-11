<?php

namespace App\Http\Controllers\hr;

use App\HrStationery;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StationeryController extends Controller
{
    public function index()
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
            return view('hr.stationery');
    }

    public function store(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login first');
        else
        {
            $item_description = $request->input('item_description');
            $quantity = $request->input('quantity');
            $reason = $request->input('reason');
            $generated_by = $request->input('generated_by');

            $new_request = new HrStationery;
            $new_request->item_description = $item_description;
            $new_request->quantity = $quantity;
            $new_request->reason = $reason;
            $new_request->status = 'pending';
            $new_request->generated_by = $generated_by;

            if($new_request->save())
                return redirect('/stationery')->with('success', 'Successfuly submitted request');
            else
                return redirect('/stationery')->with('error', 'Request could not be submitted! Please try again');
        }
    }

    public function listStationeryRequests(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{  
            if(isset($_GET['filter']))
            {
                if($request->input('generated_by') != null)
                    $stationeryRequests = HrStationery::where('generated_by', $request->input('generated_by'))
                                                    ->orderBy('created_at', 'dsc')
                                                    ->paginate(20);

                elseif($request->input('status') != null)
                    $stationeryRequests = HrStationery::where('status', $request->input('status'))
                                                    ->orderBy('created_at', 'dsc')
                                                    ->paginate(20);

                elseif($request->input('generated_date') != null)
                    $stationeryRequests = HrStationery::where('created_at', 'LIKE', $request->input('generated_date').'%')
                                                    ->orderBy('created_at', 'dsc')
                                                    ->paginate(20);

                elseif($request->input('about_item') != null)
                    $stationeryRequests = HrStationery::where('item_description', 'LIKE', '%'.$request->input('about_item').'%')
                                                    ->orderBy('created_at', 'dsc')
                                                    ->paginate(20);
                else
                    $stationeryRequests = HrStationery::orderBy('created_at', 'dsc')->paginate(20);
            }
            else
                $stationeryRequests = HrStationery::orderBy('created_at', 'dsc')->paginate(20);
            $engineers = DB::table('hr_stationaries')
                            ->select('generated_by as generated_by')
                            ->groupBy('generated_by')
                            ->get();

    		return view('hr.listStationeryRequests', [
                                                        'stationeryRequests' => $stationeryRequests,
                                                        'engineers' => $engineers
                                                     ]);
    	}
    }

    public function actionOnRequests(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		$action = $request->input('action');
    		$comment = $request->input('comment');
    		$requestId = $request->input('requestId');
    		$acted_by = $request->input('acted_by');

    		$manPowerRequest = HrStationery::find($requestId);
    		$manPowerRequest->status = $action;
    		$manPowerRequest->comment = $comment;
    		$manPowerRequest->acted_by = $acted_by;

    		if($manPowerRequest->save())
    			return redirect('/listStationeryRequests')->with('success', 'Stationery Request is '.ucwords($action));
            else
                return redirect('/listStationeryRequests')->with('error', 'Something went wrong');
    	}
    }

    public function editStationeryRequest(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		$requestId = $request->input('requestId');
    		$item_description = $request->input('item_description');
            $quantity = $request->input('quantity');
            $reason = $request->input('reason');
            $edited_by = $request->input('edited_by');
            $edit = false;

            $stationeryRequest = HrStationery::find($requestId);
            if($item_description != null)
              {
                $stationeryRequest->item_description = $item_description;
                $stationeryRequest->edited_by = $edited_by;
                $edit = true;
              }
            if($quantity != null)
              {
                $stationeryRequest->quantity = $quantity;
                $stationeryRequest->edited_by = $edited_by;
                $edit = true;
              }
            if($reason != null)
              {
                $stationeryRequest->reason = $reason;
                $stationeryRequest->edited_by = $edited_by;
                $edit = true;
              }

            if($edit)
                if($stationeryRequest->save())
                    return redirect('/listStationeryRequests')->with('success', 'Successfuly edited request');
                else
                    return redirect('/listStationeryRequests')->with('Something went wrong');
            else
                return redirect('/listStationeryRequests')->with('error', 'Nothing to edit');	
    	}
    }

    public function deleteStationeryRequests(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $deleteRequestId = $request->input('delete');
            $delete = false;

            if(count($deleteRequestId) > 0)
            {
                for ($i = 0; $i < count($deleteRequestId); $i++) 
                { 
                    $deleteRequest = HrStationery::find($deleteRequestId[$i]);
                    $deleteRequest->delete();
                    $delete = true;
                }
            }

            if($delete)
                return redirect('/listStationeryRequests')->with('success', 'Request Deleted');
            else
                return redirect('/listStationeryRequests')->with('error', 'Please select at least one request to delete');
        }
    }
    public function exportStationeryRequests(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {  
            if(isset($_GET['filter']))
            {
                if($request->input('generated_by') != null)
                    $stationeryRequests = HrStationery::where('generated_by', $request->input('generated_by'))
                                                    ->orderBy('created_at', 'dsc')
                                                    ->get();

                elseif($request->input('status') != null)
                    $stationeryRequests = HrStationery::where('status', $request->input('status'))
                                                    ->orderBy('created_at', 'dsc')
                                                    ->get();

                elseif($request->input('generated_date') != null)
                    $stationeryRequests = HrStationery::where('created_at', 'LIKE', $request->input('generated_date').'%')
                                                    ->orderBy('created_at', 'dsc')
                                                    ->get();

                elseif($request->input('about_item') != null)
                    $stationeryRequests = HrStationery::where('item_description', 'LIKE', '%'.$request->input('about_item').'%')
                                                    ->orderBy('created_at', 'dsc')
                                                    ->get();
                else
                    $stationeryRequests = HrStationery::orderBy('created_at', 'dsc')->get();
            }
            else
                $stationeryRequests = HrStationery::orderBy('created_at', 'dsc')->get();
            $engineers = DB::table('hr_stationaries')
                            ->select('generated_by as generated_by')
                            ->groupBy('generated_by')
                            ->get();

            return view('hr.exportStationeryRequests', [
                                                        'stationeryRequests' => $stationeryRequests,
                                                        'engineers' => $engineers
                                                     ]);
        }
    }
}
