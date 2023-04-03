<?php

namespace App\Http\Middleware;

use App\Models\Users;
use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers;

class CheckLoginPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $email = session('email');
        $users = new Users();
        $status = $users->getUser($email)[0]->status;
        if(!empty($status)){
            if($status == 'on'){
                return $next($request);
            }
        }
        else{
            $messageForgot = 'Bạn chưa đăng nhập thành công';
            return redirect()->route('indexLogin')->with($messageForgot);
        }
        abort(403);
    }
}
