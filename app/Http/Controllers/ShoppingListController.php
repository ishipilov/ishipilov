<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShoppingList;
use App\Http\Requests\UpdateShoppingList;
use App\Models\ShoppingList;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->authorizeResource(ShoppingList::class, 'shopping_list');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $shopping_list = $user->shopping_list;
        return [
            'shopping_list' => $shopping_list,
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShoppingList $request)
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
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingList $shoppingList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingList $shoppingList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShoppingList $request, ShoppingList $shoppingList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingList $shoppingList)
    {
        //
    }
}
