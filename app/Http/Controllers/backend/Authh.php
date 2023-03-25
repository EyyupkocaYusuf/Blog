<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;

class Authh extends Controller
{
    public  function login()
    {
        return view('backend.auth.login');
    }
    public  function loginPost(Request $request)
    {
        if(Auth::attempt(['email'=>$request->email, 'password' => $request->password]))
        {
            toastr()->success('Data has been saved successfully!', 'Congrats');
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->withErrors('Mail veya Şifre hatalı');
    }

    public  function logOut()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
