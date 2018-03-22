<?php

namespace App\Http\Controllers\noc;

use App\Engineer;
use App\Http\Controllers\Controller;
use App\NocConsumer;
use App\NocJob;
use App\NocOngoingJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;

class JobController extends Controller
{   
    //Goto newjobEntry Page
    public function index()
    {
    	if(Auth::guest())
    		return redirect('login')->with('error', 'Login First');
    	else
    	{  
            //$engineers = Engineer::all();
            $engineers = User::all();
            /*$teams = DB::table('engineers')
                        ->select('team as team')
                        ->groupBy('team')
                        ->get();
            */
            $teams = DB::table('users')
                        ->select('department as department')
                        ->where('department', 'noc')
                        ->groupBy('department')
                        ->get();            
            $partners = NocConsumer::where('type', 'partner')->get();
            $customers = NocConsumer::where('type', 'customer')->get();
            $resellers = NocConsumer::where('type', 'reseller')->get();
            return view('noc.newJobEntry', [
                                                'consumer' => null,
                                                'engineers' => $engineers,
                                                'teams' => $teams,
                                                'partners' => $partners,
                                                'customers' => $customers,
                                                'resellers' => $resellers
                                           ]);
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
        	$consumer_id = $request->input('partner_id');
            if($consumer_id == null)
                $consumer_id = $request->input('reseller_id');
            $circuit_id = $request->input('circuit_id');
            //$customer_name = $request->input('customer_name');

            if($consumer_id != null)
        	    $consumer = NocConsumer::where([ 
                                               ['name', $consumer_id],
        	                                   ['type', $consumer_type]
        	                               ])
                                            ->first();
            elseif($circuit_id != null)
                $consumer = NocConsumer::where([
                                               ['circuit_id', $circuit_id],
                                               ['type', $consumer_type]
                                           ])
                                            ->orWhere([
                                               ['name', $circuit_id],
                                               ['type', $consumer_type]
                                           ])
                                            ->first();
            /*elseif($customer_name != null)
                $consumer = NocConsumer::where([
                                               ['name', $customer_name],
                                               ['type', $consumer_type]
                                           ])
                                            ->first();*/
                                                                              
            else
                $consumer = null;
            //$engineers = Engineer::all();
            $engineers = User::all();
            /*$teams = DB::table('engineers')
                        ->select('team as team')
                        ->groupBy('team')
                        ->get();
            */
            $teams = DB::table('users')
                        ->select('department as department')
                        ->where('department', 'noc')
                        ->groupBy('department')
                        ->get();            
            $partners = NocConsumer::where('type', 'partner')->get();
            $customers = NocConsumer::where('type', 'customer')->get();
            $resellers = NocConsumer::where('type', 'reseller')->get();
            
        	if($consumer == null)
        	    return redirect('newJobEntry')->with('error', 'No consumer found!');
        	else
        	    return view('noc.newJobEntry',[
                                                'consumer' => $consumer,
                                                'engineers' => $engineers,
                                                'teams' => $teams,
                                                'partners' => $partners,
                                                'customers' => $customers,
                                                'resellers' => $resellers
                                           ]);
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
        	$assign_to_engineer = $request->input('assign_to_engineer');
        	$assign_to_team = $request->input('assign_to_team');
            $generated_by = $request->input('generated_by');
        	$get_consumer_type = $request->input('get_consumer_type');
            $assigned_to_level = $request->input('assigned_to_level');


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
        	if($assign_to_engineer != null)
                $job->assign_to = strtolower($assign_to_engineer);
            else
                $job->assign_to = strtolower($assign_to_team);
        	$job->generated_by  = strtolower($generated_by);
        	$job->consumer_type = strtolower($get_consumer_type);
            $job->assigned_to_level = $assigned_to_level;

        	if($job->save())
        		return redirect('newJobEntry')->with('ticket', $ticket);
        	else
        		return redirect('newJobEntry')->with('error', 'Something went wrong! Data could not be saved in database');

        }
    }

