<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreNotepad;
use App\Http\Requests\UpdateNotepad;
use App\Http\Resources\NotepadApiResource;
use App\Models\Notepad;
use Illuminate\Http\Request;

class NotepadController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->authorizeResource(Notepad::class, 'notepad');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $notepad = $user->notepad;
        return NotepadApiResource::collection($notepad);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNotepad $request)
    {
        $attributes = $request->validated();
        $user = $request->user();
        $notepad = new Notepad;
        $notepad->text = $attributes['text'];
        $notepad->user()->associate($user);
        $notepad->save();
        return new NotepadApiResource($notepad);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notepad  $notepad
     * @return \Illuminate\Http\Response
     */
    public function show(Notepad $notepad)
    {
        return new NotepadApiResource($notepad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notepad  $notepad
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateNotepad $request, Notepad $notepad)
    {
        $attributes = $request->validated();
        $user = $request->user();
        $notepad->text = $attributes['text'];
        $notepad->save();
        return new NotepadApiResource($notepad);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notepad  $notepad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notepad $notepad)
    {
        $notepad->delete();
        return response(null, 204);
    }
}
