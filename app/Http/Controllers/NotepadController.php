<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNotepad;
use App\Http\Requests\UpdateNotepad;
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $notepad = $user->notepad;
        return [
            'notepad' => $notepad,
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
    public function store(StoreNotepad $request)
    {
        $attributes = $request->validated();
        try {
            $notepad = new Notepad;
            $notepad->text = $attributes['text'];
            $notepad->user_id = $request->user()->id;
            $notepad->save();
            return response($notepad, 201);
        } catch (\Exception $e) {
            $errors = $e->getMessage();
            return response($errors, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notepad  $notepad
     * @return \Illuminate\Http\Response
     */
    public function show(Notepad $notepad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notepad  $notepad
     * @return \Illuminate\Http\Response
     */
    public function edit(Notepad $notepad)
    {
        //
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
        try {
            if ($attributes['text']) {
                $notepad->text = $attributes['text'];
                $notepad->save();
            } else {
                $notepad->delete();
            }
            return response('Success.', 200);
        } catch (\Exception $e) {
            $errors = $e->getMessage();
            return response($errors, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notepad  $notepad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notepad $notepad)
    {
        //
    }
}
