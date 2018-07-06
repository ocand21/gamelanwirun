<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;
use App\Role;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use Image;
use Auth;
use Storage;


class SellerController extends Controller
{

    public function __construct(){
      $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = DB::table('users')->select('users.*','roles.*','role_user.*')
                             ->join('role_user', 'users.id', '=', 'role_user.user_id')
                             ->join('roles', 'roles.id', '=', 'role_user.role_id')
                             ->where('role_user.role_id', '=', 2)
                             ->get();
        // $users = User::with('roles')->where('role_id', 2);
        return view('auth.admin.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('auth.admin.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'notelp' => 'required|string|max:12|unique:users',
          'password' => 'required|string|min:6|confirmed',
          'address' => 'required|min:10',
          'image' => 'image|mimes:jpeg,png,bmp',
          'store_name' => 'required|min:5',
          'store_description' => 'required|min:5',
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $notelp = $request->input('notelp');
        $address = $request->input('address');
        $password = $request->input('password');
        $store_name = $request->input('store_name');
        $store_description = $request->input('store_description');
        $image = $request->input('image');

        $user = User::create([
          'name' => $name,
          'email' => $email,
          'notelp' => $notelp,
          'image' => $image,
          'address' => $address,
          'store_name' => $store_name,
          'store_description' => $store_description,
          'password' => bcrypt($password)
        ]);
        $user
          ->roles()
          ->attach(Role::where('role_name', 'seller')->first());

          if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->save($location);

            $user->image = $filename;
          }

          $user->save();

          Session::flash('flash_message','Seller berhasil ditambahkan');

          return redirect()->route('seller.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
