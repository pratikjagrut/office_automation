<?php

namespace App\Http\Controllers\cc;

use App\CcExtension;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function listExtensions()
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		$extensions = CcExtension::orderBy('created_at', 'dsc')
    								  ->get();
    		return view('cc.listExtensions')->with('extensions', $extensions);
    	}
    }

    public function changeExtensionStatus(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		$extension_id = $request->input('extension_id');
    		$extension_status = $request->input('extension_status');
    		$extension_granted_by = $request->input('extension_granted_by');
    		$customer_id = $request->input('customer_id');
    		$extension = CcExtension::find($extension_id);
    		$extension->status = $extension_status;
    		$extension->granted_by = $extension_granted_by;

    		if($extension->save())
    			return redirect('/listExtensions')->with('success', ucwords($customer_id).' extension is '.ucwords($extension_status));
    		else
    			return redirect('/listExtensions')->with('error', 'Something Went Wrong');
    	}
    }
}
