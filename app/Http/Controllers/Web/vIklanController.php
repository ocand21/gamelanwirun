<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Iklan;

use Session;


use App\Http\Controllers\Controller;


class vIklanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function getIndex(){
      $iklans = Iklan::with('photos')->orderBy('id', 'desc')->paginate(10);
      return view('viklan.index')->withIklans($iklans);
    }

    public function getSingle($url) {
    	$iklan = Iklan::with('users', 'photos', 'category')->where('url', '=', $url)->first();

    	return view('viklan.single')->withIklan($iklan);
    }


    public function store(Request $request, Iklan $iklan){

      $request->user()->favouriteIklans()->syncWithoutDetaching([$iklan->id]);
      Session::flash('flash_message','Ditambahkan ke favorit!');

      return back();
    }


    public function getFavourites(Request $request){
      $iklans = $request->user()->favouriteIklans()->paginate(5);

      return view('viklan.favourites', compact('iklans'));
    }

    public function destroyFavourites(Request $request, Iklan $iklan){
      $request->user()->favouriteIklans()->detach($iklan);
      Session::flash('flash_message','Dihapus dari daftar favorit!');

      return back();
    }

}
