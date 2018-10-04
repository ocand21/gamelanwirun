<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

class IklanController extends Controller
{
    public function __construct(){
      $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->user()->roles(['seller']);
        $id = Auth::user()->id;

        $iklans = Iklan::with('users')->where('user_id', $id)->orderBy('id', 'desc')->paginate(10);
        return view('auth.iklans.index')->withIklans($iklans);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

        $user = User::all();
        $categories = Category::all();
        return view('auth.iklans.create', compact('user', 'categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi data
        $this->validate($request, array(
            'judul' => 'required|max:255',
            'user_id' => 'required',
            'harga' => 'required',
            'photos' => 'required|array',
            'photos.*' => 'required|image|mimes:jpeg,bmp,png',
        ));

        $iklan = new Iklan;
        $iklan->judul = $request->input('judul');
        $iklan->user_id = $request->input('user_id');
        $iklan->category_id = $request->input('category_id');
        $iklan->url = str_slug($request->input('judul'));
        $iklan->deskripsi = $request->input('deskripsi');
        $iklan->volume = $request->input('volume');
        $iklan->harga = $request->input('harga');
        $iklan->stock = $request->input('stock');


        $iklan->save();

        $files = $request->file('photos');

        if ($files[0] !='') {
          foreach($files as $file) {
            $filename = time() . '.' . $file->getClientOriginalName();
            $location = public_path('images/iklans/' . $filename);
            Image::make($file)->save($location);

            IklansPhoto::create([
              'iklan_id' => $iklan->id,
              'filename' => $filename
            ]);
          }
        }

        // $iklan->image1 = $request->input('image1');
        // $iklan->image2 = $request->input('image2');
        // $iklan->image3 = $request->input('image3');
        // $iklan->image4 = $request->input('image4');
        // $iklan->image5 = $request->input('image5');

        // if ($request->hasFile('image1')) {
        //   $image1 = $request->file('image1');
        //   $filename = time() . '.' . $image1->getClientOriginalName();
        //   $location = public_path('images/iklans/' . $filename);
        //   Image::make($image1)->save($location);
        //   $iklan->image1 = $filename;
        // }
        //
        // if ($request->hasFile('image2')) {
        //   $image2 = $request->file('image2');
        //   $filename = time() . '.' . $image2->getClientOriginalName();
        //   $location = public_path('images/iklans/' . $filename);
        //   Image::make($image2)->save($location);
        //   $iklan->image2 = $filename;
        // } else {
        //   $iklan->image2 = 'logo.png';
        // }
        //
        // if ($request->hasFile('image3')) {
        //   $image3 = $request->file('image3');
        //   $filename = time() . '.' . $image3->getClientOriginalName();
        //   $location = public_path('images/iklans/' . $filename);
        //   Image::make($image3)->save($location);
        //   $iklan->image3 = $filename;
        // } else {
        //   $iklan->image3 = 'logo.png';
        // }
        //
        // if ($request->hasFile('image4')) {
        //   $image4 = $request->file('image4');
        //   $filename = time() . '.' . $image4->getClientOriginalName();
        //   $location = public_path('images/iklans/' . $filename);
        //   Image::make($image4)->save($location);
        //   $iklan->image4 = $filename;
        // } else {
        //   $iklan->image4 = 'logo.png';
        // }
        //
        // if ($request->hasFile('image5')) {
        //   $image5 = $request->file('image5');
        //   $filename = time() . '.' . $image5->getClientOriginalName();
        //   $location = public_path('images/iklans/' . $filename);
        //   Image::make($image5)->save($location);
        //   $iklan->image5 = $filename;
        // } else {
        //   $iklan->image4 = 'logo.png';
        // }

        Session::flash('flash_message','Iklan berhasil diterbitkan!');

        return redirect()->route('iklans.show', $iklan->id);
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
        $iklan = Iklan::with('users', 'category', 'photos')->where('id', $id)->firstOrFail();
        // $photos = DB::table('iklans_photos')->select('iklans_photos.id', 'iklans_photos.filename', 'iklans_photos.iklan_id', 'iklans.id')
        //               ->join('iklans', 'iklans_photos.iklan_id', '=', 'iklans.id')
        //               ->where('iklans_photos.iklan_id', '=', $id)
        //               ->groupBy('iklans_photos.id')->get();

        // Event::fire('iklans.view', $iklan);

        return view('auth.iklans.show', compact('iklan'));
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
        $categories = Category::all();
        $iklan = Iklan::with('users', 'category')->find($id);
        // $photos = IklansPhoto::where('iklan_id', $id)->get();
        // $photos = DB::table('iklans_photos')->select('iklans_photos.id', 'iklans_photos.filename', 'iklans_photos.iklan_id', 'iklans.id')
        //               ->join('iklans', 'iklans_photos.iklan_id', '=', 'iklans.id')
        //               ->where('iklans_photos.iklan_id', '=', $id)
        //               ->groupBy('iklans_photos.id')->get();

        return view('auth.iklans.edit', compact('iklan', 'categories'));
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
        // validasi data
        $iklan = Iklan::with('users', 'category')->find($id);

        $this->validate($request, array(
          'judul' => 'required|max:255',
          'url' => "alpha_dash|min:5|max:255|unique:iklans,url,$id",
          'image1' => 'image|mimes:jpeg,bmp,png',
          'image2' => 'image|mimes:jpeg,bmp,png',
          'image3' => 'image|mimes:jpeg,bmp,png',
          'image4' => 'image|mimes:jpeg,bmp,png',
          'image5' => 'image|mimes:jpeg,bmp,png',
        ));

        $iklan->judul = $request->input('judul');
        $iklan->url = str_slug($request->input('judul'));
        $iklan->volume = $request->input('volume');
        $iklan->stock = $request->input('stock');
        $iklan->harga = $request->input('harga');
        $iklan->deskripsi = $request->input('deskripsi');
        $iklan->user_id = $request->user_id;
        $iklan->category_id = $request->input('category_id');

        if ($request->hasFile('image1')) {
          $image1 = $request->file('image1');
          $filename = time() . '.' . $image1->getClientOriginalName();
          $location = public_path('images/iklans/' . $filename);
          Image::make($image1)->save($location);
          $oldFilename = $iklan->image1;

          $iklan->image1 = $filename;
          Storage::delete($oldFilename);
        }

        if ($request->hasFile('image2')) {
          $image2 = $request->file('image2');
          $filename = time() . '.' . $image2->getClientOriginalName();
          $location = public_path('images/iklans/' . $filename);
          Image::make($image2)->save($location);
          $oldFilename = $iklan->image2;

          $iklan->image2 = $filename;

          Storage::delete($oldFilename);
        }

        if ($request->hasFile('image3')) {
          $image3 = $request->file('image3');
          $filename = time() . '.' . $image3->getClientOriginalName();
          $location = public_path('images/iklans/' . $filename);
          Image::make($image3)->save($location);
          $oldFilename = $iklan->image3;
          Storage::delete($oldFilename);

          $iklan->image3 = $filename;

          Storage::delete($oldFilename);
        }

        if ($request->hasFile('image4')) {
          $image4 = $request->file('image4');
          $filename = time() . '.' . $image4->getClientOriginalName();
          $location = public_path('images/iklans/' . $filename);
          Image::make($image4)->save($location);
          $oldFilename = $iklan->image4;
          Storage::delete($oldFilename);

          $iklan->image4 = $filename;

          Storage::delete($oldFilename);
        }

        if ($request->hasFile('image5')) {
          $image5 = $request->file('image5');
          $filename = time() . '.' . $image5->getClientOriginalName();
          $location = public_path('images/iklans/' . $filename);
          Image::make($image5)->save($location);
          $oldFilename = $iklan->image5;
          Storage::delete($oldFilename);

          $iklan->image5 = $filename;

          Storage::delete($oldFilename);
        }



        $iklan->save();

        Session::flash('flash_message','Iklan berhasil diperbarui!');

        return redirect()->route('iklans.show', $iklan->id);

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
        $iklan = Iklan::find($id);

        $photos = IklansPhoto::where('iklan_id', $id)->get();
        foreach ($photos as $photo) {
          Storage::delete($photo->filename);
          $photo->delete();
        }

        $iklan->delete();

        Session::flash('flash_message','Iklan berhasil dihapus!');
        return redirect()->route('iklans.index');
    }
}
