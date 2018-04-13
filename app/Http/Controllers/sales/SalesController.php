<?php

namespace App\Http\Controllers\sales;

use App\Http\Controllers\Controller;
use App\SalesInternetLeasedLines;
use App\SalesP2p;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function index()
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		return view('sales.newConnectionForm');
    	}
    }

    public function internetLeasedLinesConnection(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login first');
    	else
    	{
            $customer_name = $request->input('customer_name');
            $customer_address = $request->input('customer_address');
            $city = $request->input('city');
            $state = $request->input('state');
            $pincode = $request->input('pincode');
            $contact_person_name = $request->input('contact_person_name');
            $contact_person_number = $request->input('contact_person_number');
            $contact_person_email = $request->input('contact_person_email');
            $bandwidth_size = $request->input('bandwidth_size');
    		$generated_by = $request->input('generated_by');

            $count = SalesInternetLeasedLines::select('id')->orderBy('created_at', 'des')->first();
            if($count)
                $inc = $count->id+1;
            else
                $inc = 1;
            date_default_timezone_set('Asia/Kolkata');
            $job_id = 'SHILL'.date('y').date('m').$inc;
            $new_request = new SalesInternetLeasedLines;
            $new_request->job_id = $job_id;
            $new_request->generated_by = $generated_by;
            $new_request->customer_name = $customer_name;
            $new_request->customer_address = $customer_address;
            $new_request->customer_city = $city;
            $new_request->customer_state = $state;
            $new_request->pincode = $pincode;
            $new_request->contact_person_name = $contact_person_name;
            $new_request->contact_person_no = $contact_person_number;
            $new_request->contact_person_email = $contact_person_email;
            $new_request->bandwidth_size = $bandwidth_size;
            $new_request->feasibility_status = 'not decided';
            $new_request->forward_to_ceo = 'no';

            if($new_request->save())
                return redirect('/newConnectionForm')->with('success', 'Successfuly submitted request');
            else
                return redirect('/newConnectionForm')->with('error', 'Request could not be submitted! Please try again');
    	}
    }

    public function p2pConnection(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
            $customer_name = $request->input('customer_name');
            $contact_person_name = $request->input('contact_person_name');
            $contact_person_number = $request->input('contact_person_number');
            $contact_person_email = $request->input('contact_person_email');
            $a_end_address = $request->input('a_end_address');
            $a_end_city = $request->input('a_end_city');
            $a_end_state = $request->input('a_end_state');
            $a_end_pincode = $request->input('a_end_pincode');
            $a_end_lat_long = $request->input('a_end_lat_long');
            $b_end_address = $request->input('b_end_address');
            $b_end_city = $request->input('b_end_city');
            $b_end_state = $request->input('b_end_state');
            $b_end_pincode = $request->input('b_end_pincode');
            $b_end_lat_long = $request->input('b_end_lat_long');
            $network_priority = $request->input('network_priority');
            $other_requirments = $request->input('other_requirments');
    		$generated_by = $request->input('generated_by');

            $count = SalesP2p::select('id')->orderBy('created_at', 'des')->first();
            if($count)
                $inc = $count->id+1;
            else
                $inc = 1;
            date_default_timezone_set('Asia/Kolkata');
            $job_id = 'SHP2P'.date('y').date('m').($inc);
            $new_request = new SalesP2p;
            $new_request->job_id = $job_id;
            $new_request->generated_by = $generated_by;
            $new_request->customer_name = $customer_name;
            $new_request->contact_person_name = $contact_person_name;
            $new_request->contact_person_no = $contact_person_number;
            $new_request->contact_person_email = $contact_person_email;
            $new_request->a_end_address = $a_end_address;
            $new_request->a_end_city = $a_end_city;
            $new_request->a_end_state = $a_end_state;
            $new_request->a_end_pincode = $a_end_pincode;
            $new_request->a_end_lat_long = $a_end_lat_long;
            $new_request->b_end_address = $b_end_address;
            $new_request->b_end_city = $b_end_city;
            $new_request->b_end_state = $b_end_state;
            $new_request->b_end_pincode = $b_end_pincode;
            $new_request->b_end_lat_long = $b_end_lat_long;
            $new_request->network_priority = $network_priority;
            $new_request->other_requirments = $other_requirments;
            $new_request->feasibility_status = 'not decided';
            $new_request->a_end_feasibility = 'not decided';
            $new_request->b_end_feasibility = 'not decided';
            $new_request->forward_to_ceo = 'no';

            if($new_request->save())
                return redirect('/newConnectionForm')->with('success', 'Successfuly submitted request');
            else
                return redirect('/newConnectionForm')->with('error', 'Request could not be submitted! Please try again');
    	}
    }

    public function internetLeasedLineRequests(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
            if (isset($_GET['filter'])) 
            {
                if($request->input('job_id'))
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                        ['job_id', $request->input('job_id')],
                                                                        ['feasibility_status', '!=', 'yes']
                                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('customer_name'))
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                        ['customer_name', $request->input('customer_name')],
                                                                        ['feasibility_status', '!=', 'yes']
                                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('contact_person_name'))
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                        ['contact_person_name', $request->input('contact_person_name')],
                                                                        ['feasibility_status', '!=', 'yes']
                                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('customer_city'))
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                        ['customer_city', $request->input('customer_city')],
                                                                        ['feasibility_status', '!=', 'yes']
                                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('feasibility_status'))
                    $ill_requests = SalesInternetLeasedLines::where('feasibility_status', $request->input('feasibility_status'))
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                else
                    $ill_requests = SalesInternetLeasedLines::where('feasibility_status', '!=', 'yes')->orderBy('created_at', 'dsc')->paginate(15);

            }
            else
                $ill_requests = SalesInternetLeasedLines::where('feasibility_status', '!=', 'yes')->orderBy('created_at', 'dsc')->paginate(15);

            $customers = DB::table('sales_ills')
                        ->select('customer_name as customer_name')
                        ->groupBy('customer_name')
                        ->get();

            $contact_person_names = DB::table('sales_ills')
                        ->select('contact_person_name as contact_person_name')
                        ->groupBy('contact_person_name')
                        ->get();

            $cities = DB::table('sales_ills')
                        ->select('customer_city as customer_city')
                        ->groupBy('customer_city')
                        ->get();            

    		return view('sales.internetLeasedLine', [
                                                        'ill_requests' => $ill_requests,
                                                        'customers' => $customers,
                                                        'contact_person_names' => $contact_person_names,
                                                        'cities' => $cities
                                                    ]);
    	}
    }

    public function internetLeasedLineFeasibleRequests(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            if (isset($_GET['filter'])) 
            {
                if($request->input('job_id'))
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                        ['job_id', $request->input('job_id')],
                                                                        ['feasibility_status', 'yes'],
                                                                        ['forward_to_ceo', 'no']
                                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('customer_name'))
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                        ['customer_name', $request->input('customer_name')],
                                                                        ['feasibility_status', 'yes'],
                                                                        ['forward_to_ceo', 'no']
                                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('contact_person_name'))
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                        ['contact_person_name', $request->input('contact_person_name')],
                                                                        ['feasibility_status', 'yes'],
                                                                        ['forward_to_ceo', 'no']
                                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('customer_city'))
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                        ['customer_city', $request->input('customer_city')],
                                                                        ['feasibility_status', 'yes'],
                                                                        ['forward_to_ceo', 'no']
                                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                else
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                ['feasibility_status', 'yes'],
                                                                ['forward_to_ceo', 'no']
                                                            ])->orderBy('created_at', 'dsc')->paginate(15);

            }
            else                
                $ill_requests = SalesInternetLeasedLines::where([
                                                                ['feasibility_status', 'yes'],
                                                                ['forward_to_ceo', 'no']
                                                            ])->orderBy('created_at', 'dsc')->paginate(15);

            $customers = DB::table('sales_ills')
                        ->select('customer_name as customer_name')
                        ->where([
                                    ['feasibility_status', 'yes'],
                                    ['forward_to_ceo', 'no']
                                ])
                        ->groupBy('customer_name')
                        ->get();

            $contact_person_names = DB::table('sales_ills')
                        ->select('contact_person_name as contact_person_name')
                        ->where([
                                    ['feasibility_status', 'yes'],
                                    ['forward_to_ceo', 'no']
                                ])
                        ->groupBy('contact_person_name')
                        ->get();

            $cities = DB::table('sales_ills')
                        ->select('customer_city as customer_city')
                        ->where([
                                    ['feasibility_status', 'yes'],
                                    ['forward_to_ceo', 'no']
                                ])
                        ->groupBy('customer_city')
                        ->get();

            return view('sales.internetLeasedLineFeasibleRequests', [
                                                                        'ill_requests' => $ill_requests,
                                                                        'customers' => $customers,
                                                                        'contact_person_names' => $contact_person_names,
                                                                        'cities' => $cities
                                                                    ]);
        }
    }

    public function readData($id)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		$data = SalesInternetLeasedLines::find($id);
    		return response($data);
    	}
    }

    public function editConnectionRequest(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		$requestId = $request->input('requestId');
    		$customer_name = $request->input('customer_name');
            $customer_address = $request->input('customer_address');
            $city = $request->input('city');
            $state = $request->input('state');
            $pincode = $request->input('pincode');
            $contact_person_name = $request->input('contact_person_name');
            $contact_person_number = $request->input('contact_person_number');
            $contact_person_email = $request->input('contact_person_email');
            $bandwidth_size = $request->input('bandwidth_size');

            $ill_request = SalesInternetLeasedLines::find($requestId);
            /*if($customer_name != null)
            	$ill_request->customer_name = $customer_name;
            if($customer_address != null)
            	$ill_request->customer_address = $customer_address;
            if($city != null)
            	$ill_request->customer_city = $city;
            if($state != null)
            	$ill_request->customer_state = $state;
            if($pincode != null)
            	$ill_request->pincode = $pincode;
            if($contact_person_name != null)
            	$ill_request->contact_person_name = $contact_person_name;
            if($contact_person_number != null)
            	$ill_request->contact_person_no = $contact_person_number;
            if($contact_person_email != null)
            	$ill_request->contact_person_email = $contact_person_email;
            if($bandwidth_size != null)
            	$ill_request->bandwidth_size = $bandwidth_size;*/

            $ill_request->customer_name = $customer_name;
            $ill_request->customer_address = $customer_address;
            $ill_request->customer_city = $city;
            $ill_request->customer_state = $state;
            $ill_request->pincode = $pincode;
            $ill_request->contact_person_name = $contact_person_name;
            $ill_request->contact_person_no = $contact_person_number;
            $ill_request->contact_person_email = $contact_person_email;
            $ill_request->bandwidth_size = $bandwidth_size;

            if($ill_request->save())
                return redirect('/internetLeasedLine')->with('success', 'Successfuly updated request');
            else
                return redirect('/internetLeasedLine')->with('error', 'Request could not be update! Please try again');
    	}
    }

    public function fesibilityCheck(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		$feasibility_status = $request->input('feasibility_status');
    		$fiber = $request->input('fiber');
    		$rf = $request->input('rf');
    		$generated_by = $request->input('generated_by');
    		$requestId  = $request->input('requestId');

    		if($feasibility_status == 'yes' && ($fiber == null || $rf == null))
                return redirect('/internetLeasedLine')->with('error', 'Please fill fiber and rf fields too!');
            else
            {
                $ill_request = SalesInternetLeasedLines::find($requestId);
                $ill_request->feasibility_status = $feasibility_status;
                $ill_request->fiber = $fiber;
                $ill_request->rf = $rf;
                $ill_request->feasibility_checked_by = $generated_by;

                if($ill_request->save())
                    return redirect('/internetLeasedLine')->with('success', 'Successfuly updated request');
                else
                    return redirect('/internetLeasedLine')->with('error', 'Request could not be update! Please try again');
            }
    	}
    }

    public function deleteIllRequests(Request $request)
    {
    	if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $deleteIllRequest = $request->input('delete');
            $delete = false;
            if(count($deleteIllRequest) > 0)
            {
                for ($i = 0; $i < count($deleteIllRequest); $i++) 
                { 
                    $requestId = SalesInternetLeasedLines::find($deleteIllRequest[$i]);
                    $requestId->delete();
                    $delete = true;
                }
            }
            else
            	return redirect('/internetLeasedLine')->with('delete', 'Select at least one request to delete');

            if($delete)
                return redirect('/internetLeasedLine')->with('success', 'Request Deleted');
            else
                return redirect('/internetLeasedLine')->with('error', 'Something went wrong');
        }
    }

    public function forwardIllRequest(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $forward_to_ceo = $request->input('forward_to_ceo');
            $comment = $request->input('comment');
            $forwarded_by = $request->input('generated_by');
            $requestId = $request->input('requestId');
            $forwardRequest = SalesInternetLeasedLines::find($requestId);
            
            if($forward_to_ceo == 'yes')
            {
                $forwardRequest->forward_to_ceo = $forward_to_ceo;
                $forwardRequest->comment = $comment;
                $forwardRequest->forwarded_by = $forwarded_by;

                if($forwardRequest->save())
                        return redirect('/internetLeasedLineFeasibleRequests')->with('success', 'Successfuly forwarded request');
                    else
                        return redirect('/internetLeasedLineFeasibleRequests')->with('error', 'Request could not be forwarded! Please try again');
            }
            else
            {
                $forwardRequest->feasibility_status = 'not decided';
                if($forwardRequest->save())
                        return redirect('/internetLeasedLineFeasibleRequests')->with('delete', 'Request is not forwarded, it rolled back to feasibilty stage');
                    else
                        return redirect('/internetLeasedLineFeasibleRequests')->with('error', 'Request could not be rolled back! Please try again');
            }
        }
    }

    public function illForwardedRequests(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {   
            if (isset($_GET['filter'])) 
            {
                if($request->input('job_id'))
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                        ['job_id', $request->input('job_id')],
                                                                        ['forward_to_ceo', 'yes'],
                                                                        ['approval', null]
                                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('customer_name'))
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                        ['customer_name', $request->input('customer_name')],
                                                                        ['forward_to_ceo', 'yes'],
                                                                        ['approval', null]
                                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('contact_person_name'))
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                        ['contact_person_name', $request->input('contact_person_name')],
                                                                        ['forward_to_ceo', 'yes'],
                                                                        ['approval', null]
                                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('customer_city'))
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                        ['customer_city', $request->input('customer_city')],
                                                                        ['forward_to_ceo', 'yes'],
                                                                        ['approval', null]
                                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                else
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                ['forward_to_ceo', 'yes'],
                                                                ['approval', null]
                                                           ])->orderBy('created_at', 'dsc')->paginate(15);

            }
            else                
                $ill_requests = SalesInternetLeasedLines::where([
                                                                ['forward_to_ceo', 'yes'],
                                                                ['approval', null]
                                                           ])->orderBy('created_at', 'dsc')->paginate(15);

            $customers = DB::table('sales_ills')
                        ->select('customer_name as customer_name')
                        ->where([
                                    ['forward_to_ceo', 'yes'],
                                    ['approval', null]
                                ])
                        ->groupBy('customer_name')
                        ->get();

            $contact_person_names = DB::table('sales_ills')
                        ->select('contact_person_name as contact_person_name')
                        ->where([
                                    ['forward_to_ceo', 'yes'],
                                    ['approval', null]
                                ])
                        ->groupBy('contact_person_name')
                        ->get();

            $cities = DB::table('sales_ills')
                        ->select('customer_city as customer_city')
                        ->where([
                                    ['forward_to_ceo', 'yes'],
                                    ['approval', null]
                                ])
                        ->groupBy('customer_city')
                        ->get();


            
            return view('sales.illForwardedRequests', [
                                                        'ill_requests' => $ill_requests,
                                                        'customers' => $customers,
                                                        'contact_person_names' => $contact_person_names,
                                                        'cities' => $cities
                                                      ]);
        }
    }

    public function approveIllRequest(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $approval = $request->input('approval');
            $comment = $request->input('comment');
            $acted_by = $request->input('generated_by');
            $requestId = $request->input('requestId');

            $approveRequest = SalesInternetLeasedLines::find($requestId);
            
            if($approval == 'yes')
            {
                $approveRequest->forward_to_ceo = 'no';
                $approveRequest->comment = $comment;
                if($approveRequest->save())
                        return redirect('/internetLeasedLineFeasibleRequests')->with('delete', 'Request is rolled back to sales team');
                    else
                        return redirect('/internetLeasedLineFeasibleRequests')->with('error', 'Request could not be rolled back! Please try again');
            }
            else
            {
                $approveRequest->approval = $approval;
                $approveRequest->approval_note = $comment;
                $approveRequest->approved_by = $acted_by;
                
                if($approveRequest->save())
                            return redirect('/illForwardedRequests')->with('success', 'Request is '.ucwords($approval));
                        else
                            return redirect('/illForwardedRequests')->with('error', 'Request could not be process! Please try again');
            }
        }
    }

    public function illRequests(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            if (isset($_GET['filter'])) 
            {
                if($request->input('job_id'))
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                        ['job_id', $request->input('job_id')],
                                                                        ['approval', '!=', null]
                                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('customer_name'))
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                        ['customer_name', $request->input('customer_name')],
                                                                        ['approval', '!=', null]
                                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('contact_person_name'))
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                        ['contact_person_name', $request->input('contact_person_name')],
                                                                        ['approval', '!=', null]
                                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('customer_city'))
                    $ill_requests = SalesInternetLeasedLines::where([
                                                                        ['customer_city', $request->input('customer_city')],
                                                                        ['approval', '!=', null]
                                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('approval'))
                    $ill_requests = SalesInternetLeasedLines::where('approval', $request->input('approval'))
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                else
                    $ill_requests = SalesInternetLeasedLines::where('approval', '!=', null)->orderBy('created_at', 'dsc')->paginate(15);

            }
            else
                $ill_requests = SalesInternetLeasedLines::where('approval', '!=', null)->orderBy('created_at', 'dsc')->paginate(15);

            $customers = DB::table('sales_ills')
                        ->select('customer_name as customer_name')
                        ->where('approval', '!=', null)
                        ->groupBy('customer_name')
                        ->get();

            $contact_person_names = DB::table('sales_ills')
                        ->select('contact_person_name as contact_person_name')
                        ->where('approval', '!=', null)
                        ->groupBy('contact_person_name')
                        ->get();

            $cities = DB::table('sales_ills')
                        ->select('customer_city as customer_city')
                        ->where('approval', '!=', null)
                        ->groupBy('customer_city')
                        ->get();            

            
            return view('sales.illRequests', [
                                                'ill_requests' => $ill_requests,
                                                'customers' => $customers,
                                                'contact_person_names' => $contact_person_names,
                                                'cities' => $cities
                                              ]);
        }
    }


    public function p2pNewRequests(Request $request)
    {
       if (isset($_GET['filter'])) 
        {
            if($request->input('job_id'))
                $p2p_requests = SalesP2p::where([
                                                    ['job_id', $request->input('job_id')],
                                                    ['feasibility_status', '!=', 'yes']
                                                ])
                                         ->orderBy('created_at', 'dsc')
                                         ->paginate(15);

            elseif($request->input('customer_name'))
                $p2p_requests = SalesP2p::where([
                                                    ['customer_name', $request->input('customer_name')],
                                                    ['feasibility_status', '!=', 'yes']
                                                ])
                                         ->orderBy('created_at', 'dsc')
                                         ->paginate(15);

            elseif($request->input('contact_person_name'))
                $p2p_requests = SalesP2p::where([
                                                    ['contact_person_name', $request->input('contact_person_name')],
                                                    ['feasibility_status', '!=', 'yes']
                                                ])
                                         ->orderBy('created_at', 'dsc')
                                         ->paginate(15);

            elseif($request->input('feasibility_status'))
                $p2p_requests = SalesP2p::where('feasibility_status', $request->input('feasibility_status'))
                                         ->orderBy('created_at', 'dsc')
                                         ->paginate(15);

            else
                $p2p_requests = SalesP2p::where('feasibility_status', '!=', 'yes')->orderBy('created_at', 'dsc')->paginate(15);

        }
        else
            $p2p_requests = SalesP2p::where('feasibility_status', '!=', 'yes')->orderBy('created_at', 'dsc')->paginate(15);

        $customers = DB::table('sales_p2ps')
                    ->select('customer_name as customer_name')
                    ->groupBy('customer_name')
                    ->get();

        $contact_person_names = DB::table('sales_p2ps')
                    ->select('contact_person_name as contact_person_name')
                    ->groupBy('contact_person_name')
                    ->get();            

        return view('sales.p2pNewRequests', [
                                                'p2p_requests' => $p2p_requests,
                                                'customers' => $customers,
                                                'contact_person_names' => $contact_person_names,
                                            ]);
 
    }

    public function readP2pData($id)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $data = SalesP2p::find($id);
            return response($data);
        }
    }


    public function editP2pConnectionRequest(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $customer_name = $request->input('customer_name');
            $contact_person_name = $request->input('contact_person_name');
            $contact_person_number = $request->input('contact_person_number');
            $contact_person_email = $request->input('contact_person_email');
            $a_end_address = $request->input('a_end_address');
            $a_end_city = $request->input('a_end_city');
            $a_end_state = $request->input('a_end_state');
            $a_end_pincode = $request->input('a_end_pincode');
            $a_end_lat_long = $request->input('a_end_lat_long');
            $b_end_address = $request->input('b_end_address');
            $b_end_city = $request->input('b_end_city');
            $b_end_state = $request->input('b_end_state');
            $b_end_pincode = $request->input('b_end_pincode');
            $b_end_lat_long = $request->input('b_end_lat_long');
            $network_priority = $request->input('network_priority');
            $other_requirments = $request->input('other_requirments');

            $p2p_request = new SalesP2p;
            $p2p_request->customer_name = $customer_name;
            $p2p_request->contact_person_name = $contact_person_name;
            $p2p_request->contact_person_no = $contact_person_number;
            $p2p_request->contact_person_email = $contact_person_email;
            $p2p_request->a_end_address = $a_end_address;
            $p2p_request->a_end_city = $a_end_city;
            $p2p_request->a_end_state = $a_end_state;
            $p2p_request->a_end_pincode = $a_end_pincode;
            $p2p_request->a_end_lat_long = $a_end_lat_long;
            $p2p_request->b_end_address = $b_end_address;
            $p2p_request->b_end_city = $b_end_city;
            $p2p_request->b_end_state = $b_end_state;
            $p2p_request->b_end_pincode = $b_end_pincode;
            $p2p_request->b_end_lat_long = $b_end_lat_long;
            $p2p_request->network_priority = $network_priority;
            $p2p_request->other_requirments = $other_requirments;

            if($p2p_request->save())
                return redirect('/p2pNewRequests')->with('success', 'Successfuly submitted request');
            else
                return redirect('/p2pNewRequests')->with('error', 'Request could not be submitted! Please try again');
        }
    }

    public function p2pFesibilityCheck(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $feasibility_status = $request->input('feasibility_status');
            $a_end_feasibility = $request->input('a_end_feasibility');
            $b_end_feasibility = $request->input('b_end_feasibility');
            $generated_by = $request->input('generated_by');
            $requestId  = $request->input('requestId');
            $comment = $request->input('comment');
            $bts_address = $request->input('bts_address');

            $p2p_request = SalesP2p::find($requestId);
            $p2p_request->feasibility_status = $feasibility_status;
            $p2p_request->a_end_feasibility = $a_end_feasibility;
            $p2p_request->b_end_feasibility = $b_end_feasibility;
            $p2p_request->feasibility_checked_by = $generated_by;
            $p2p_request->comment = $comment;
            $p2p_request->bts_address = $bts_address;
            if($p2p_request->save())
                return redirect('/p2pNewRequests')->with('success', 'Successfuly updated request');
            else
                return redirect('/p2pNewRequests')->with('error', 'Request could not be update! Please try again');
        }
    }

    public function p2pFeasibleRequests(Request $request)
    {
       if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            if (isset($_GET['filter'])) 
            {
                if($request->input('job_id'))
                    $p2p_requests = SalesP2p::where([
                                                        ['job_id', $request->input('job_id')],
                                                        ['feasibility_status', 'yes'],
                                                        ['forward_to_ceo', 'no']
                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('customer_name'))
                    $p2p_requests = SalesP2p::where([
                                                        ['customer_name', $request->input('customer_name')],
                                                        ['feasibility_status', 'yes'],
                                                        ['forward_to_ceo', 'no']
                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('contact_person_name'))
                    $p2p_requests = SalesP2p::where([
                                                        ['contact_person_name', $request->input('contact_person_name')],
                                                        ['feasibility_status', 'yes'],
                                                        ['forward_to_ceo', 'no']
                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

            }
            else                
                $p2p_requests = SalesP2p::where([
                                                    ['feasibility_status', 'yes'],
                                                    ['forward_to_ceo', 'no']
                                                ])->orderBy('created_at', 'dsc')->paginate(15);

            $customers = DB::table('sales_p2ps')
                        ->select('customer_name as customer_name')
                        ->where([
                                    ['feasibility_status', 'yes'],
                                    ['forward_to_ceo', 'no']
                                ])
                        ->groupBy('customer_name')
                        ->get();

            $contact_person_names = DB::table('sales_p2ps')
                        ->select('contact_person_name as contact_person_name')
                        ->where([
                                    ['feasibility_status', 'yes'],
                                    ['forward_to_ceo', 'no']
                                ])
                        ->groupBy('contact_person_name')
                        ->get();
            return view('sales.p2pFeasibleRequests', [
                                                        'p2p_requests' => $p2p_requests,
                                                        'customers' => $customers,
                                                        'contact_person_names' => $contact_person_names,
                                                    ]);
        } 
    }

    public function forwardP2pRequest(Request $request)
    {
       if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $forward_to_ceo = $request->input('forward_to_ceo');
            $comment = $request->input('comment');
            $forwarded_by = $request->input('generated_by');
            $requestId = $request->input('requestId');
            $forwardRequest = SalesP2p::find($requestId);
            
            if($forward_to_ceo == 'yes')
            {
                $forwardRequest->forward_to_ceo = $forward_to_ceo;
                $forwardRequest->comment = $comment;
                $forwardRequest->forwarded_by = $forwarded_by;

                if($forwardRequest->save())
                        return redirect('/p2pFeasibleRequests')->with('success', 'Successfuly forwarded request');
                    else
                        return redirect('/p2pFeasibleRequests')->with('error', 'Request could not be forwarded! Please try again');
            }
            else
            {
                $forwardRequest->feasibility_status = 'not decided';
                if($forwardRequest->save())
                        return redirect('/p2pFeasibleRequests')->with('delete', 'Request is not forwarded, it rolled back to feasibilty stage');
                    else
                        return redirect('/p2pFeasibleRequests')->with('error', 'Request could not be rolled back! Please try again');
            }
        } 
    }

    public function p2pForwardedRequests(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {   
            if (isset($_GET['filter'])) 
            {
                if($request->input('job_id'))
                    $p2p_requests = SalesP2p::where([
                                                        ['job_id', $request->input('job_id')],
                                                        ['forward_to_ceo', 'yes'],
                                                        ['approval', null]
                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('customer_name'))
                    $p2p_requests = SalesP2p::where([
                                                        ['customer_name', $request->input('customer_name')],
                                                        ['forward_to_ceo', 'yes'],
                                                        ['approval', null]
                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('contact_person_name'))
                    $p2p_requests = SalesP2p::where([
                                                        ['contact_person_name', $request->input('contact_person_name')],
                                                        ['forward_to_ceo', 'yes'],
                                                        ['approval', null]
                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

            }
            else                
                $p2p_requests = SalesP2p::where([
                                                    ['forward_to_ceo', 'yes'],
                                                    ['approval', null]
                                               ])->orderBy('created_at', 'dsc')->paginate(15);

            $customers = DB::table('sales_p2ps')
                        ->select('customer_name as customer_name')
                        ->where([
                                    ['forward_to_ceo', 'yes'],
                                    ['approval', null]
                                ])
                        ->groupBy('customer_name')
                        ->get();

            $contact_person_names = DB::table('sales_p2ps')
                        ->select('contact_person_name as contact_person_name')
                        ->where([
                                    ['forward_to_ceo', 'yes'],
                                    ['approval', null]
                                ])
                        ->groupBy('contact_person_name')
                        ->get();


            
            return view('sales.p2pForwardedRequests', [
                                                        'p2p_requests' => $p2p_requests,
                                                        'customers' => $customers,
                                                        'contact_person_names' => $contact_person_names,
                                                      ]);
        }
    }

    public function approveP2pRequest(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $approval = $request->input('approval');
            $comment = $request->input('comment');
            $acted_by = $request->input('generated_by');
            $requestId = $request->input('requestId');

            $approveRequest = SalesP2p::find($requestId);
            
            if($approval == 'yes')
            {
                $approveRequest->forward_to_ceo = 'no';
                $approveRequest->comment = $comment;
                if($approveRequest->save())
                        return redirect('/p2pForwardedRequests')->with('delete', 'Request is rolled back to sales team');
                    else
                        return redirect('/p2pForwardedRequests')->with('error', 'Request could not be rolled back! Please try again');
            }
            else
            {
                $approveRequest->approval = $approval;
                $approveRequest->approval_note = $comment;
                $approveRequest->approved_by = $acted_by;
                
                if($approveRequest->save())
                            return redirect('/p2pForwardedRequests')->with('success', 'Request is '.ucwords($approval));
                        else
                            return redirect('/p2pForwardedRequests')->with('error', 'Request could not be process! Please try again');
            }
        }
    }

    public function p2pRequests(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            if (isset($_GET['filter'])) 
            {
                if($request->input('job_id'))
                    $p2p_requests = SalesP2p::where([
                                                        ['job_id', $request->input('job_id')],
                                                        ['approval', '!=', null]
                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('customer_name'))
                    $p2p_requests = SalesP2p::where([
                                                        ['customer_name', $request->input('customer_name')],
                                                        ['approval', '!=', null]
                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('contact_person_name'))
                    $p2p_requests = SalesP2p::where([
                                                        ['contact_person_name', $request->input('contact_person_name')],
                                                        ['approval', '!=', null]
                                                    ])
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                elseif($request->input('approval'))
                    $p2p_requests = SalesP2p::where('approval', $request->input('approval'))
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(15);

                else
                    $p2p_requests = SalesP2p::where('approval', '!=', null)->orderBy('created_at', 'dsc')->paginate(15);

            }
            else
                $p2p_requests = SalesP2p::where('approval', '!=', null)->orderBy('created_at', 'dsc')->paginate(15);

            $customers = DB::table('sales_p2ps')
                        ->select('customer_name as customer_name')
                        ->where('approval', '!=', null)
                        ->groupBy('customer_name')
                        ->get();

            $contact_person_names = DB::table('sales_p2ps')
                        ->select('contact_person_name as contact_person_name')
                        ->where('approval', '!=', null)
                        ->groupBy('contact_person_name')
                        ->get();           

            
            return view('sales.p2pRequests', [
                                                'p2p_requests' => $p2p_requests,
                                                'customers' => $customers,
                                                'contact_person_names' => $contact_person_names,
                                              ]);
        }
    }
}
