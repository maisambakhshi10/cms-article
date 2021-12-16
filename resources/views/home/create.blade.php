@extends('layout.app')

@section('content')
   <div class="row">
       <div class="col-12">
        <div class="container">
            <form action="{{ route('article.store') }}" method="POST" id="articleForm" enctype="multipart/form-data">
                <input type="hidden" name="body" id="body">
                @csrf
                <div class="form-group my-2">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" name="title" id="title" placeholder="Enter the title">
                </div>
                <div class="form-group my-2">
                    <div class="flex flex-col space-y-2">
                        <label for="editor" class="text-gray-600 font-semibold">Body</label>
                        <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><div>
                    </div>
                </div>
                <div class="form-group my-2">
                    <label class="form-label" for="image">Upload image</label>
                    <input type="file" class="form-control" name="image" id="image" />    
                </div>              
                <div class="form-group my-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
        </div>
        <div class="container">
            <div class="row">
                @if ($errors->any())
                <div class="mb-3">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
       </div>
   </div>
@endsection