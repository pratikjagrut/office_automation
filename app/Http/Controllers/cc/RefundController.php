<?php

namespace App\Http\Controllers\cc;

use App\BankList;
use App\CcRefund;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $modeOfPayment = $request->input('modeOfPayment');
            $account_no = $request->input('account_no');
            $ifsc_no = $request->input('ifsc_no');
            $bank = $request->input('bank');
            $other_bank = $request->input('other_bank');
            $branch = $request->input('branch');
            $reason = $request->input('reason');
            $refund_amount = $request->input('refund_amount');
            $mail_date = $request->input('mail_date');
            $done_date = $request->input('done_date');
            $assigned_to = $request->input('assigned_to');
            $generated_by = $request->input('generated_by');

            $new_request = new CcRefund;
            $new_request->customer_id = $customer_id;
            $new_request->customer_name = $customer_name;
            $new_request->mode_of_payment = $modeOfPayment;
            if($modeOfPayment == 'online banking')
            {
                $new_request->account_no = $account_no;
                $new_request->ifsc_no = $ifsc_no;
                if($bank != null)
                    $new_request->bank = $bank;
                else
                    $new_request->bank = $other_bank;
                $new_request->branch = $branch;

            }
            else
            {
                $new_request->account_no = 'NA';
                $new_request->ifsc_no = 'NA';
                $new_request->bank = 'NA';
                $new_request->branch = 'NA';
                $new_request->utr_no = 'NA';
            }
            $new_request->reason = $reason;
            $new_request->refund_amount = $refund_amount;
            $new_request->mail_date = $mail_date;
            $new_request->refund_status = 'pending';
            $new_request->done_date = $done_date;
            $new_request->assigned_to = $assigned_to;
            $new_request->generated_by = $generated_by;

            if($new_request->save())
                return redirect('/refund')->with('success', 'Successfuly submitted request');
            else
                return redirect('/refund')->with('error', 'Request could not be submitted! Please try again');
        }
    }

    public function listRefunds(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{  
            if(isset($_GET['filter']))
            {
                if($request->input('customer_id') != null)
                    $refunds = CcRefund::where('customer_id', $request->input('customer_id'))
                                    ->orderBy('created_at', 'dsc')
                                    ->paginate(30);

                elseif($request->input('assigned_to') != null)
                    $refunds = CcRefund::where('assigned_to', $request->input('assigned_to'))
                                    ->orderBy('created_at', 'dsc')
                                    ->paginate(30);

                elseif($request->input('complaint_date') != null)
                    $refunds = CcRefund::where('created_at', 'LIKE', $request->input('complaint_date').'%')
                                    ->orderBy('created_at', 'dsc')
                                    ->paginate(30);

                elseif($request->input('customer_name') != null)
                    $refunds = CcRefund::where('customer_name', $request->input('customer_name'))
                                    ->orderBy('created_at', 'dsc')
                                    ->paginate(30);

                elseif($request->input('status') != null)
                    $refunds = CcRefund::where('refund_status', $request->input('status'))
                                    ->orderBy('created_at', 'dsc')
                                    ->paginate(30);                    
                else
                    $refunds = CcRefund::orderBy('created_at', 'dsc')->paginate(30);
            }
            else
                $refunds = CcRefund::orderBy('created_at', 'dsc')->paginate(30);

            $engineers = DB::table('cc_refunds')
                            ->select('assigned_to as assigned_to')
                            ->groupBy('assigned_to')
                            ->get();

            $customer_id = DB::table('cc_refunds')
                            ->select('customer_id as customer_id')
                            ->groupBy('customer_id')
                            ->get();

            $customer_name = DB::table('cc_refunds')
                            ->select('customer_name as customer_name')
                            ->groupBy('customer_name')
                            ->get(); 

            return view('cc.listRefunds', [
                                                'refunds' => $refunds,
                                                'engineers' => $engineers,
                                                'customer_id' => $customer_id,
                                                'customer_name' => $customer_name
                                            ]); 
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

    public function exportRefunds(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
           if(isset($_GET['filter']))
            {
                if($request->input('customer_id') != null)
                    $refunds = CcRefund::where('customer_id', $request->input('customer_id'))
                                    ->orderBy('created_at', 'dsc')
                                    ->get();

                elseif($request->input('assigned_to') != null)
                    $refunds = CcRefund::where('assigned_to', $request->input('assigned_to'))
                                    ->orderBy('created_at', 'dsc')
                                    ->get();

                elseif($request->input('complaint_date') != null)
                    $refunds = CcRefund::where('created_at', 'LIKE', $request->input('complaint_date').'%')
                                    ->orderBy('created_at', 'dsc')
                                    ->get();

                elseif($request->input('customer_name') != null)
                    $refunds = CcRefund::where('customer_name', $request->input('customer_name'))
                                    ->orderBy('created_at', 'dsc')
                                    ->get();

                elseif($request->input('status') != null)
                    $refunds = CcRefund::where('refund_status', $request->input('status'))
                                    ->orderBy('created_at', 'dsc')
                                    ->get();                    
                else
                    $refunds = CcRefund::orderBy('created_at', 'dsc')->get();
            }
            else
                $refunds = CcRefund::orderBy('created_at', 'dsc')->get();

            $engineers = DB::table('cc_refunds')
                            ->select('assigned_to as assigned_to')
                            ->groupBy('assigned_to')
                            ->get();

            $customer_id = DB::table('cc_refunds')
                            ->select('customer_id as customer_id')
                            ->groupBy('customer_id')
                            ->get();

            $customer_name = DB::table('cc_refunds')
                            ->select('customer_name as customer_name')
                            ->groupBy('customer_name')
                            ->get(); 

            return view('cc.exportRefunds', [
                                                'refunds' => $refunds,
                                                'engineers' => $engineers,
                                                'customer_id' => $customer_id,
                                                'customer_name' => $customer_name
                                            ]); 
        }
    }

    public function actOnRefunds(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $grantRefund = $request->input('grantRefund');
            $rejectRefund = $request->input('rejectRefund');
            $deleteRefund = $request->input('deleteRefund');
            $granted_by = $request->input('granted_by');
            $grant = false;
            $reject = false;
            $delete = false;

            if(count($grantRefund) > 0)
                for ($i = 0; $i < count($grantRefund); $i++) 
                { 
                    $refund = Ccrefund::find($grantRefund[$i]);
                    $refund->refund_status = 'granted';
                    $refund->granted_by = $granted_by;
                    $refund->save();
                    $grant = true;
                }

            if(count($rejectRefund) > 0)
                for ($i = 0; $i < count($rejectRefund); $i++) 
                { 
                    $refund = Ccrefund::find($rejectRefund[$i]);
                    $refund->refund_status = 'rejected';
                    $refund->granted_by = $granted_by;
                    $refund->utr_no = '';
                    $refund->save();
                    $reject = true;
                }

            if(count($deleteRefund) > 0)
                for ($i = 0; $i < count($deleteRefund); $i++) 
                { 
                    $refund = Ccrefund::find($deleteRefund[$i]);
                    $refund->delete();
                    $delete = true;
                }

            if(!$grant && !$reject && !$delete)
                return redirect('/listRefunds')->with('error', 'Select at least one record to delete');
            elseif($grant && !$reject && !$delete)
                return redirect('/listRefunds')->with('success', count($grantRefund).' refund granted');
            elseif(!$grant && $reject && !$delete)
                return redirect('/listRefunds')->with('success', count($rejectRefund).' refund rejected');
            elseif(!$grant && !$reject && $delete)
                return redirect('/listRefunds')->with('success', count($deleteRefund).' refund deleted');
            else
                return redirect('/listRefunds')->with('success', count($grantRefund).' refund/s is/are granted, '.count($rejectRefund).' is/are rejected and '.count($rejectRefund).' is/are deleted');                           
        }
    }


    public function updateUtr(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $refund_id = $request->input('refund_id');
            $utr_no = $request->input('utr_no');

            $refund = Ccrefund::find($refund_id);
            $refund->utr_no = $utr_no;
            $refund->refund_status = 'done';
            if($refund->save())
                return redirect('/listRefunds')->with('success', 'UTR is updated');
            else
                return redirect('/listRefunds')->with('error', 'Something went wrong');
        }
    }
}
