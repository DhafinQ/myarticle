@extends('layouts.app')
@section('title')
    {{'MyArticle | ' . $article->title}}
@endsection
@section('content')
<div class="row">
    <div class="pt-3"></div>
    <div class="col-lg-9 pt-5">
        {{-- Article --}}
        <div class="row row-cols-1 row-cols-md-1 g-4">
            <div class="col">
                <div class="card">
                    <img src="{{$article->getBanner()}}" alt="" width="100%" height="200px" style="object-fit:cover;">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title">{{$article->title}}</h4>
                            <p>{{$article->getDate()}}</p>
                        </div>
                        <div class="text-black">
                            {!! $article->content !!}
                        </div>
                        <div class="d-flex justify-content-between mt-3">
                            <div class="">
                                <span class="badge p-2 me-2 my-1 bg-secondary">{{$article->category->name}}</span>
                            </div>
                            <div class="">
                                <a href="{{url('article/edit/'.$article->id)}}" class="btn btn-warning btn-sm">Edit Article</a>
                                <button type="button" class="btn btn-sm btn-danger" id="del-btn">
                                    Delete Article
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Recomendation --}}
        <h2 class="my-3">
            Recomendation For You
        </h2>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            @foreach($recomendations as $recomend)
            <div class="col">
                <a href="{{route('article.show',$recomend->id)}}">
                    <div class="card">
                        <img src="{{$recomend->getBanner()}}" alt="" width="100%" height="180px" style="object-fit:cover;">
                        {{-- <svg class="bd-placeholder-img card-img-top" width="100%" height="180" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#868e96"></rect><text x="50%" y="50%" fill="#dee2e6" dy=".3em">Image cap</text></svg> --}}
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title w-75">{{$recomend->title}}</h5> <small class="text-muted">{{$recomend->getDate()}}</small>
                            </div>
                            <div class="card-text text-black">{!! $recomend->firstSentence() !!}</div>
                            <div>
                                <span class="badge p-2 me-2 my-1 bg-secondary">{{$recomend->category->name}}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>

    </div>


    <div class="col-lg-3">
        <div class="sticky-md-top pt-1">
            <div class="mt-5 ">
                {{-- <select class="form-select" aria-label="Default select example">
    <option selected>Status</option>
    <option value="1">Bekerja</option>
    <option value="2">Kuliah</option>
    <option value="3">Freelance</option>
    </select> --}}
            </div>

            <div class="card">
                <div class="card-body">
                                    
                    @foreach ($myArticle as $my)
                    <a href="{{route('article.show',$my->id)}}">
                        <div class="d-flex align-items-center mb-2">
                            <div class="bg-info text-white rounded p-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="ms-2 pt-2">
                                <div class="h6 overflow-hidden">{{$my->shortTitle()}}</div>
                                <small class="text-black">{!! $my->firstPhrase() !!}</small>
                            </div>
                        </div>
                    </a>
                    @endforeach
                    
                    <h5 class="my-3" style="font-style: normal;">All Categories
                    </h5>

                    <div class="d-flex flex-wrap">
                        <form action="{{url('/')}}" method="get">
                        @foreach ($categories as $category)
                            <button type="submit" name="category" value="{{$category->id}}" class="btn btn-sm btn-rounded-pill btn-secondary my-1" >{{$category->name}}</button>
                        @endforeach
                        </form>
                    </div>
                </div>
            </div>
            

            <script src="https://code.jquery.com/jquery-3.6.1.slim.min.js"
                integrity="sha256-w8CvhFs7iHNVUtnSP0YKEg00p9Ih13rlL9zGqvLdePA=" crossorigin="anonymous"></script>
            <script>
            $(document).on('click', '#del-btn', function () {
                var id = $(this).data('id');
                Swal.fire({
                    icon: 'question',
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'error',
                    showCancelButton: true,
                    confirmButtonColor: '#28C76F',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    if (result.value) {
                        $.ajax({
                            'url': '{{url('article/'.$article->id)}}',
                            'type': 'POST',
                            'data': {
                                '_method': 'DELETE',
                                '_token': '{{csrf_token()}}',
                            },
                            success: function (response) {
                                if (response.message) {
                                   window.location.href = "/article";
                                }
                            }
                        });
                    } else {
                        console.log(`dialog was dismissed by ${result.dismiss}`)
                    }
                });
        });
            </script>
            {{-- @include('partials.components.share-offcanvas') --}}
</div>
@endsection