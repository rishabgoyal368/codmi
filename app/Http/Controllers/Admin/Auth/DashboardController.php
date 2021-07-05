<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth, Hash, Session, Mail;
use App\Models\Admin;

class DashboardController extends Controller
{

    public function dashboard()
    {
        return view('admin.index');
    }

    public function profile(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('admin.profile');
        } else {
            $data = $request->all();
            $data['id'] = Auth::guard('admin')->user()->id;
            $validator = Validator::make(
                $data,
                [
                    'email' => 'required|email|unique:admins,email,' . $data['id'],
                    'name' => 'required',
                    'profile_pic' => 'nullable|mimes:jpeg,jpg,png|max:10000'
                ]
            );

            if ($validator->fails()) {
                return back()->withInput($request->all())->withErrors($validator->errors());
            } else {
                if ($request->profile_pic) {
                    $profile_pic = $request->profile_pic->getClientOriginalName() . '_' . time() . '.' . $request->profile_pic->extension();
                    $request->profile_pic->move(public_path(Admin::PROFILEPATH), $profile_pic);
                } else {
                    $profile_pic = Auth::guard('admin')->user()->profile_pic;
                }
                Admin::where('id', $data['id'])->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'profile_pic' => $profile_pic,
                ]);
                return redirect('admin/')->with('success', "Your profile updated successfully");
            }
        }
    }
}
