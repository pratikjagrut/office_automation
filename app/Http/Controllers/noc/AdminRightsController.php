<?php

namespace App\Http\Controllers\noc;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminRightsController extends Controller
{
    public function index()
    {
    	if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $admins = User::where('user_type', 'admin')->get();
            return view('noc.admin_pages.adminRights')->with('admins', $admins);
        }
    }

    public function grantAdminRights(Request $request)
    {
    	if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
        	$password = $request->input('password');
        	$employee_id = $request->input('employee_id');
        	if(Hash::check($password, auth()->user()->password))
        	{
                $user = User::find(DB::table('users')->where('employee_id', $employee_id)->value('id'));
                $user->user_type = 'admin';
                $user->save();
        		return redirect('/adminRights')->with('success', 'Admin Rights Granted');
        	}
        }
    }

    public function removeAdminRights(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $password = $request->input('password');
            $employee_id = $request->input('employee_id');
            if(Hash::check($password, auth()->user()->password))
            {
                $user = User::find(DB::table('users')->where('employee_id', $employee_id)->value('id'));
                $user->user_type = 'user';
                $user->save();
                return redirect('/adminRights')->with('delete', 'Admin Rights Removed');
            }
            else
                return redirect('/adminRights')->with('error', 'Password is incorrect');   
        }
    }

    public function deleteAccount(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $password = $request->input('password');
            $employee_id = $request->input('employee_id');
            if(Hash::check($password, auth()->user()->password))
            {
                if(DB::table('users')->where('employee_id', $employee_id)->delete() && 
                   DB::table('profiles')->where('employee_id', $employee_id)->delete())
                    return redirect('/adminRights')->with('delete', 'Account Deleted');
                else
                    return redirect('/adminRights')->with('error', 'Something went wrong or employee id does not exists');    
            }
        }
    }

    public function listAdmins()
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login first');
        else
        {
            ;
        }    
    }
}
