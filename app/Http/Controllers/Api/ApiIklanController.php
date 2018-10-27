<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Http\Controllers\Controller;
use App\Iklan;
use App\User;
use App\IklansPhoto;

use JWTAuth;

use Image;
use Storage;

class ApiIklanController extends Controller
{

    public function __construct(){
      $this->middleware('jwt.auth',[
        'except' => ['index', 'show', 'viewCount', 'contactCount', 'getPhotos']
      ]);
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
      $iklans = DB::table('iklans')->select('iklans.id', 'iklans.judul', 'iklans.volume', 'iklans.harga', 'iklans_photos.filename', 'iklans.created_at', 'users.id as user_id', 'users.image as user_image', 'users.store_name')
                ->join('iklans_photos', 'iklans.id', '=', 'iklans_photos.iklan_id')
                ->join('users', 'iklans.user_id', '=', 'users.id')
                ->groupBy('iklans.id')->orderBy('iklans.id', 'desc')
                ->get();

      // $iklans = Iklan::with('users')->get();
        $response = [
            'iklan' => $iklans
        ];

        return response()->json($response, 200);
    }

    public function myIklans(){
      $id = $this->user()->id;

      $iklans = DB::table('iklans')->select('iklans.id', 'iklans.judul', 'iklans.image1', 'iklans.volume', 'iklans.harga', 'iklans.created_at', 'users.id as user_id', 'users.image as user_image', 'users.store_name')
                ->join('users', 'iklans.user_id', '=', 'users.id')
                ->where('iklans.user_id', '=', $id)
                ->groupBy('iklans.id')->orderBy('iklans.id', 'desc')
                ->get();

      $response = [
        'my_iklan' => $iklans
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
            'judul' => 'required|max:255',
            'url' => 'required|alpha_dash|min:5|max:255',
            'lokasi' => 'required',
            'user_id' => 'required',
            'photos' => 'required|array',
            'photos.*' => 'required|image|mimes:jpeg,png,bmp'
        ]);

        $iklan = Iklan::create($request->all());

        $files = $request->file('photos');

        if ($files[0] != '') {
          foreach ($files as $file) {
            $filename = time() . '.' . $file->getClientOriginalName();
            $location = public_path('images/' . $filename);
            Image::make($file)->save($location);

            $iklanPhotos = IklansPhoto::create([
              'iklan_id' => $iklan->id,
              'filename' => $filename
            ]);

          }
        }


       if ($iklan->save()) {
         $message = [
          'iklan' => $iklan,
          'photos' => $iklanPhotos
         ];

            return response()->json($message, 201);
      }


        $response = [
            'msg' => 'Gagal Menerbitkan Iklan',
        ];

        return response()->json($message, 404);

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function show($id)
    {
        // $iklan = Iklan::with('users', 'photos', 'category')->where('id', $id)->firstOrFail();
        // $photos = DB::table('iklans_photos')->select('iklans_photos.id', 'iklans_photos.filename', 'iklans_photos.iklan_id', 'iklans.id')
        //               ->join('iklans', 'iklans_photos.iklan_id', '=', 'iklans.id')
        //               ->where('iklans_photos.iklan_id', '=', $id)
        //               ->groupBy('iklans_photos.id')->get();
        //





        // if (!$this->user()) {
          $iklan = Iklan::with('photos', 'users')->where('id', $id)->firstOrFail();

          $iklan->view_iklan = [
              'href' => 'api/v1/iklan',
              'method' => 'GET'
          ];

          $response = [
              'msg' => 'Informasi Iklan',
              'iklan' => $iklan
          ];

        // } else {

        // }



        // $iklan = DB::table('iklans')->select('iklans.*','iklans_photos.filename', 'iklans_photos.iklan_id','users.id as user_id', 'users.image as user_image', 'users.name')
        //           ->join('users', 'iklans.user_id', '=', 'users.id')
        //           ->join('iklans_photos', 'iklans_photos.iklan_id', '=', 'iklans.id')
        //           ->where('iklans.id', '=', $id)
        //           ->groupBy('iklans.id')->orderBy('iklans.id', 'desc')
        //           ->get();


        // $iklans = DB::table('iklans')->select('iklans.*','users.id as user_id', 'users.image as user_image', 'users.name')
        //                   ->join('users', 'iklans.user_id', '=', 'users.id')
        //                   ->where('iklans.id', '=', $id)
        //                   ->groupBy('iklans.id')->orderBy('iklans.id', 'desc')
        //                   ->get();



        return response()->json($response, 200);
    }

    public function showIn($id){
      $iklan = Iklan::with('photos', 'users')->where('id', $id)->firstOrFail();
      $user_id = $this->user()->id;
      $wishlists = DB::table('wishlists')
                    ->where("wishlists.iklan_id", "=", $id)
                    ->where("wishlists.user_id", "=", $user_id)
                    ->select('wishlists.id', 'wishlists.iklan_id')
                    ->get();

                  $iklan->view_iklan = [
                        'href' => 'api/v1/iklan',
                        'method' => 'GET'
                    ];

                    $response = [
                        'msg' => 'Informasi Iklan',
                        'iklan' => $iklan,
                        'wishlists' => $wishlists,
                    ];

      return response()->json($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function viewCount(Request $request, $id)
    {

      $iklan = Iklan::find($id);

      $iklan->increment('view_count');

      if ($iklan->update()) {
        $message = [
          'msg' => 'countview bertambah'
        ];
        return response()->json($message, 201);
      }

      $response = [
        'msg' => 'Tidak dapat menambah countview',
      ];
      return response()->json($message, 404);

    }

    public function contactCount(Request $request, $id){
      $iklan = Iklan::find($id);

      $iklan->increment('contact_count');

      if ($iklan->update()) {
        $message = [
          'msg' => 'Total dihubungi bertambah'
        ];
        return response()->json($message, 201);
      }

      $response = [
        'msg' => 'Gagal menambah total dihubungi',
      ];
      return response()->json($message, 404);
    }


    public function update(Request $request, $id)
    {
        $iklan = Iklan::find($id);

            $this->validate($request, [
                'judul' => 'required|max:255',
                'url' => "required|alpha_dash|min:5|max:255|unique:iklans,url,$id",
                'lokasi' => 'required',
            ]);

        $iklan->judul = $request->input('judul');
        $iklan->url = $request->input('url');
        $iklan->jenis = $request->input('jenis');
        $iklan->lokasi = $request->input('lokasi');
        $iklan->harga = $request->input('harga');
        $iklan->deskripsi = $request->input('deskripsi');
        $iklan->image = $request->input('image');
        $iklan->user_id = $request->input('user_id');

        if ($request->hasFile('image')) {
            //Gambar baru
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('images/' . $filename);
            Image::make($image)->save($location);
            $oldFilename = $iklan->image;

            //Simpan gambar baru
            $iklan->image = $filename;
            //Hapus gambar lama
            Storage::delete($oldFilename);
        }

        if (!$iklan->update()) {
            return response()->json([
                'msg' => 'Gagal memperbaharui iklan'
            ], 404);
        }


        $response = [
            'iklan' => $iklan
        ];

        return response()->json($response, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $iklan = Iklan::find($id);
      Storage::delete($iklan->image);

      $iklan->delete();





    }

    public function getPhotos(){
      $photos = IklansPhoto::get();

      $response = [
              'msg' => 'Informasi Iklan',
              'photos' => $photos
      ];

      return response()->json($response, 200);

    }

}
