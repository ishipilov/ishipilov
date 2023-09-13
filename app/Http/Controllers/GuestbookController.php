<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGuestbook;
use App\Http\Requests\UpdateGuestbook;
use App\Models\Guestbook;
use Illuminate\Http\Request;

class GuestbookController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->authorizeResource(Guestbook::class, 'guestbook');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guestbook = Guestbook::ordered()->get();
        return view('guestbook.index')->withGuestbook($guestbook);
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
    public function store(StoreGuestbook $request)
    {
        $attributes = $request->validated();
        try {
            $guestbook = new Guestbook;
            $guestbook->text = $attributes['text'];
            $guestbook->save();
            return redirect()->route('home')->withStatus("Success.");
        } catch (\Exception $e) {
            $errors = $e->getMessage();
            return back()->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guestbook  $guestbook
     * @return \Illuminate\Http\Response
     */
    public function show(Guestbook $guestbook)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Guestbook  $guestbook
     * @return \Illuminate\Http\Response
     */
    public function edit(Guestbook $guestbook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Guestbook  $guestbook
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGuestbook $request, Guestbook $guestbook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Guestbook  $guestbook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guestbook $guestbook)
    {
        //
    }
}
