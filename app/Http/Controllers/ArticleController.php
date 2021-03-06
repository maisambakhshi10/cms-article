<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticle;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.index',[
            'articles' => Article::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('home.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {
         // validate the incoming requests
         $request->validated();

         if($request->hasFile('image')) {
             $fileNameWithExt = $request->file('image')->getClientOriginalName();
             $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
             $ext = $request->file('image')->getClientOriginalExtension();
             $fileNameToStore = $fileName . '_'.time().'.'.$ext;
             $request->file('image')->storeAs('/public/images', $fileNameToStore);
         }
 
         // store the input requests
         $article = new Article();
         $article->title = $request->input('title');
         $article->body = $request->input('body');
         $article->image = $fileNameToStore;
         $article->save();

        // a success status when post is stored successfully
        $request->session()->flash('status', 'the article was created');
 
         return redirect()->route('article.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('home.show', [
            'article'   =>  $article
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('home.edit',[
            'article'   =>  $article
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(StoreArticle $request, $id)
    {
        $article = Article::findOrFail($id);
        $validated = $request->validated();

        $article->fill($validated);
        $article->save();

        $request->session()->flash('status', 'the article was updated successfully');

        return redirect()->route('article.show', ['article' =>  $article->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        session()->flash('status', 'The post was deleted successfully');

        return redirect()->route('article.index');
    }
}
