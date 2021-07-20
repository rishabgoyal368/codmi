<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use App\Models\Role;

use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('admin')->user();
        if (empty($user)) {
            return redirect('admin');
        }

        if ($user->role == '2') {
            $role = 'USER';
        } else if ($user->role == '3') {
            $role = 'RELATILOR';
        }

        if ($user->role == 0) {   //Allow all for Super Admin
            return $next($request);
        }

        $role = Role::where('name', $role)->first();

        $a = $request->segment(2);
        $permission = unserialize($role->permissions);

        // echo '<pre>';
        // print_r($a);die;
        if ($request->ajax() || isset($permission[$a])) {
            return $next($request);
        }
        return redirect('/');
    }
}
