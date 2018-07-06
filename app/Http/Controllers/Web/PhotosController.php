<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Iklan;
use App\User;
use App\Category;
use App\IklansPhoto;

use Session;
use Image;
use Auth;
use Storage;

class PhotosController extends Controller
{


    public function delImage2($id){
      $iklan = Iklan::find($id);
      Storage::delete($iklan->image2);

      $iklan->image2 = null;
      $iklan->save();

      Session::flash('flash_message','Foto berhasil dihapus!');

      return back();
    }


    public function delImage3($id){
      $iklan = Iklan::find($id);
      Storage::delete($iklan->image3);

      $iklan->image3 = null;
      $iklan->save();

      Session::flash('flash_message','Foto berhasil dihapus!');

      return back();
    }

    public function delImage4($id){
      $iklan = Iklan::find($id);
      Storage::delete($iklan->image4);

      $iklan->image4 = null;
      $iklan->save();

      Session::flash('flash_message','Foto berhasil dihapus!');

      return back();
    }

    public function delImage5($id){
      $iklan = Iklan::find($id);
      Storage::delete($iklan->image5);

      $iklan->image5 = null;
      $iklan->save();

      Session::flash('flash_message','Foto berhasil dihapus!');

      return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $photo = IklansPhoto::find($id);
        // Storage::delete($photo->filename);
        //
        // $photo->delete();
        //
        // Session::flash('flash_message','Foto berhasil dihapus!');
        // return back();

    }
}
