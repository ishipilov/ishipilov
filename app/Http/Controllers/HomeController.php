<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        $user = $request->user();
        if ($user) {
            $articles = $user->articles()->published()->ordered()->get();
            return view('users.show')
            ->withArticles($articles)
            ->withUser($user);
        } else {
            return view('home');
        }
    }
}
