<?php

namespace App\Http\Controllers\inventory;

use App\Http\Controllers\Controller;
use App\InventoryPurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
            return view('inventory.purchaseRequest');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login first');
        else
        {
            $vendor_name = $request->input('vendor_name');
            $customer_address = $request->input('customer_address');
            $email_id = $request->input('email_id');
            $date = $request->input('date');
            $po_number = $request->input('po_number');
            $from_department = $request->input('from_department');
            $purchase_requistion = $request->input('purchase_requistion');
            $quotation_department = $request->input('quotation_department');
            $ship_to = $request->input('ship_to');
            $good_description = $request->input('good_description');
            $unit = $request->input('unit');
            $quantity = $request->input('quantity');
            $unit_price = $request->input('unit_price');
            $amount = $request->input('amount');
            $total_rs = $request->input('total_rs');
            $payment_terms = $request->input('payment_terms');
            $validity_po = $request->input('validity_po');
            $date_expiry = $request->input('date_expiry');

            $new_request = new InventoryPurchaseRequest;
            $new_request->vendor_name = $vendor_name;
            $new_request->customer_address = $customer_address;
            $new_request->email_id = $email_id;
            $new_request->date = $date;
            $new_request->po_number = $po_number;
            $new_request->from_department = $from_department;
            $new_request->purchase_requistion = $purchase_requistion;
            $new_request->quotation_department = $quotation_department;
            $new_request->ship_to = $ship_to;
            $new_request->good_description = $good_description;
            $new_request->unit = $unit;
            $new_request->quantity = $quantity;
            $new_request->unit_price = $unit_price;
            $new_request->amount = $amount;
            $new_request->total_rs = $total_rs;
            $new_request->payment_terms = $payment_terms;
            $new_request->validity_po = $validity_po;
            $new_request->date_expiry = $date_expiry;

            if($new_request->save())
                return redirect('/purchaseRequest')->with('success', 'Successfuly submitted request');
            else
                return redirect('/purchaseRequest')->with('error', 'Request could not be submitted! Please try again');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
