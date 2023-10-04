<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $shoppinglists = $user->shoppingLists;
        return ShoppingListResource::collection($shoppinglists);
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
        $user = $request->user();
        $shoppinglist = new ShoppingList;
        $shoppinglist->text = $attributes['text'];
        $shoppinglist->user()->associate($user);
        $shoppinglist->save();
        return new ShoppingListResource($shoppinglist);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function show(ShoppingList $shoppinglist)
    {
        return new ShoppingListResource($shoppinglist);
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
        $user = $request->user();
        $shoppinglist->text = $attributes['text'];
        $shoppinglist->save();
        return new ShoppingListResource($shoppinglist);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShoppingList $shoppinglist)
    {
        $shoppinglist->delete();
        return response(null, 204);
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
}
