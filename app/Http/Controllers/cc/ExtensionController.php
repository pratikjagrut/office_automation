<?php

namespace App\Http\Controllers\cc;

use App\CcExtension;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExtensionController extends Controller
{
	public function index()
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
            return view('cc.extension');
    }

    public function store(Request $request)
    {
       if(Auth::guest())
            return redirect('/login')->with('error', 'Login first');
        else
        {
            $customer_id = $request->input('customer_id');
            $complaint_date = $request->input('complaint_date');
            $expiry_date = $request->input('expiry_date');
            $reason = $request->input('reason');
            $extension_day = $request->input('extension_day');
            $assigned_to = $request->input('assigned_to');
            $generated_by = $request->input('generated_by');

            $new_request = new CcExtension;
            $new_request->customer_id = $customer_id;
            $new_request->complaint_date = $complaint_date;
            $new_request->expiry_date = $expiry_date;
            $new_request->reason = $reason; 
            $new_request->extension_day = $extension_day; 
            $new_request->assigned_to = $assigned_to;
            $new_request->generated_by = $generated_by;

            if($new_request->save())
                return redirect('/extension')->with('success', 'Successfuly submitted request');
            else
                return redirect('/extension')->with('error', 'Request could not be submitted! Please try again');
        }
    }

    public function listExtensions(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
            if(isset($_GET['filter']))
            {
                if($request->input('customer_id') != null)
                    $extensions = CcExtension::where('customer_id', $request->input('customer_id'))
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(30);
                
                elseif($request->input('assigned_to') != null)
                    $extensions = CcExtension::where('assigned_to', $request->input('assigned_to'))
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(30);
                
                elseif($request->input('status') != null)
                    $extensions = CcExtension::where('status', $request->input('status'))
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(30);
                
                elseif($request->input('complaint_date') != null)
                    $extensions = CcExtension::where('complaint_date', 'LIKE', $request->input('complaint_date'))
                                             ->orderBy('created_at', 'dsc')
                                             ->paginate(30);
                
                else
                    $extensions = CcExtension::orderBy('created_at', 'dsc')
                                      ->paginate(30);                             
            }
            else
                $extensions = CcExtension::orderBy('created_at', 'dsc')
                                      ->paginate(30);

            $customers = DB::table('cc_extensions')
                        ->select('customer_id as customer_id')
                        ->groupBy('customer_id')
                        ->get();

            $engineers = DB::table('cc_extensions')
                            ->select('assigned_to as assigned_to')
                            ->groupBy('assigned_to')
                            ->get();

    		return view('cc.listExtensions', [
                                                'extensions' => $extensions,
                                                'engineers' => $engineers,
                                                'customers' => $customers
                                             ]);
    	}
    }

    /*public function changeExtensionStatus(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		$extension_id = $request->input('extension_id');
    		$extension_status = $request->input('extension_status');
    		$extension_granted_by = $request->input('granted_by');
    		$customer_id = $request->input('customer_id');
    		$extension = CcExtension::find($extension_id);
    		$extension->status = $extension_status;
    		$extension->granted_by = $extension_granted_by;

    		if($extension->save())
    			return redirect('/listExtensions')->with('success', ucwords($customer_id).' extension is '.ucwords($extension_status));
    		else
    			return redirect('/listExtensions')->with('error', 'Something Went Wrong');
    	}
    }*/

    public function operationOnExtensions(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $grant_extension_id = $request->input('grant');
            //$reject_extension_id = $request->input('reject');
            $delete_extension_id = $request->input('delete');
            $granted_by = $request->input('granted_by');
            $grant = false;
            $reject = false;
            $delete = false;
            
            if(count($grant_extension_id) > 0)
                for ($i = 0; $i < count($grant_extension_id); $i++) 
                { 
                    $extension = CcExtension::find($grant_extension_id[$i]);
                    $extension->status = 'granted';
                    $extension->rejection_note = '';
                    $extension->granted_by = $granted_by;
                    $extension->save();
                    $grant = true;
                }

            /*if(count($reject_extension_id))
                for ($i = 0; $i < count($reject_extension_id); $i++) 
                { 
                    $extension = CcExtension::find($reject_extension_id[$i]);
                    $extension->status = 'rejected';
                    $extension->granted_by = $granted_by;
                    $extension->save();
                    $reject = true;
                }*/

             if(count($delete_extension_id) > 0)
                for ($i = 0; $i < count($delete_extension_id); $i++) 
                { 
                    $extension = CcExtension::find($delete_extension_id[$i]);
                    $extension->delete();
                    $delete = true;
                }  
            if(!$grant /*&& !$reject*/ && !$delete)
                return redirect('/listExtensions')->with('error', 'Select at least one record');
            elseif($grant /*&& !$reject*/ && !$delete)
                return redirect('/listExtensions')->with('success', count($grant_extension_id).' extension granted');
            /*elseif(!$grant && $reject && !$delete)
                return redirect('/listExtensions')->with('success', count($reject_extension_id).' extension rejected');*/
            elseif(!$grant /*&& !$reject*/ && $delete)
                return redirect('/listExtensions')->with('success', count($delete_extension_id).' extension deleted');
            else
                return redirect('/listExtensions')->with('success', count($grant_extension_id).' extension/s is/are granted, '/*.count($reject_extension_id).' is/are rejected and '*/.count($delete_extension_id).' is/are deleted');
        }
    }

    public function exportExtensions(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            if(isset($_GET['filter']))
            {
                if($request->input('customer_id') != null)
                    $extensions = CcExtension::where('customer_id', $request->input('customer_id'))
                                             ->orderBy('created_at', 'dsc')
                                             ->get();
                
                elseif($request->input('assigned_to') != null)
                    $extensions = CcExtension::where('assigned_to', $request->input('assigned_to'))
                                             ->orderBy('created_at', 'dsc')
                                             ->get();
                
                elseif($request->input('status') != null)
                    $extensions = CcExtension::where('status', $request->input('status'))
                                             ->orderBy('created_at', 'dsc')
                                             ->get();
                
                elseif($request->input('complaint_date') != null)
                    $extensions = CcExtension::where('complaint_date', 'LIKE', $request->input('complaint_date'))
                                             ->orderBy('created_at', 'dsc')
                                             ->get();
                
                else
                    $extensions = CcExtension::orderBy('created_at', 'dsc')
                                      ->get();                             
            }
            else
                $extensions = CcExtension::orderBy('created_at', 'dsc')
                                      ->get();

            $customers = DB::table('cc_extensions')
                        ->select('customer_id as customer_id')
                        ->groupBy('customer_id')
                        ->get();

            $engineers = DB::table('cc_extensions')
                            ->select('assigned_to as assigned_to')
                            ->groupBy('assigned_to')
                            ->get();

            return view('cc.exportExtensions', [
                                                'extensions' => $extensions,
                                                'engineers' => $engineers,
                                                'customers' => $customers
                                             ]);   
        }
    }

    public function rejectExtension(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $extension_id = $request->input('extension_id');
            $customer_id = $request->input('customer_id');
            $rejection_note = $request->input('rejection_note');
            $rejected_by = $request->input('rejected_by');
            $reject = false;

            $extension = CcExtension::find($extension_id);
            $extension->rejection_note = $rejection_note;
            $extension->status = 'rejected';
            $extension->granted_by = $rejected_by;
            if($extension->save())
                return redirect('/listExtensions')->with('delete', $customer_id.' extension is rejected');
            else
                return redirect('error', 'Something went wrong');
        }
    }
}
