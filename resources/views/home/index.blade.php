@extends('layout.app')

@section('content')
<div class="container">
   @if (session('status'))
   <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
   @endif
    <div class="row">
        @foreach ($articles as $article)
        <div class="col-md-4">
            <div class="single-blog-item">
                     <div class="blog-thumnail">
                         <a href=""><img src="{{ asset('/storage/images/'.$article->image) }}" alt="blog-img"></a>
                     </div>
                     <div class="blog-content">
                         <h4>{{ $article->title }}</h4>
                         <p>{{ Str::limit($article->body, 100) }}</p>
                         <a href="{{ route('article.show', [$article->id]) }}" class="more-btn">View More</a>
                     </div>
                     <span class="text-muted"> {{ $article->created_at->diffForHumans() }}</span>
                 </div>
          </div>
        @endforeach
    </div>
  </div>
@endsection