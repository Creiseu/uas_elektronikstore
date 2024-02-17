<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if($user_role=Auth::user()->role){
            
            switch($user_role){
                case 1:
                    return redirect('/admin');
                    break;
                case 2:
                    return redirect('/manager');
                    break;
                case 3: 
                    return redirect('/csutomer');
                    break;
                case 4:
                    return redirect('/cashier');
                default:
                   Auth::logout();
                   return redirect('/login')->with('error','oops something went wrong');

            }

        }else{
            return redirect('login')->with('error','The credentials do not match our records');
        }
    }
}
