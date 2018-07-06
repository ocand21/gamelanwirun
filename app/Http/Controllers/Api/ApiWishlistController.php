<?php

namespace App\Http\Controllers\Api;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

use App\Iklan;
use App\Wishlist;
use App\User;


use App\Http\Controllers\Controller;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class ApiWishlistController extends Controller
{

    public function __construct(){
      $this->middleware('jwt.auth');
    }

    public function getAuthenticationUser(){
      try {
        if (!$user=JWTAuth::parseToken()->authenticate()) {
          return response()->json(['user_not_found'], 404);
        }
      } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
        return response()->json(['token_expired'], $e->getStatusCode());
      } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
        return response()->json(['token_invalid'], $e->getStatusCode());
      } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
        return response()->json(['token_absent'], $e->getStatusCode());
      }

      $response = [
        'user' => $user
      ];

      return response()->json($response, 200);

    }

    public function user(){
      return JWTAuth::toUser(JWTAuth::getToken());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = $this->user();
        $iklan = Iklan::get();
        $wishlists = DB::table('wishlists')
                      ->join('iklans', 'wishlists.iklan_id', '=', 'iklans.id')
                      ->join('users', 'iklans.user_id', '=', 'users.id')
                      ->where("wishlists.user_id", "=", "$user->id")
                      ->select('wishlists.created_at', 'wishlists.id', 'iklans.id as iklan_id', 'iklans.judul', 'iklans.image1', 'iklans.volume', 'iklans.harga', 'iklans.deskripsi', 'users.id as user_id', 'users.image as user_image', 'users.store_name')
                      ->get();

        foreach($wishlists as $wishlist){
          $wishlist->view_iklan = [
            'href' => '/api/v1/iklan/' . $wishlist->iklan_id,
            'method' => 'GET'
          ];
        }

        $response = [
          'msg' => 'List of Wishlists',
          'wishlists' => $wishlists
        ];

        return response()->json($response, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'user_id'=>'required',
          'iklan_id'=>'required',
        ]);

        $wishlist = new Wishlist;

        $wishlist->user_id = $request->user_id;
        $wishlist->iklan_id = $request->iklan_id;

        if ($wishlist->save()) {
          $message = [
            'msg' => 'Added to your Wishlist',
          ];

          return response()->json($message, 201);
        }

        $response = [
          'msg' => 'Cannot add to your Wishlist',
        ];

        return response()->json($message, 404);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wishlist = Wishlist::findOrFail($id);
        $wishlist->delete();

        $response = [
          'msg' => 'Item successfully deleted',
        ];

        return response()->json($response, 200);
    }

}
