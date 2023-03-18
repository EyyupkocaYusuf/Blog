<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
class HomepageController extends Controller
{
    public function index()
    {
        $data['categories'] = Category::get();
        return view('homepage',$data);
    }
}
