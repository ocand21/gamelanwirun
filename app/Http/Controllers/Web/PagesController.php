<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;

class PagesController extends Controller {

	public function getIndex(){
		return view('pages/welcome');
	}

}
