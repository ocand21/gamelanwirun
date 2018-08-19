<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Http\Controllers\Controller;
use App\User;
use App\Iklan;
use App\Role;
use Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('admin')) {
          $users = DB::table('users')->select('users.*','roles.*','role_user.*')
                               ->join('role_user', 'users.id', '=', 'role_user.user_id')
                               ->join('roles', 'roles.id', '=', 'role_user.role_id')
                               ->where('role_user.role_id', '=', 2)
                               ->count();
          $iklans = Iklan::count();
        } else {
          $users = DB::table('users')->select('users.*','roles.*','role_user.*')
                               ->join('role_user', 'users.id', '=', 'role_user.user_id')
                               ->join('roles', 'roles.id', '=', 'role_user.role_id')
                               ->where('role_user.role_id', '=', 3)
                               ->count();

          $id = Auth::user()->id;
          $iklans = Iklan::with('users')->where('user_id', $id)->count();
        }
        return view('home', compact('users', 'iklans'));
    }
}
