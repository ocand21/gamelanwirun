<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Category;
use App\Iklan;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

class ApiCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
          $category->view_category = [
            'href' => '/api/v1/category/' . $category->id,
            'method' => 'GET'
          ];
        }

        $response = [
          'msg' => 'Daftar Kategori',
          'Category' => $categories,
        ];

        return response()->json($response, 200);

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $categories = Iklan::with('users')->where('category_id', $id)->groupBy('id')->get();

        $categories = DB::table('iklans')->select('iklans.id', 'iklans.judul', 'iklans.image1', 'iklans.volume', 'iklans.harga', 'iklans.created_at', 'users.id as user_id', 'users.image as user_image', 'users.store_name')
                  ->join('users', 'iklans.user_id', '=', 'users.id')
                  ->where('category_id', $id)
                  ->groupBy('iklans.id')->orderBy('iklans.id', 'desc')
                  ->get();

        foreach($categories as $category){
          $category->view_iklan = [
            'href' => '/api/v1/iklan/' . $category->id,
            'method' => 'GET'
          ];
        }

        $response = [
          'msg' => 'Daftar Iklan',
          'Category' => $categories,


        ];

        return response()->json($response, 200);

    }
}
