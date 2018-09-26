<?php

namespace App\Http\Middleware\Permission;

use Closure;
use Auth;
use App\Models\Admin;

class CheckHomestayPermission
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
        $arr_permiss = @unserialize( Auth::guard('admin')->user()->permiss ) ?? [] ;

        if( in_array( Admin::ADMIN_PERMISSION, $arr_permiss) ) {
            return $next($request);
        }else{
            return redirect('admin')->with('error','Bạn không có quyền truy cập');
        }
    }
}
