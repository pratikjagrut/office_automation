<?php

namespace App\Http\Controllers\hr;

use App\HrManpower;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManPowerController extends Controller
{
    public function index()
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
            return view('hr.manPower');
    }

    public function store(Request $request)
    {
     if(Auth::guest())
            return redirect('/login')->with('error', 'Login first');
        else
        {
            $vacancy_designation = $request->input('vacancy_designation');
            $no_of_vacancy = $request->input('no_of_vacancy');
            $reason = $request->input('reason');
            $priority = $request->input('priority');
            $preferences = $request->input('preferences');
            $qualification = $request->input('qualification');
            $job_description = $request->input('job_description');
            $generated_by = $request->input('generated_by');

            $new_request = new HrManpower;
            $new_request->vacancy_designation = $vacancy_designation;
            $new_request->no_of_vacancy = $no_of_vacancy;
            $new_request->reason = $reason;
            $new_request->priority = $priority;
            $new_request->preferences = $preferences;
            $new_request->status = 'pending';
            $new_request->qualification = $qualification;
            $new_request->job_description = $job_description;
            $new_request->generated_by = $generated_by;

            if($new_request->save())
                return redirect('/manPower')->with('success', 'Successfuly submitted request');
            else
                return redirect('/manPower')->with('error', 'Request could not be submitted! Please try again');
        }
    }

    public function listManPowerRequirments()
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		$manPowerRequests = HrManpower::orderBy('created_at', 'dsc')->paginate(20);
    		return view('hr.listManPowerRequirments')->with('manPowerRequests', $manPowerRequests);
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

    		$manPowerRequest = HrManpower::find($requestId);
    		$manPowerRequest->status = $action;
    		$manPowerRequest->comment = $comment;
    		$manPowerRequest->acted_by = $acted_by;

    		if($manPowerRequest->save())
    			return redirect('/listManPowerRequirments')->with('success', 'Man Power Request is '.ucwords($action));
            else
                return redirect('/listManPowerRequirments')->with('error', 'Something went wrong');
    	}
    }

    public function editManPowerRequest(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $requestId = $request->input('requestId');
            $vacancy_designation = $request->input('vacancy_designation');
            $no_of_vacancy = $request->input('no_of_vacancy');
            $reason = $request->input('reason');
            $priority = $request->input('priority');
            $preferences = $request->input('preferences');
            $qualification = $request->input('qualification');
            $job_description = $request->input('job_description');
            $edited_by = $request->input('edited_by');

            $manPowerRequest = HrManpower::find($requestId);
            if($vacancy_designation != null)
                $manPowerRequest->vacancy_designation = $vacancy_designation;
            if($no_of_vacancy != null)
                $manPowerRequest->no_of_vacancy = $no_of_vacancy;
            if($reason != null)
                $manPowerRequest->reason = $reason;
            if($priority != null)
                $manPowerRequest->priority = $priority;
            if($preferences != null)
                $manPowerRequest->preferences = $preferences;
            if($qualification != null)
                $manPowerRequest->qualification = $qualification;
            if($job_description != null)
                $manPowerRequest->job_description = $job_description;
            if($edited_by != null)
                $manPowerRequest->edited_by = $edited_by;

            if($manPowerRequest->save())
                return redirect('/listManPowerRequirments')->with('success', 'Successfuly edited request');
            else
                return redirect('/listManPowerRequirments')->with('error', 'Request could not be edited! Please try again');
        }
    }

    public function deleteManPowerRequest(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $deleteManPowerRequestId = $request->input('delete');
            $delete = false;
            if(count($deleteManPowerRequestId) > 0)
            {
                for ($i = 0; $i < count($deleteManPowerRequestId); $i++) 
                { 
                    $requestId = HrManpower::find($deleteManPowerRequestId[$i]);
                    $requestId->delete();
                    $delete = true;
                }
            }

            if($delete)
                return redirect('/listManPowerRequirments')->with('success', 'Request Deleted');
            else
                return redirect('/listManPowerRequirments')->with('error', 'Something went wrong');
        }
    }
}
