<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Article;
use function Sodium\increment;

class HomepageController extends Controller
{
    public function index()
    {
        $data['articles'] = Article::orderBy('created_at','DESC')->get();
        $data['categories'] = Category::orderBy('name','DESC')->get();
        return view('homepage',$data);
    }

    public function single($category,$slug)
    {
        $category = Category::whereSlug($category)->first() ?? abort(403,'Üzgünüm :(. Böyle bir Kategori bulunamadı.');
        $article = Article::whereSlug($slug)->whereCategoryId($category->id)->first() ?? abort(403,'Üzgünüm :(. Böyle bir Article bulunamadı.');
        $article->increment('hit');
        $data['article'] = $article;
        $data['categories'] = Category::orderBy('name','DESC')->get();
        return view('single',$data);
    }
}
