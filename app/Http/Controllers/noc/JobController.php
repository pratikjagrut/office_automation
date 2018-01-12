<?php

namespace App\Http\Controllers\noc;

use App\Http\Controllers\Controller;
use App\NocJob;
use App\NocOngoingJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{   
    //Goto newjobEntry Page
    public function index()
    {
    	if(Auth::guest())
    		return redirect('login')->with('error', 'Login First');
    	else
    	{  
            return view('noc.newJobEntry')->with('consumer', null);
        }
    }

    //search consumer from consumer database
    public function selectConsumer(Request $request)
    {
        if(Auth::guest())
        	return redirect('/login')->with('error', 'Login first');
        else
        {
        	$consumer_type = $request->input('consumer_type');
        	$consumer_id = strtolower($request->input('consumer_id'));

        	$consumer = DB::table('noc_consumers')
        	            ->where([ ['name', $consumer_id],
        	                      ['type', $consumer_type]
        	                    ])->first();

        	if(count($consumer) == 0)
        	    return redirect('newJobEntry')->with('error', 'No customer found!');
        	else
        	    return view('noc.newJobEntry')->with('consumer', $consumer);
        }	
    }


    //make entry of new job for selected customer
    public function newJobEntry(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{  	
    		date_default_timezone_set('Asia/Kolkata');
            $ticket = 'SAN-'.date('d').date('m').'-'.date('H').date('i').date('s');

            $circuit_id = $request->input('circuit_id');
            $name = $request->input('name');
            $address = $request->input('address');
        	$area = $request->input('area');
        	$city = $request->input('city');
        	$state = $request->input('state');
        	$contact_details = $request->input('contact_details');
        	$generation_date_timestamp = $request->input('generation_date');
        	$case_reason = $request->input('case_reason');
        	$assign_job = $request->input('assign_job');
        	$assign_to = $request->input('assign_to');
        	$generated_by = $request->input('generated_by');
        	$get_consumer_type = $request->input('get_consumer_type');

        	$job = new NocOngoingJob;
        	$job->ticket = $ticket;
        	$job->circuit_id = $circuit_id;
        	$job->name = strtolower($name);
        	$job->address = strtolower($address);
        	$job->area = strtolower($area);
        	$job->city = strtolower($city);
        	$job->state = strtolower($state);
        	$job->contact_details = $contact_details;
        	$job->generation_date_timestamp = $generation_date_timestamp;
        	$job->case_reason = strtolower($case_reason);
        	$job->assign_to = strtolower($assign_to);
        	$job->generated_by  = strtolower($generated_by);
        	$job->consumer_type = strtolower($get_consumer_type);

        	if($job->save())
        		return redirect('newJobEntry')->with('ticket', $ticket);
        	else
        		return redirect('newJobEntry')->with('error', 'Something went wrong! Data could not be saved in database');

        }
    }

    //list on-going jobs
    public function onGoingJobs()
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $jobs = NocOngoingJob::orderBy('created_at', 'dsc')->get();
            return view('noc.listOnGoingJobs')->with('jobs', $jobs);
        }
    }

    //finised job
    public function finishedJob(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login first');
        else
        {
            $ticket = $request->input('ticket');
            $closeJob = NocOngoingJob::where('ticket', $ticket)->first();
            $finishedJob = new NocJob;
            $finishedJob->ticket = $ticket;
            $finishedJob->circuit_id = $closeJob->circuit_id;
            $finishedJob->name = $closeJob->name;
            $finishedJob->address = $closeJob->address;
            $finishedJob->area = $closeJob->area;
            $finishedJob->city = $closeJob->city;
            $finishedJob->state = $closeJob->state;
            $finishedJob->contact_details = $closeJob->contact_details;
            $finishedJob->generation_date = $closeJob->created_at;
            $finishedJob->case_reason = $closeJob->case_reason;
            $finishedJob->assign_to = $closeJob->assign_to;
            $finishedJob->generated_by = $closeJob->generated_by;
            $finishedJob->consumer_type = $closeJob->consumer_type;
            $finishedJob->close_date = $request->input('close_date');
            $finishedJob->total_time = $request->input('total_time');
            $finishedJob->trouble_description = $request->input('trouble_description');
            $finishedJob->solution_remark = $request->input('solution_remark');
            $finishedJob->closed_by = $request->input('closed_by');

            $finishedJob->save();

            if($closeJob->delete())
                return redirect('/listOnGoingJobs')->with('delete', 'Job is closed!');
            else
                return redirect('/listOnGoingJobs')->with('error', 'Something gone wrong!');
        }
    }

    public function listFinishedJobs()
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $jobs = NocJob::orderBy('created_at', 'dsc')->paginate(20);
            return view('noc.listFinishedJobs')->with('jobs', $jobs);
        }
    }

    public function exportFinishedJobs()
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $jobs = NocJob::orderBy('created_at', 'dsc')->get();
            return view('noc.exportFinishedJobs')->with('jobs', $jobs);
        }
    }
}
