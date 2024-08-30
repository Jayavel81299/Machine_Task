<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::check()) {
                $roles = Auth::user()->role;
                $currentRouteName = $request->route()->getName(); 
        
                if (!RoleChecking($roles, $currentRouteName)) {
                    return redirect('/'); 
                }
            } else {
                return redirect('/'); 
            }
        
            return $next($request);
        });
        
        
    }
}
