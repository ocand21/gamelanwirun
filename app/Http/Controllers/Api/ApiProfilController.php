<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\User;
use Image;
use Storage;


use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;

use JWTAuth;

class ApiProfilController extends Controller
{
    public function __construct(){
      $this->middleware('jwt.auth',[
        'except' => ['publicProfile']
      ]);
    }

    public function user(){
      return JWTAuth::toUser(JWTAuth::getToken());
    }

    public function publicProfile($id){
      $user = User::with('iklans')->where('id', $id)->firstOrFail();

      $response = [
        'msg' => 'Informasi User',
        'user' => $user
      ];

      return response()->json($response, 200);

    }

    public function getProfile(Request $request){
      $profil = $this->user();
      $profil->view_user = [
        'href' => 'api/v1/user',
        'method' => 'GET'
      ];

      $response = [
        'msg' => 'Profil Pengguna',
        'profil' => $profil
      ];

      return response()->json($response, 200);
    }


    public function editProfile(Request $request)
    {
      $user = $this->user();

      if ($request->input('email') == $user->email) {
        $this->validate($request, [
          'name' => 'required|string|max:255',
          'address' => 'required|string|min:5',
          'image' => 'image'
        ]);
      } else if ($request->input('notelp') == $user->notelp) {
        $this->validate($request, [
          'name' => 'required|string|max:255',
          'image' => 'image',
          'address' => 'required|string|min:5',
        ]);
      } else {
        $this->validate($request, [
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'notelp' => 'required|string|max:12|unique:users',
          'address' => 'required|string|min:5',
          'image' => 'image'
        ]);
      }

      $user->name = $request->get('name');
      $user->email = $request->get('email');
      $user->notelp = $request->get('notelp');
      $user->address = $request->get('address');

      if ($request->hasFile('image')) {
          $image = $request->file('image');
          $filename = time() . '.' . $image->getClientOriginalName();
          $location = public_path('images/users/' . $filename);
          Image::make($image)->save($location);
          $oldFilename = $user->image;

          $user->image = $filename;
          Storage::delete($oldFilename);
      }

      if (!$user->save()) {
        return response()->json([
          'msg' => 'Gagal mengubah profil'
        ], 404);
      }

      $user->view_profil = [
        'msg' => 'api/v1/user/myprofile' . $user->id,
        'method' => 'GET'
      ];

      $response = [
        'msg' => 'Profil berhasil dirubah',
        'user' => $user
      ];

      return response()->json($response, 200);
    }

    public function changePassword(Request $request){
      $user = $this->user();

      if (!(Hash::check($request->get('current_password'), $user->password))) {
        $response = [
            'msg' => 'Password lama yang Anda masukkan salah. Silakan coba lagi',
        ];
        return response()->json($response, 404);
      }
      if (strcmp($request->get('current_password'), $request->get('new_password')) == 0) {
        $response = [
            'msg' => 'Password baru tidak boleh sama dengan password lama. Silakan coba lagi',
        ];
        return response()->json($response, 404);
      }

      $validatedData = $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|string|min:6|confirmed',
      ]);

      $user->password = bcrypt($request->get('new_password'));
      $user->save();

      $response = [
        'msg' => 'Password berhasil diubah',
        'new_password' => $user->password
      ];

      return response()->json($response, 200);

    }

}
