<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ErrorController extends Controller
{
    public function getError(){
      return view('error.forbidden');
    }
}
