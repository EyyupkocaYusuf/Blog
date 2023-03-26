<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
class categoryController extends Controller
{



    public function switch(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->statu=="true" ? 1 : 0 ;
        $category->save();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $isExist = Category::whereSlug(Str::slug($request->category))->first();
        if($isExist)
        {
            toastr()->error($request->category.' kategorisi zaten mevcut.', 'Başarısız');
            return redirect()->back();
        }

            $category=new Category;
         $category->name = $request->category ;
         $category->slug = Str::slug($request->category) ;
         $category->save();
         toastr()->success('Data has been saved successfully!', 'Başarılı');
         return redirect()->back();
    }

    public function repair(Request $request)
    {
        $isSlug = Category::whereSlug(Str::slug($request->slug))->whereNotIn('id',[$request->id])->first();
        $isName = Category::whereName(($request->category))->whereNotIn('id',[$request->id])->first();
        if($isSlug or $isName)
        {
            toastr()->error($request->category.' kategorisi zaten mevcut.', 'Başarısız');
            return redirect()->back();
        }

        $category=Category::find($request->id);
        $category->name = $request->category ;
        $category->slug = Str::slug($request->slug) ;
        $category->save();
        toastr()->success('Data has been saved successfully!', 'Başarılı');
        return redirect()->back();
    }

    public function getData(Request $request)
    {
        $category= Category::findOrFail($request->id);
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Category::find($id)->delete();
        toastr()->success('Data has been saved successfully!', 'Başarılı');
        return redirect()->back();
    }
}
