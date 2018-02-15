<?php

namespace App\Http\Controllers\super_admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class SuperAdminController extends Controller
{
    public function index()
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	elseif(auth()->user()->user_type == 'super admin')
    		return view('super_admin.dashboard');
    	else
    		return redirect('/home')->with('error', 'Unauthorized access');
    }

    public function userList(Request $request)
    {
    	if(Auth::guest())
    		return redirect('/login')->with('error', 'Login First');
    	elseif(auth()->user()->user_type == 'super admin')
    	{	
    		
    		$users = User::all();
    		return view('super_admin.userList')->with('users', $users);
    	}
    	else
    		return redirect('/home')->with('error', 'Unauthorized access');
    }
}
