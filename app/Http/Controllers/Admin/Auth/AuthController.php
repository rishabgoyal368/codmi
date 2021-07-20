<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth, Hash, Session, Mail;
use App\Models\Admin;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            return redirect('/admin/dashboard');
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make(
                $data,
                [
                    'email' => 'required|email|exists:admins,email',
                    'password' =>  'required',
                ]
            );

            if ($validator->fails()) {
                return back()->withInput($request->all())->withErrors($validator->errors());
            } else {
                $credentials = array(
                    'email' => $data['email'],
                    'password' => $data['password']
                );
                if (Auth::guard('admin')->attempt($credentials)) {
                    $admin = Auth::guard('admin')->user()->name;
                    return redirect('admin/dashboard')->with(
                        'success',
                        'Welcome Back ' . ucfirst($admin)
                    );
                } else {
                    return redirect()->back()->with('error', "You have entered wrong email or password");
                }
            }
        }

        return view('admin.auth.login');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        Session::flush();
        return redirect('admin')->with('success', 'You logged out successfully');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('admin.auth.register');
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            $validator = Validator::make(
                $data,
                [
                    'email' => 'required|email|unique:admins,email',
                    'password' =>  'required',
                    'role' =>  'required',
                ]
            );
            if ($validator->fails()) {
                return back()->withInput($request->all())->withErrors($validator->errors());
            } else {
                Admin::create([
                    'name' => $data['name'] ?? '',
                    'email' => $data['email'],
                    'password' => $data['password'] ? Hash::make($request['password']) : '',
                    'profile_pic' => '',
                    'role' => $data['role'],
                ]);
                return redirect('/')->with('success', "User Register successfully");
            }
        }
    }
}
