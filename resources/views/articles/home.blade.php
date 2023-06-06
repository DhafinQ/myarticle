@extends('layouts.app')
@section('title')
    MyArticle | Home
@endsection
@section('content')
    <div class="row">
        <div class="pt-3"></div>
        <div class="col-lg-9 pt-5">
            <form action="{{ url('/') }}" class="js-search-input-form search-input-form mb-3" method="get">
                <div class="d-flex">
                    <div class="input-group w-50">
                        <input type="text" name="search" class="form-control" placeholder="Search Article..."
                            aria-label="Search" aria-describedby="search-addon" value="{{app('request')->input('search')}}"/>
                        <button class="btn btn-light" type="submit" id="button-addon1"
                            style="background-color:#ffffff ; border: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-search" viewBox="0 0 16 16">
                                <path
                                    d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                            </svg>
                        </button>
                    </div>

                    <div class="input-group ms-2 w-25">
                        <select name="category" class="form-control">
                            <option value="">-- Category --</option>
                            @foreach ($categories as $category)
                                <option value="{{$category->id}}" 
                                    @if (app('request')->input('category') == $category->id)
                                        selected
                                    @endif
                                    >
                                    {{$category->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @if (Gate::check('article_create'))
                    <div class="input-group ms-2 w-25">
                        <a href="{{url('article/create')}}" class="btn btn-primary">Create Article
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="ms-1 bi bi-pen" viewBox="0 0 16 16">
                                <path
                                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z" />
                            </svg>
                        </a>
                    </div>
                    @endif

                </div>

            </form>

            {{-- List Article --}}
            <div class="row  row-cols-1 row-cols-md-2 g-4" id="loadData">
                
            </div>

        </div>


        <div class="col-lg-3">
            <div class="sticky-md-top pt-1" style="z-index: 1;">
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
<script type="text/javascript">
    $(function() {
        function loadMoreData(id=0){
            axios.post('{{ route("load-article") }}',{ id : id, 
                category : {{app('request')->input('category') ? app('request')->input('category') : 'null'}} != 'null' ? "{{app('request')->input('category')  ? app('request')->input('category') : null}}" : null , 
                search : "{{app('request')->input('search') ? app('request')->input('search') : null}}" != 'null' ? "{{app('request')->input('search') ? app('request')->input('search') : null}}" : null })
            .then(res => {
                   $('#load_more_button').remove();
                   $('#loadData').append(res.data);
                   $('#load_more').insertAfter('#loadData');
            })
        }
        loadMoreData(0);
			$('body').on('click', '#load_more_button', function(){
			var id = $(this).data('id');
			$('#load_more_button').html('<b>Loading...</b>');
			loadMoreData(id);
            $('#load_more').remove();
		});
    });
</script>
@endsection