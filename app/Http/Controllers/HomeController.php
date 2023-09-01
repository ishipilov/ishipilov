<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

use Illuminate\Support\Arr;

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
        function loto(Array $array, Int $count, Array $result)
        {
            shuffle($array);
            $rand = array_rand($array);
            $push = $array[$rand];
            array_push($result, $push);
            unset($array[$rand]);
            if (count($result) == $count) {
                return [$result, $array];
            } else {
                return loto($array, $count, $result);
            }
        }

        $range = range(1, 36);

        return loto($range, 6, []);

        return view('test');
    }
}
