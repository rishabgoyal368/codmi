<?php

use Illuminate\Support\Facades\Auth;

function is_show($type)
{
    if(Auth::guard('admin')->user()->role == '0')
    {
        return 'true';
    }
    else{
        return 'false';
    }
}
