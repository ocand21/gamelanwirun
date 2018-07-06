<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Image;
use Auth;
use Session;
use Storage;
use Store;

use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{

    public function __construct(){
      $this->middleware('auth');
    }


    public function getProfile($id) {
      $profil = User::where('id', '=', $id)->first();
      return view('auth.profil.show')->withProfil($profil);
    }

    public function edit($id){
      $profil = User::where('id', '=', $id)->first();
      return view('auth.profil.edit')->withProfil($profil);
    }

    public function update(Request $request, $id){
      $profil = User::find($id);

      if ($request->input('email') == $profil->email) {
        $this->validate($request, array(
          'name' => 'required|string|max:255',
          'image' => 'image'
        ));
      } else if ($request->input('notelp') == $profil->notelp) {
        $this->validate($request, array(
          'name' => 'required|string|max:255',
          'image' => 'image'
        ));
      } else {
        $this->validate($request, array(
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'notelp' => 'required|string|max:12|unique:users',
          'address' => 'required|min:10',
          'image' => 'image'
        ));

      }
      $profil->name = $request->input('name');
      $profil->email = $request->input('email');
      $profil->notelp = $request->input('notelp');
      $profil->address = $request->input('address');
      $profil->store_name = $request->input('store_name');
      $profil->store_description = $request->input('store_description');

      if ($request->hasFile('image')) {
          //Gambar baru
          $image = $request->file('image');
          $filename = time() . '.' . $image->getClientOriginalName();
          $location = public_path('images/users/' . $filename);
          Image::make($image)->save($location);
          $oldFilename = $profil->image;

          //Simpan gambar baru
          $profil->image = $filename;
          //Hapus gambar lama
          Storage::delete($oldFilename);
      }

      $profil->save();

      Session::flash('flash_message','Profil berhasil diubah, silakan login kembali');

      return redirect()->back();

    }

    public function showChangePasswordForm(){
      return view('auth.profil.changepassword');
    }

    public function changePassword(Request $request){
      if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
          Session::flash('flash_error','Password lama yang Anda masukkan salah. Silakan coba lagi');
          return redirect()->back();
      }
      if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
        Session::flash('flash_error','Password baru tidak boleh sama dengan password lama. Silakan coba lagi');
        return redirect()->back();
      }

      $validatedData = $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|string|min:6|confirmed',
      ]);

      $user = Auth::user();
      $user->password = bcrypt($request->get('new_password'));
      $user->save();

      Session::flash('flash_message','Password berhasil diubah. Silakan login ulang');
      return redirect()->back();

    }


}
