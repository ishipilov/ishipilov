<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticle;
use App\Http\Requests\UpdateArticle;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->authorizeResource(Article::class, 'article');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::published()->ordered()->get();
        return view('articles.index')->withArticles($articles);
    }

    public function user_articles(Request $request)
    {
        $articles = $request->user()->articles()->ordered()->get();
        return view('articles.index')->withArticles($articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticle $request)
    {
        $attributes = $request->validated();
        try {
            $article = new Article;
            $article->title = $attributes['title'];
            $article->text = $attributes['text'];
            $article->user_id = $request->user()->id;
            $article->save();
            return redirect()->route('articles.show', $article)->withStatus("Success.");
        } catch (\Exception $e) {
            $errors = $e->getMessage();
            return back()->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('articles.show')->withArticle($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('articles.edit')->withArticle($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticle $request, Article $article)
    {
        $attributes = $request->validated();
        try {
            $article->title = $attributes['title'];
            $article->text = $attributes['text'];
            if (empty($attributes['publish'])) {
                $article->published_at = null;
            } else {
                $article->published_at = now();
            }
            $article->save();
            return redirect()->route('articles.show', $article)->withStatus("Success.");
        } catch (\Exception $e) {
            $errors = $e->getMessage();
            return back()->withErrors($errors);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        try {
            $article->delete();
            return redirect()->route('articles.index')->withStatus("Success.");
        } catch (\Exception $e) {
            $errors = $e->getMessage();
            return back()->withErrors($errors);
        }
    }
}
