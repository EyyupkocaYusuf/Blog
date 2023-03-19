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
<div class="d-flex justify-content-center">
    {{ $articles->links() }}
</div>
