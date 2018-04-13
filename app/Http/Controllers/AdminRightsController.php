<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Profile;
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
            if(auth()->user()->user_type != 'admin')
                return redirect('/newJobEntry')->with('error', 'Unauthorised Access!');
            else
           {    
                $users = User::all();
                $admins = User::where('user_type', 'admin')->get();
                return view('adminRights', [
                                                                'admins' => $admins,
                                                                'users' => $users
                                                           ]);
            }
        }
    }

    //Admin or Hod rights
    public function performAdminRights(Request $request)
    {
        if(Auth::guest())
             return redirect('/login')->with('error', 'Login First');
        else
        {
            $password = $request->input('password');
            $employee_id = $request->input('employee_id');
            if(Hash::check($password, auth()->user()->password))
            {
                //Assign admin rights
                if($request->input('action') == 'assignAdminRights')
                {
                    $user = User::where('employee_id', $employee_id)->first();
                    $user->user_type = 'admin';
                    $user->save();
                    return redirect('/adminRights')->with('success', 'Admin Rights Granted');
                }
                //Remove admin rights
                elseif($request->input('action') == 'removeAdminRights')
                {
                    $user = User::where('employee_id', $employee_id)->first();
                    $user->user_type = 'user';
                    $user->save();
                    return redirect('/adminRights')->with('delete', 'Admin Rights Removed');
                }
                //Delete Account
                else
                {
                    if(User::where('employee_id', $employee_id)->delete())
                    {
                        if(Profile::where('employee_id', $employee_id)->delete())
                            return redirect('/adminRights')->with('delete', 'Account Deleted.');
                        else
                           return redirect('/adminRights')->with('error', 'Users profile does not exist.'); 
                    }
                    else
                        return redirect('/adminRights')->with('error', 'User does not exists.');
                }
            }   
        }   
    }

    public function changeEmployeePswd(Request $request)
    {
        if(Auth::guest())
            return redirect('/login')->with('error', 'Login First');
        else
        {
            $employee_id = $request->input('employee_id');
            $new_password = $request->input('new_password');
            $employee = User::where('employee_id', $employee_id)->first();
            $employee->password = Hash::make($new_password);
            
            if($employee->save())
                return redirect('/adminRights')->with('success', 'Password Changed.');
            else
                return redirect('/adminRights')->with('error', 'something went wrong');
        }
    }    
}
