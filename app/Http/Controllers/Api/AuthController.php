<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\User;
use App\Role;


use App\Http\Controllers\Controller;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function store(Request $request){
        $this->validate($request, [
          'name' => 'required|string|max:255',
          'email' => 'required|string|email|max:255|unique:users',
          'notelp' => 'required|string|max:12|unique:users',
          'password' => 'required|string|min:6',
          ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $notelp = $request->input('notelp');
        $password = $request->input('password');

        $user = User::create([
          'name' => $name,
          'email' => $email,
          'notelp' => $notelp,
          'password' => bcrypt($password)
        ]);
        $user
          ->roles()
          ->attach(Role::where('role_name', 'customer')->first());

        $credentials = [
          'email' => $email,
          'password' => $password
        ];

        if ($user->save()) {

            $token = null;
            try {
              if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                  'msg' => 'Email atau Password salah',
                ], 404);
              }
            } catch (JWTAuthException $e) {
              return response()->json([
                'msg' => 'failed_to_create_token',
              ], 400);
            }


            $user->signin = [
              'href' => 'api/v1/user/signin',
              'method' => 'POST',
              'params' => 'email, password'
            ];

            $response = [
              'msg' => 'Registrasi berhasil',
              'user' => $user,
              'token' => $token
            ];

            return response()->json($response, 201);
        }

        $response = [
          'msg' => 'Gagal registrasi'
        ];

        return response()->json($response, 404);
    }

    public function signin(Request $request){
      $this->validate($request, [
        'email' => 'required|email',
        'password' => 'required|min:5'
      ]);

      $email = $request->input('email');
      $password = $request->input('password');

      if ($user = User::with('roles')->where('email', $email)->first()) {
          $credentials = [
            'email' => $email,
            'password' => $password
          ];

          $token = null;
          try {
            if (!$token = JWTAuth::attempt($credentials)) {
              return response()->json([
                'msg' => 'Email atau Password salah',
              ], 404);
            }
          } catch (JWTAuthException $e) {
            return response()->json([
              'msg' => 'failed_to_create_token',
            ], 400);
          }

          $response = [
            'msg' => 'User berhasil login',
            'user' => $user,
            'token' => $token
          ];

          return response()->json($response, 201);
      }

      $response = [
        'msg' => 'Login gagal'
      ];

      return response()->json($response, 404);

    }
}
