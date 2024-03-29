@isset($categories)
<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Kategoriler
        </div>
        <ul class="list-group">
            @foreach($categories as $category)
                <li class="list-group-item @if(Request::segment(2) == $category->slug) active @endif">
                    <a href="{{route('category',$category->slug)}}">
                        {{$category->name}}
                        <span class="badge bg-danger float-end">{{$category->CategoryCount()}}
                        </span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endisset
