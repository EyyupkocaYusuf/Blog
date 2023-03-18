<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Article;
class HomepageController extends Controller
{
    public function index()
    {
        $data['articles'] = Article::orderBy('created_at','DESC')->get();
        $data['categories'] = Category::orderBy('name','DESC')->get();
        return view('homepage',$data);
    }
}
