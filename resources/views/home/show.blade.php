@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h5>{{ $article->title }}</h5>
                <p>{{ $article->body }}</p>
            </div>
            <div class="col-6">
                <img src="{{ asset('/storage/images/'.$article->image) }}" alt="blog-img">
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a type="button" class="btn btn-info" href="{{ route('article.edit', [$article->id]) }}">Edit</a>
                    <form class="d-inline" action="{{ route('article.destroy', ['article' =>  $article->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="detele" class="btn btn-danger">
                    </form>
                  </div>
            </div>
        </div>
    </div>
@endsection