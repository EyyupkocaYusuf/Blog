@extends('front.layouts.master')
@section('title','Anasayfa')
@section('content')
<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->
            @foreach($articles as $article)
            <div class="post-preview">
                <a href="{{route('single',[$article->GetCategoryName->slug,$article->slug])}}">
                    <h2 class="post-title">{{$article->title}}</h2>
                    <img src="{{$article->image}}" />
                    <h3 class="post-subtitle">{{Str::limit($article->content,65)}}</h3>
                </a>
                <p class="post-meta">
                    Posted by
                    <a href="#!">Start Bootstrap</a>
                    {{$article->created_at->diffForHumans()}}

                    <span class="float-end">{{$article->GetCategoryName->name}}</span>
                </p>
            </div>
            <!-- Divider-->
            @if(!$loop->last)
            <hr class="my-4" />
                @endif
            @endforeach
            <!-- Post preview-->
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="#!">Older Posts →</a></div>
        </div>
    @include('front.widgets.CategoryWidget')
    </div>
</div>

@endsection

<!-- Footer-->

