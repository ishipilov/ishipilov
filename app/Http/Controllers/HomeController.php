<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

use App\Models\Loto;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $articles = Article::published()->ordered()->get();
        return view('home')->withArticles($articles);
    }

    /**
     * Test page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function test(Request $request)
    {
        $range = range(1, 36);
        $result = Loto::generate($range, 6, []);
        
        $loto = new Loto;
        $loto->result = $result;
        $loto->user()->associate($request->user());
        $loto->save();

        return Loto::all();

        //return view('test');
    }
}
