<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\Article;
use App\Models\Page;
use App\Models\Contact;
use function Sodium\increment;

class HomepageController extends Controller
{
    public function __construct()
    {
        view()->share('pages',Page::orderBy('order','ASC')->get());
    }
    public function index()
    {
        $data['articles'] = Article::orderBy('created_at','DESC')->paginate(3);
        $data['articles'] -> withPath('sayfa');
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

    public function category($slug)
    {
        $category = Category::whereSlug($slug)->first() ?? abort(403,'Üzgünüm :(. Böyle bir Kategori bulunamadı.');
        $data['category'] = $category;
        $data['categories'] = Category::orderBy('name','DESC')->get();
        $data['articles'] = Article::whereCategoryId($category->id)->orderBy('created_at','DESC')->paginate(1);
        return view('category',$data);
    }

    public function page($slug)
    {
        $page = Page::whereSlug($slug)->first() ?? abort(403,'Üzgünüm :(. Böyle bir Page bulunamadı.');
        $data['page'] = $page;
        return view('page',$data);
    }

    public function contact()
    {
        return view('contact');
    }

    public function contactpost(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits:11',
            'subject' => 'required',
            'message' => 'required|min:10',
        ];
        $validate = Validator::make($request->post(),$rules);
        if($validate->fails())
        {
            return redirect()->route('contact')->withErrors($validate)->withInput();
        }

        $contact = new Contact;
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->subject = $request->subject;
        $contact->message = $request->message;
        $contact->save();

        return redirect()->route('contact')->with('success','Mesajınız alındı. En kısa sürede dönüş yapılacaktır. Teşekkür Ederiz.');
    }
}
