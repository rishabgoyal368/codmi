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

    public function profile()
    {
        return view('admin.profile');
    }
 

}
