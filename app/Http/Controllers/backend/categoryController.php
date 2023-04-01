<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Article;
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

    public function delete(Request $request)
    {
       $category = Category::findOrFail($request->id);
        if($category->id == 1)
        {
            toastr()->success('Data has been saved successfully!', 'Başarılı');
            return redirect()->back();
        }
        $message='';
        $count=$category->CategoryCount();
        if($count>0)
        {
            Article::where('category_id',$category->id)->update(['category_id'=>1]);
            $defaultCategory= Category::find(1);
            $message='Bu kategoriye ait '.$count.' Makale '.$defaultCategory->name.' kategorisine taşındı.';
        }
        $category->delete();
        toastr()->success('Data has been saved successfully!', $message);
        return redirect()->back();
    }
}
