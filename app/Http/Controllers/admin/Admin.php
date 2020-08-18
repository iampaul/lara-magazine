<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Admin_model;
use App\Models\user;
use App\Models\Magazine_model;
use Session;
use View;
use Redirect;
use Validator;
use Response;

class Admin extends Controller
{
    public function __construct()
    {
        $this->outputData = array();        
    }

    public function getLogin()
    {
        if(Auth::guard('admin')->check())
        {
            return redirect('admin/home');
        }	

        return view('admin.auth.login',$this->outputData);
    }

    public function postLogin(Request $request)
    {    
        $input_data = $request->all();
        
        //Check Valiation
        $validator = Validator::make( $input_data, Admin_model::$rules['login'] );
		if ( $validator->fails() ) { 

			$messages = $validator->messages(); 

            foreach ($messages->all() as $message)
            {
                Toastr::error($message,'',["timeOut" => 10000]);
            }    

            return redirect()->back()->withInput();
		}

         if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) 
         {
            return redirect('admin')->withInput();
         }   

         Toastr::error('Invalid Credentials','',["timeOut" => 10000]);
         return redirect()->back()->withInput();
    }

    public function getDashboard()
    {

        $this->outputData['user_count'] = User::count();
        $this->outputData['magazine_count'] = Magazine_model::count();
        return view('admin.dashboard',$this->outputData);
    }

    public function getLogout()
    {
    	if(Auth::guard('admin')->check())
    	{
    		Auth::guard('admin')->logout();

    		return redirect('admin/login');
    	}	
    }

}    