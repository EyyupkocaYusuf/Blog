@extends('front.layouts.master')
@section('title','Anasayfa')
@section('content')
<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->
                @include('front.widgets.ArticleList')
            <!-- Post preview-->
        </div>
    @include('front.widgets.CategoryWidget')
    </div>
</div>

@endsection

<!-- Footer-->

