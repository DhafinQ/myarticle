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
                                <span class="badge p-2 me-2 mt-2 bg-secondary">{{$article->category->name}}</span>
                            </div>
                            <div class="text-end">
                                <a href="{{url('article/edit/'.$article->id)}}" class="btn btn-warning btn-sm mt-2">Edit Article</a>
                                <button type="button" class="btn btn-sm btn-danger mt-2" id="del-btn">
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
        @if ($recomendations->count() == 0)
            <div class="text-center my-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-emoji-frown" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M4.285 12.433a.5.5 0 0 0 .683-.183A3.498 3.498 0 0 1 8 10.5c1.295 0 2.426.703 3.032 1.75a.5.5 0 0 0 .866-.5A4.498 4.498 0 0 0 8 9.5a4.5 4.5 0 0 0-3.898 2.25.5.5 0 0 0 .183.683zM7 6.5C7 7.328 6.552 8 6 8s-1-.672-1-1.5S5.448 5 6 5s1 .672 1 1.5zm4 0c0 .828-.448 1.5-1 1.5s-1-.672-1-1.5S9.448 5 10 5s1 .672 1 1.5z"/>
                </svg>
                <p class="mt-2">No Recomendation Found</p>
            </div>
        @else
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
        @endif
        

    </div>


    <div class="col-lg-3">
        <div class="sticky-md-top pt-1">
            <div class="mt-5 ">
            </div>

            <div class="card">
                @if(Gate::check('article_create'))
                    <div class="card-header">
                        <div class="header-title d-flex">
                            <h5 class="card-title">Your Article
                            </h5>
                        </div>
                    </div>
                @endif
                <div class="card-body">
                @if(Gate::check('article_create'))
                        @if ($myArticle->count() == 0)
                        <div class="col-md-12 mb-2">
                            <div class="text-center">
                                <p>No Articles Found</p>
                            </div>
                        </div>
                        @else
                        @foreach ($myArticle as $my)
                        <a href="{{route('article.show',$my->id)}}">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-info text-white rounded p-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div class="ms-2">
                                    <div class="h6 overflow-hidden">{{$my->shortTitle()}}</div>
                                    <small class="text-black">{!! Str::limit( strip_tags( $my->content ), 20 ) !!}</small>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        @endif
                    @endif
                    
                    <h5 class="mb-3">All Categories
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
</div>
@endsection

@section('scripts')
    @include('script.article-show-script')
@endsection