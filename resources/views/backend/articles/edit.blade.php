@extends('backend.layouts.master')
@section('title',$article->title.' Makalesini Düzenle')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif
            <form method="post" action="{{route('admin.makaleler.update',$article->id)}}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label>Makale Başlığı</label>
                    <input type="text" class="form-control" name="title" value="{{$article->title}}" required>
                </div>

                <div class="form-group">
                    <label>Makale Kategorisi</label>
                    <select class="form-control" name="category" required>
                        <option value="">Seçim Yapınız</option>
                        @foreach($categories as $category)
                            <option @if($article->category_id == $category->id) selected @endif value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Makale Fotoğrafı</label> <br>
                    <img src="{{asset($article->image)}}" class="img-thumbnail rounded" width="300">
                    <input type="file" class="form-control" name="image" >
                </div>

                <div class="form-group">
                    <label>Makale İçeriği</label>
                    <textarea id="editor"  class="form-control" name="content" rows="5"  required>{{$article->content}}</textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Güncelle</button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#editor').summernote();
        });
    </script>
@endsection