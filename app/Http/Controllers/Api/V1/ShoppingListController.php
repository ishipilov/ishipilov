<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShoppingListResource;
use App\Models\ShoppingList;
use Illuminate\Http\Request;

class ShoppingListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ShoppingListResource::collection(ShoppingList::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, ShoppingList $shoppinglist)
    {
        //
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
