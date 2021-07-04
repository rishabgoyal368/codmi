<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\User;

class UserController extends Controller
{

    public function list()
    {
        $users = User::all();
        return view('admin.users.list', compact('users'));
    }

    public function edit(Request $request, $id = null)
    {
        if ($request->isMethod('GET')) {
            if ($id) {
                $user = User::findorfail($id);
                return view('admin.users.edit', compact('user'));
            }
        } else if ($request->isMethod('POST')) {
            $data = $request->all();
            $validator = Validator::make(
                $data,
                [
                    'email' => 'required|email|unique:users,email,' . $data['id'],
                    'name' => 'required',
                    'mobile_number' =>  'nullable|numeric',
                    'status' => 'required|in:' . User::PENDINGSTATUS . ',' . User::ACTIVESTATUS
                ]
            );

            if ($validator->fails()) {
                return back()->withInput($request->all())->withErrors($validator->errors());
            } else {
                $user = User::where('id', $data['id'])->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'mobile_number' => $data['mobile_number'],
                    'status' => $data['status']
                ]);
                return redirect('admin/manage-users')->with('success', "User updated successfully");
            }
        }
    }

    public function changeStatus(Request $request)
    {
        $id = $request->id;
        $status = $request->status == User::PENDINGSTATUS ? User::ACTIVESTATUS : User::PENDINGSTATUS;
        User::where('id', $id)->update([
            'status' => $status
        ]);
        return response()->json(['message' => 'User Status changed', 'code' => 200]);
    }
}
