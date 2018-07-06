<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Iklan;
use App\Category;


use App\Http\Controllers\Controller;

class ApiVIklanController extends Controller
{
    public function getFavourites(Request $request){
      $iklans = $request->user()->favouriteIklans()->firstOrFail();

      $response = [
        'iklans' => $iklan
      ];

      return response()->json($response, 200);
    }

    public function getCategory($id){


    }


    public function storeFavourites(Request $request, Iklan $iklan){
      $request->user()->favouriteIklans()->syncWithoutDetaching([$iklan->id]);

      $response = [
        'msg' => 'Ditambahkan ke favorit!',
      ];

      return response()->json($response, 200);
    }
}
