@extends('backend.layouts.master')
@section('title','Silinen Sayfalar')
@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title') || {{$pages->count()}} sayfa bulundu
                <a href="{{route('admin.page.index')}}" class="btn btn-sm btn-success float-right"><i class="fa fa-flash">Aktif Sayfalar</i></a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Fotoğraf</th>
                        <th>Makale Başlığı</th>
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
                                <a href="{{route('admin.page.recover',$page->id)}}" title="Geri Yükle" class="btn btn-sm btn-primary"><i class="fa fa-recycle"></i></a>
                                <a href="{{route('admin.page.hard.delete',$page->id)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection


