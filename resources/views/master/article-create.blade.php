@extends('layouts.app')
@section('title')
    @if (!empty($article->title))
    MyArticle | Update {{$article->title}}
    @else
    MyArticle | Create Article 
    @endif
@endsection
@section('header')
    <script src="{{asset('js/tinymce/tinymce.min.js')}}"></script>
    <script>
        tinymce.init({
        selector: 'textarea#content',
        plugins: ["lists","stylebuttons"],
        promotion: false,
        toolbar: ['undo redo | styles | bold italic | indent outdent bullist numlist | alignleft aligncenter alignright'],
        menubar: '',
        });

    </script>
@endsection
@section('content')
    <div class="pt-3"></div>
    <div class="row pt-5">
        <div class="col-sm-12">
            <div class="card">
             <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                   <h4 class="card-title">{{empty($article->title) ? 'Create' : 'Edit'}} Article</h4>
                </div>
             </div>
            @if (empty($article->title))
             <form action="{{route('article.store')}}" method="post" enctype="multipart/form-data">
            @else
            <form action="{{route('article.update',$article->id)}}" method="post" enctype="multipart/form-data">
            @method('PATCH')
             @endif
                @csrf
                <div class="card-body">
                   <div class="col-sm-4">
                       <div class="form-group">
                            @if($errors->has('title'))
                                <span class="text-danger">{{$errors->first('title')}}</span>
                                <br>
                            @endif
                           <label for="s">Title Article<span class="text-danger">*</span></label>
                           <input type="text" class="form-control" value="@if(!empty(old('title'))){{old('title')}}@else{{!empty($article->title) ? $article->title : ''}}@endif" id="title" name="title" placeholder="">
                       </div>
                   </div> 
                   <div class="col-sm-4">
                       <div class="form-group">
                            @if($errors->has('category'))
                                <span class="text-danger">{{$errors->first('category')}}</span>
                                <br>
                            @endif
                           <label for="s">Category<span class="text-danger">*</span></label>
                            <select name="category" id="category" class="form-control">
                                <option value="">-- Category --</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}"
                                    @if (!empty(old('category')))
                                        {{old('category') == $category->id ? 'selected' : ''}}
                                    @else
                                        {{!empty($article->title) ? $article->category_id == $category->id ? 'selected' : '' : ''}}
                                    @endif
                                    >
                                    {{$category->name}}
                                </option>
                                @endforeach
                            </select>
                       </div>
                   </div> 
                   <div class="col-sm-12">
                       <div class="form-group">
                            @if($errors->has('content'))
                                <span class="text-danger">{{$errors->first('content')}}</span>
                                <br>
                            @endif
                           <label for="s">Content<span class="text-danger">*</span></label>
                           <textarea name="content" id="content">
                            {!! (!empty(old('content')) ? old('content') : !empty($article->content)) ? $article->content : '' !!}
                           </textarea>
                       </div>
                   </div>
                   <div class="col-sm-6">
                        <div class="form-group">
                            @if($errors->has('banner'))
                                <span class="text-danger">{{$errors->first('banner')}}</span>
                                <br>
                            @endif
                            <label for="s">Banner Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="banner" name="banner" accept="image/*" onchange="loadFile(event)">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <img alt="Preview" id="banner_img" class="img-fluid mb-3"
                        @if (!empty($article->banner))
                        src="{{$article->getBanner()}}"
                        @endif
                        >
                    </div>
                   <div class="col-sm-8 d-flex">
                       <div class="form-group">
                           <button class="btn btn-primary" type="submit">{{empty($article->title) ? 'Add' : 'Edit'}}</button>
                       </div>
                       <div class="form-group ms-2">
                           <a class="btn btn-secondary" href="">Cancel</a>
                       </div>
                   </div>
                 </div>
                </div>
            </form>
          </div>
       </div>
    </div>

    <script>
        @if (empty($article->title))
        document.getElementById('banner_img').style.display = "none";
        @else
        document.getElementById('banner_img').style.display = "block";
        @endif

        var loadFile = function(event) {
            document.getElementById('banner_img').style.display = "block";
            var output = document.getElementById('banner_img');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
            URL.revokeObjectURL(output.src);
          }
        };
      </script>
@endsection


