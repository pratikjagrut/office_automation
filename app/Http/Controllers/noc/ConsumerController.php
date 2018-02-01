<?php

namespace App\Http\Controllers\noc;

use App\Http\Controllers\Controller;
use App\NocConsumer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsumerController extends Controller
{
    public function index()
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
            if(auth()->user()->user_type != 'admin')
                return redirect('/newJobEntry')->with('error', 'Unauthorised Access!');
    		else
                return view('noc.addNewConsumer',[
    			'consumers' => null,
    			'consumer_type' => null
    		    ]);
    	}	
    }

    public function setConsumer(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		$consumer_type = $request->input('consumer_type');
    		return view('noc.addNewConsumer',[
    			'consumers' => null,
    			'consumer_type' => $consumer_type
    		]);
    	}
    }

    public function registerNewConsumer(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		$consumer_type = $request->input('consumer_type');
			$circuit_id = $request->input('circuit_id');
		    $name = $request->input('name');
		    $address = $request->input('address');
			$area = $request->input('area');
			$city = $request->input('city');
			$state = $request->input('state');
			$contact_details = $request->input('contact_details');

			$consumer = new NocConsumer;
			$consumer->type = strtolower($consumer_type);
			$consumer->circuit_id = $circuit_id;
			$consumer->name = strtolower($name);
			$consumer->address = strtolower($address);
			$consumer->area = strtolower($area);
			$consumer->city = strtolower($city);
			$consumer->state = strtolower($state);
			$consumer->contact_details = strtolower($contact_details);

			if($consumer->save())
				return redirect('/addNewConsumer')->with('success', 'Successfully added new consumer');
			else
				return redirect('/addNewConsumer')->with('error', 'Something has gone wrong. Try again or contact developer');
    	}
    }

    public function listConsumer(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	else
    	{
    		$consumer_type = $request->input('consumer_type');
    		$consumers = NocConsumer::where('type', $consumer_type)->get();
    		
            if(count($consumers) == 0)
                return redirect('/addNewConsumer')->with('delete', 'Sorry no consumer!');
            else
                return view('noc.addNewConsumer',[
    			       'consumers' => $consumers,
    			       'consumer_type' => null
    		]);
    	}
    }
}
