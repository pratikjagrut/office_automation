<?php

namespace App\Http\Controllers\cc;

use App\BankList;
use App\CcRefund;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RefundController extends Controller
{
    public function index()
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
        	$banks = BankList::all();
        	return view('cc.refund')->with('banks', $banks);
        }
    }

    public function store(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login first');
        else
        {
            $customer_id = $request->input('customer_id');
            $customer_name = $request->input('customer_name');
            $account_no = $request->input('account_no');
            $ifsc_no = $request->input('ifsc_no');
            $bank = $request->input('bank');
            $other_bank = $request->input('other_bank');
            $branch = $request->input('branch');
            $reason = $request->input('reason');
            $refund_amount = $request->input('refund_amount');
            $mail_date = $request->input('mail_date');
            $refund_status = $request->input('refund_status');
            $done_date = $request->input('done_date');
            $utr_no = $request->input('utr_no');
            $assigned_to = $request->input('assigned_to');
            $generated_by = $request->input('generated_by');

            $new_request = new CcRefund;
            $new_request->customer_id = $customer_id;
            $new_request->customer_name = $customer_name;
            $new_request->account_no = $account_no;
            $new_request->ifsc_no = $ifsc_no;
            if($bank != null)
            	$new_request->bank = $bank;
            else
            	$new_request->bank = $other_bank;
            $new_request->branch = $branch;
            $new_request->reason = $reason;
            $new_request->refund_amount = $refund_amount;
            $new_request->mail_date = $mail_date;
            $new_request->refund_status = $refund_status;
            $new_request->done_date = $done_date;
            $new_request->utr_no = $utr_no;
            $new_request->assigned_to = $assigned_to;
            $new_request->generated_by = $generated_by;

            if($new_request->save())
                return redirect('/refund')->with('success', 'Successfuly submitted request');
            else
                return redirect('/refund')->with('error', 'Request could not be submitted! Please try again');
        }
    }

    public function listRefunds()
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		$refunds = CcRefund::orderBy('created_at', 'dsc')->get();
    		return view('cc/listRefunds')->with('refunds', $refunds);
    	}
    }

    public function changeRefundStatus(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'LOgin first');
    	else
    	{
    		$refund_id = $request->input('refund_id');
    		$customer_id = $request->input('customer_id');
    		$refund_status = $request->input('refund_status');
    		$refund_granted_by = $request->input('refund_granted_by');

    		$refund = CcRefund::find($refund_id);
    		$refund->refund_status = $refund_status;
    		$refund->granted_by = $refund_granted_by;

    		if($refund->save())
    			return redirect('/listRefunds')->with('success', ucwords($customer_id).' refund '.ucwords($refund_status));
    		else
    			return redirect('/listRefunds')->with('error', 'Something went wrong');
    	}
    }
}
