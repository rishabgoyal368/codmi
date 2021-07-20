<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Validator;
use App\Models\User;
use App\Models\OnBoardSubmit;

class UserController extends Controller
{

    public function list()
    {
        $users = Admin::where('role','1')->get();
        return view('admin.users.list', compact('users'));
    }

    public function retails()
    {
        $users = Admin::where('role','2')->get();
        return view('admin.users.list', compact('users'));    
    }
}
