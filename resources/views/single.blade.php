@extends('front.layouts.master')
@section('title',$article->title)
@section('bg',$article->image)
@section('content')
    <!-- Main Content-->
                <!-- Post preview-->
                <article class="mb-4">
                    <div class="container px-4 px-lg-5">
                        <div class="row gx-4 gx-lg-5 justify-content-center">
                            <div class="col-md-10 col-lg-8 col-xl-7">
                                <h1>{{$article->title}}</h1>
                                <br>
                                {{$article->content}}
                                <br>
                                <br>
                                <img src="{{$article->image}}" />
                                <br>
                                <br>
                                <span class="float-end">{{$article->hit}} defa okundu</span>
                                <span>kategori: {{$article->GetCategoryName->name}}</span>
                            </div>
                            @include('front.widgets.CategoryWidget')
                        </div>
                    </div>
                </article>

@endsection
