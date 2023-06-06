<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home(Request $request)
    {
        $articles = Article::paginate(6);

        if ($request->ajax()) {
    		$view = view('child',compact('articles'))->render();
            return response()->json(['html'=>$articles]);
        }

        $myArticle = Article::with('user')->where('user_id','=',auth()->user()->id)->orderByDesc('updated_at')->limit(5)->get();
        $categories = Category::all();
        return view('articles.home',compact('articles','categories','myArticle'));
    }


    public function index()
    {
        $this->authorize('article_menu');
        $this->authorize('article_menu');
        return view('master.article');
    }

    public function listArticle()
    {
        $articles = Article::with('user','category')->get();
        return response()->json([
        'massage' => 'List Article',
        'data' => $articles
        ]);
    }

    public function loadMoreArticle(Request $request)
    {
        if ($request->id > 0) {
            if(!empty($request->category) && !empty($request->search) ){
                $data = Article::with('user')->where('title','like','%'.$request->search.'%')
                ->where('category_id','=',$request->category)
                ->where('id','<',$request->id)->orderByDesc('id')->limit(6)->get();
            }else if(!empty($request->category)){
                $data = Article::with('user')->where('category_id','=',$request->category)
                ->where('id','<',$request->id)->orderByDesc('id')->limit(6)->get();
            }else if(!empty($request->search)){
                $data = Article::with('user')->where('title','like','%'.$request->search.'%')
                ->where('id','<',$request->id)->orderByDesc('id')->limit(6)->get();
            }else{
                $data = Article::orderByDesc('id')->limit(6)->get();
            }

        } else {
            if(!empty($request->category) && !empty($request->search) ){
                $data = Article::with('user')->where('title','like','%'.$request->search.'%')
                ->where('category_id','=',$request->category)->orderByDesc('id')->limit(6)->get();
            }else if(!empty($request->category)){
                $data = Article::with('user')->where('category_id','=',$request->category)->orderByDesc('id')->limit(6)->get();
            }else if(!empty($request->search)){
                $data = Article::with('user')->where('title','like','%'.$request->search.'%')->orderByDesc('id')->limit(6)->get();
            }else{
                $data = Article::orderByDesc('id')->limit(6)->get();
            }
        }

            $output = '';
            $last_id = '';

            if (!$data->isEmpty()) {
                foreach ($data as $row) {
                    $output .= '
                    <div class="col">
                    <a href="'.route("article.show",$row->id).'">
                        <div class="card">
                            <img src="'.$row->getBanner().'" alt="" width="100%" height="180px" style="object-fit:cover;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <h5 class="card-title w-75">'.$row->title.'</h5> <small class="text-muted">'.$row->getDate().'</small>
                                </div>
                                <div class="card-text text-black">'.$row->firstSentence() .'</div>
                                <div>
                                    <span class="badge p-2 me-2 my-1 bg-secondary">'.$row->category->name.'</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                    ';
                    $last_id = $row->id ;
                }
                $output .= '
                    <div id="load_more">
                        <button type="button" name="load_more_button" class="btn form-control mb-4" data-id="' . $last_id . '" id="load_more_button">Load More</button>
                    </div>
                    ';
                        } else {
                            $output .= '
                    <div id="load_more">
                        <button type="button" name="load_more_button" class="btn form-control my-4" disabled>No Data Found</button>
                    </div>';
            }
        return $output;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('article_create');
        $categories = Category::all();
        return view('master.article-create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('article_create');
        $request->validate([
            'content' => 'required',
            'title' => 'required',
            'banner' => 'required|file|max:2048',
            'category' => 'required'
        ]);

        $bannerName = auth()->user()->id.'_'.date("ymdhis").'.'.$request->file('banner')->getClientOriginalExtension();
        $request->file('banner')->storeAs('public/banner_article', $bannerName);

        $data = [
            'content' => $request->content,
            'title' => $request->title,
            'banner' => $bannerName,
            'user_id' => auth()->user()->id,
            'category_id' => $request->category
        ];

        Article::create($data);

        return redirect()->route('article.index')->with('success','New Article Is Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize('article_read');
        $article = Article::findOrFail($id);
        $recomendations = Article::with('user')->orderByDesc('id')->get()->except($id)->take(2);
        $myArticle = Article::with('user')->where('user_id','=',auth()->user()->id)->orderByDesc('updated_at')->limit(5)->get();
        $categories = Category::all();
        return view('articles.show',compact('article','myArticle','categories','recomendations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('article_update');
        $article = Article::findOrFail($id);
        $categories = Category::all();
        return view('master.article-create',compact('categories','article'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('article_update');
        $request->validate([
            'content' => 'required',
            'title' => 'required',
            'banner' => 'file|max:2048',
            'category' => 'required'
        ]);

        $article = Article::findOrFail($id);

        if(!empty($request->banner)){
            $path = storage_path('app/public/banner_article/'.$article->banner);
            if(File::exists($path)){
                File::delete($path);
            }

            $bannerName = auth()->user()->id.'_'.date("ymdhis").'.'.$request->file('banner')->getClientOriginalExtension();
            $request->file('banner')->storeAs('public/banner_article', $bannerName);
        }else{
            $bannerName = $article->banner;
        }

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'category_id' => $request->category,
            'banner' => $bannerName,
        ];

        $article->update($data);

        return redirect()->route('article.index')->with('success','Article is Updated!');
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function deletes(Request $request)
    {
        $this->authorize('article_delete');
        for($i=0;$i<count($request->id);$i++){
            $article = Article::findOrFail($request->id[$i]);
            $path = storage_path('app/public/banner_article/'.$article->banner);
            if (File::exists($path)) 
            {
                File::delete($path);
            }
            $article->delete();
        }

        return response()->json([
            'message' => 'Article Deleted!'
        ]);
    }

    public function destroy(String $id)
    {
        $this->authorize('article_delete');
        $article = Article::findOrFail($id);
        $path = storage_path('app/public/banner_article/'.$article->banner);
        if (File::exists($path)) 
        {
            File::delete($path);
        }
        $article->delete();

        return response()->json([
            'message' => 'Article Deleted!'
        ]);
    }
}
