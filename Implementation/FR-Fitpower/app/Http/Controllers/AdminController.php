<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }
    
    public function subsDash()
    {
        return view('admin.subscriptions');
    }
    
    public function authenticate(Request $request)
    {
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($formFields)) {
            return redirect()->route('Admin - Orders');
        }
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('login_admin');
    }
}
