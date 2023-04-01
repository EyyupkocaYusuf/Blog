@extends('backend.layouts.master')
@section('title','Tüm Kategoriler')
@section('content')

   <div class="row">
       <!-- Modal -->
       <div class="col-md-4">
           <div class="card shadow mb-4">
               <div class="card-header py-3">
                   <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
               </div>
               <div class="card-body">
                   <form method="post" action="{{route('admin.kategoriler.store')}}">
                       {{method_field('post')}}
                       @csrf
                  <div class="form-group">
                      <label>Kategory Adı</label>
                      <input type="text" class="form-control" name="category" required>
                  </div>
                   <div class="form-group">
                       <button type="submit" class="btn btn-primary btn-block">Oluştur</button>
                   </div>
                   </form>
               </div>
           </div>

       </div>
    <div class="col-md-8">
           <div class="card shadow mb-4">
               <div class="card-header py-3">
                   <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
               </div>
               <div class="card-body">
                   <div class="table-responsive">
                       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                           <thead>
                           <tr>
                               <th>Kategori Adı</th>
                               <th>Makale Sayısı</th>
                               <th>Durum</th>
                               <th>İşlemler</th>
                           </tr>
                           </thead>

                           <tbody>
                           @foreach($categories as $category)
                               <tr>
                                   <td>{{$category->name}}</td>
                                   <td>{{$category->CategoryCount()}}</td>
                                   <td>
                                       <input class="switch" category-id="{{$category->id}}" type="checkbox" data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger"
                                              @if($category->status == 1) checked @endif data-toggle="toggle">
                                   </td>
                                   <td>
                                       <a category-id="{{$category->id}}" title="Düzenle" class="btn btn-sm btn-primary edit-click"><i class="fa fa-pen"></i></a>
                                       <a category-id="{{$category->id}}" category-count="{{$category->CategoryCount()}}" title="Sil" class="btn btn-sm btn-danger remove-click"><i class="fa fa-times"></i></a>
                                   </td>
                               </tr>
                           @endforeach
                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <div id="deleteModal" class="modal">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <h4 class="modal-title">Kategoriyi Sil</h4>
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               <div class="modal-body" id="body">
                   <div id="articleAlert" class="alert alert-danger">
                   </div>
               </div>
               <div class="modal-footer">
                   <form method="post" action="{{route('admin.category.delete')}}">
                       @csrf
                       <input type="hidden" name="id" id="deleteId">
                       <button type="submit" id="deleteButton" class="btn btn-success">Sil</button>
                   </form>
                   <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
               </div>
           </div>
       </div>
   </div>
   <div id="editModal" class="modal fade" role="dialog">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal">&times;</button>
                   <h4 class="modal-title">Kategoriyi Düzenle</h4>
               </div>
               <div class="modal-body">
                   <form method="post" action="{{route('admin.category.repair')}}">
                       @csrf
                       <div class="form-group">
                            <label>Kategori Adı</label>
                           <input id="category" type="text" class="form-control" name="category">
                           <input  type="hidden"  id="category_id" class="form-control" name="id">
                       </div>
                       <div class="form-group">
                           <label>Kategori Slug</label>
                           <input id="slug" type="text" class="form-control" name="slug">
                       </div>
                </div>
             <div class="modal-footer">
                   <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
                   <button type="submit" class="btn btn-success">Kaydet</button>
               </div>
               </form>
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
            $('.remove-click').click(function() {
                id = $(this)[0].getAttribute('category-id');
                count = $(this)[0].getAttribute('category-count');
                if(id==1)
                {
                    $('#articleAlert').html('Genel Kategorisi Silinemez. Silinen kategorilerdeki makaleler buraya taşınır.');
                    $('#body').show();
                    $('#deleteButton').hide();
                    $('#deleteModal').modal();
                    return;
                }
                $('#deleteButton').show();
                $('#deleteId').val(id);
                $('#articleAlert').html('');
                $('#body').hide();
                if(count>0)
                {
                    $('#articleAlert').html('Bu kategoriye air '+count+' makale bulunmaktadır. Silmek istediğinize emin misiniz?');
                    $('#body').show();
                }
                $('#deleteModal').modal();

            });
            $('.edit-click').click(function() {
                id = $(this)[0].getAttribute('category-id');
                $.ajax({
                type:'GET',
                url:'{{route('admin.category.getdata')}}',
                data:{id:id},
                success:function(data){
                    console.log(data);
                    $('#category').val(data.name);
                    $('#slug').val(data.slug);
                    $('#category_id').val(data.id);
                    $('#editModal').modal();
                }
            });
        });
            $('.switch').change(function() {
                id = $(this)[0].getAttribute('category-id');
                statu = $(this).prop('checked');
                $.get("{{route('admin.category.switch')}}", {id:id,statu:statu}, function(data, status){});
            })
        })
    </script>
@endsection

