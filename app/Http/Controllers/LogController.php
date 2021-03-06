<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use Redirect;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class LogController extends Controller
{


    public function store(LoginRequest $request)
    {

       if(Auth::attempt(['email'=>$request['email'],'password' => $request['password']])){
           return redirect('home');
       }

        return Redirect::to('auth/login');
    }

    public function logout(){
        Auth::logout();
        return Redirect::to('auth/login');
    }
}
