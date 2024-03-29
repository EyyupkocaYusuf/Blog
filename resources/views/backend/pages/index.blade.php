@extends('backend.layouts.master')
@section('title','Tüm sayfalar')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title') || {{$pages->count()}} sayfa bulundu.</h6>
            <a href="{{route('admin.page.trashed')}}" class="btn btn-sm btn-warning float-right"><i class="fa fa-flash">Silinen Sayfalar</i></a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
                        <th>Durum</th>
                        <th>İşlemler</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($pages as $page)
                        <tr>
                            <td>
                                <img src="{{$page->image}}" width="200" height="150">
                            </td>
                            <td>{{$page->title}}</td>
                            <td>
                                <input class="switch" page-id="{{$page->id}}" type="checkbox" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger"
                                       @if($page->status == 1) checked @endif data-toggle="toggle">
                            </td>
                            <td>
                                <a href="{{route('page',[$page->slug])}}" target="_blank" title="Görüntüle" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                                <a href="{{route('admin.makaleler.edit',$page->id)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                                <a href="{{route('admin.page.delete',$page->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {
            $('.switch').change(function() {
                id = $(this)[0].getAttribute('page-id');
                statu = $(this).prop('checked');
                $.get("{{route('admin.page.switch')}}", {id:id,statu:statu}, function(data, status){
                    console.log(data);
                });
            })
        })
    </script>
@endsection
