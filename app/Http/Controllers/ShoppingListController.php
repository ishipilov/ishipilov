<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreShoppingList;
use App\Http\Requests\UpdateShoppingList;
use App\Http\Resources\ShoppingListResource;
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
		$this->authorizeResource(ShoppingList::class, 'shoppinglist');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $url_indata = route('shoppinglists.indata');
        $url_store = route('shoppinglists.store');
        return view('shoppinglists.index')->with([
            'url_indata' => $url_indata,
            'url_store' => $url_store,
        ]);
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
            $user = $request->user();
            $shoppinglist = new ShoppingList;
            $shoppinglist->text = $attributes['text'];
            $shoppinglist->user()->associate($user);
            $shoppinglist->save();
            return new ShoppingListResource($shoppinglist);
        } catch (\Exception $e) {
            $errors = $e->getMessage();
            return response($errors, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingList  $shoppinglist
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingList $shoppinglist)
    {
        return new ShoppingListResource($shoppinglist);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShoppingList  $shoppinglist
     * @return \Illuminate\Http\Response
     */
    public function edit(ShoppingList $shoppinglist)
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
    public function update(UpdateShoppingList $request, ShoppingList $shoppinglist)
    {
        $attributes = $request->validated();
        try {
            $user = $request->user();
            $shoppinglist->text = $attributes['text'];
            $shoppinglist->save();
            return new ShoppingListResource($shoppinglist);
        } catch (\Exception $e) {
            $errors = $e->getMessage();
            return response($errors, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingList $shoppinglist)
    {
        //
    }

    /**
     * Toggle active state.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShoppingList  $shoppinglist
     * @return \Illuminate\Http\Response
     */
    public function toggle(Request $request, ShoppingList $shoppinglist)
    {
        $this->authorize('toggle', $shoppinglist);
        $options = $shoppinglist->options;
        if ($options['active']) {
            $options['active'] = false;
        } else {
            $options['active'] = true;
        }
        $shoppinglist->options = $options;
        $shoppinglist->save();
        return new ShoppingListResource($shoppinglist);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function indata(Request $request)
    {
        $this->authorize('indata', ShoppingList::class);
        $user = $request->user();
        $shoppinglists = $user->shoppingLists;
        return ShoppingListResource::collection($shoppinglists);
    }
}
