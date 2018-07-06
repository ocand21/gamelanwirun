<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Category;

use App\Http\Controllers\Controller;

use App\Http\Requests;

use Session;
use Image;
use Auth;
use Storage;


class CategoryController extends Controller
{


      public function __construct(){
        $this->middleware('auth');
      }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        return view('auth.category.index')->withCategories($categories);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, array(
          'name' => 'required|max:255',
          'image' => 'required|image'
        ));

        $name = $request->input('name');
        $image = $request->input('image');

        $category = new Category([
          'name' => $name,
          'image' => $image,
        ]);

        $category->name = $request->input('name');
        if ($request->hasFile('image')) {
          $image = $request->file('image');
          $filename = time() . '.' . $image->getClientOriginalExtension();
          $location = public_path('images/' . $filename);
          Image::make($image)->save($location);

          $category->image = $filename;
        }

        $category->save();

        Session::flash('flash_message','Berhasil menambahkan kategori!');

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
        $category = Category::find($id);
        Storage::delete($category->image);

        $category->delete();

        Session::flash('flash_message','Kategori berhasil dihapus!');

        return back();

    }
}