    //list on-going jobs
    public function onGoingJobs(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            if(isset($_GET['filter']))
            {
                if($request->input('consumer_type') != null)
                    $jobs = NocOngoingJob::where('consumer_type', $request->input('consumer_type'))
                                        ->orderBy('created_at', 'dsc')
                                        ->get();
                else
                    $jobs = NocOngoingJob::orderBy('created_at', 'dsc')->get();            
            }
            else
                $jobs = NocOngoingJob::orderBy('created_at', 'dsc')->get();

            //$engineers = Engineer::all();
            $engineers = User::all();
            /*$teams = DB::table('engineers')
                        ->select('team as team')
                        ->groupBy('team')
                        ->get();
            */
            $teams = DB::table('users')
                        ->select('department as department')
                        ->groupBy('department')
                        ->get();
            
            /*$fieldJobs = NocOngoingJob::where('transferred_to', 'field team')
                                        ->orderBy('created_at', 'dsc')
                                        ->get();*/
                                        
            return view('noc.listOnGoingJobs',[
                                                'engineers' => $engineers,
                                                'teams' => $teams,
                                                'jobs' => $jobs,
                                                //'fieldJobs' => $fieldJobs
                                              ]);                             
        }
    }

    public function transferJob(Request $request)
    {
        if(Auth::guest())
            redirect('/login')->with('error', 'Login First');
        else
        {
            $ticket = $request->input('ticket');
            $transfer_to_level = $request->input('transfer_to_level');
            $assign_job = $request->input('assign_job');
            $assign_to_engineer = $request->input('assign_to_engineer');
            $assign_to_team = $request->input('assign_to_team');
            $transferred_by = $request->input('transferred_by');

            $job = NocOngoingJob::where('ticket', $ticket)->first();
            $job->transferred_to_level = $transfer_to_level;
            if($assign_to_engineer != null)
                $job->transferred_to = strtolower($assign_to_engineer);
            else
                $job->transferred_to = strtolower($assign_to_team);
            $job->transferred_by = $transferred_by;
            if($job->save())
                return redirect('/listOnGoingJobs')->with('success', 'Job transferred to '.ucwords($job->transferred_to));
            else
                return redirect('/listOnGoingJobs')->with('error', 'Something went wrong! Data could not be saved in database');

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
            $finishedJob->assigned_to_level = $closeJob->assigned_to_level;
            $finishedJob->transferred_to_level = $closeJob->transferred_to_level;
            $finishedJob->transferred_to = $closeJob->transferred_to;
            $finishedJob->transferred_by = $closeJob->transferred_by;
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

    public function listFinishedJobs(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {   
            if(isset($_GET['filter']))
            {
                if($request->input('consumer_type') != null)
                    $jobs = NocJob::where('consumer_type', $request->input('consumer_type'))
                                        ->orderBy('created_at', 'dsc')
                                        ->paginate(20);
                else
                    $jobs = NocJob::orderBy('created_at', 'dsc')->paginate(20);            
            }
            else
                $jobs = NocJob::orderBy('created_at', 'dsc')->paginate(20);
            /*$fieldJobs = NocJob::where('transferred_to', 'field team')
                                        ->orderBy('created_at', 'dsc')
                                        ->paginate(20);*/
            return view('noc.listFinishedJobs', [
                                                    'jobs' => $jobs,
                                                    //'fieldJobs' => $fieldJobs
                                                ]);
        }
    }

    public function exportFinishedJobs(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {   
            if(isset($_GET['filter']))
            {
                if($request->input('consumer_type') != null)
                    $jobs = NocJob::where('consumer_type', $request->input('consumer_type'))
                                        ->orderBy('created_at', 'dsc')
                                        ->get();
                else
                    $jobs = NocJob::orderBy('created_at', 'dsc')->get();            
            }
            else
                $jobs = NocJob::orderBy('created_at', 'dsc')->get();
            return view('noc.exportFinishedJobs')->with('jobs', $jobs);
        }
    }

    public function deleteFinishedJobs(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $deleteJobs = $request->input('delete');
            $delete = false;

            if(count($deleteJobs) > 0)
            {
                for ($i = 0; $i < count($deleteJobs); $i++) 
                { 
                    $job = NocJob::find($deleteJobs[$i]);
                    $job->delete();
                    $delete = true;
                }
            }

            if($delete)
                return redirect('/listFinishedJobs')->with('success', 'Jobs deleted successfuly');
            else
                return redirect('/listFinishedJobs')->with('error', 'Select at least 1 job to delete');
        }
    }

    public function troubleshootJob(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $ticket = $request->input('ticket');
            $troubleshoot = $request->input('troubleshoot');

            $job = NocOngoingJob::where('ticket', $ticket)->first();
            $job->troubleshoot = $troubleshoot;
            if($job->save())
                return redirect('/listOnGoingJobs')->with('success', 'Done');
            else
                return redirect('/listOnGoingJobs')->with('error', 'Something went wrong! Data could not be saved in database');
        }
    }
}
