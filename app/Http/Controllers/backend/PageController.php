<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Models\Page;
class PageController extends Controller
{

    public function switch(Request $request)
    {
        $page = Page::findOrFail($request->id);
        $page->status = $request->statu=="true" ? 1 : 0 ;
        $page->save();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::all();
        return view('backend.pages.index',compact('pages'));
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
        //
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
    }

    public function delete($id)
    {
        Page::find($id)->delete();
        toastr()->success('Data has been saved successfully!', 'Başarılı');
        return redirect()->route('admin.page.index');
    }

    public function trashed()
    {
        $pages = Page::onlyTrashed()->orderBy('deleted_at','ASC')->get();
        return view('backend.pages.trashed',compact('pages'));
    }

    public function recover($id)
    {
        Page::onlyTrashed()->find($id)->restore();
        toastr()->success('Data has been saved successfully!', 'Başarılı');
        return redirect()->back();
    }
    public function hardDelete($id)
    {
        $page = Page::onlyTrashed()->find($id);
        if(File::exists($page->image))
        {
            File::delete(public_path($page->image));
        }
        $page->forceDelete();
        toastr()->success('Data has been saved successfully!', 'Başarılı');
        return redirect()->route('admin.page.index');
    }
}
