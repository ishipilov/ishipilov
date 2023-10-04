<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInvitation;
use App\Http\Requests\UpdateInvitation;
use App\Http\Requests\RegisterInvitation;
use App\Mail\RegisterInvitation as MailRegisterInvitation;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->authorizeResource(Invitation::class, 'invitation');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invitations = Invitation::all();
        return view('invitations.index')->withInvitations($invitations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invitations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvitation $request)
    {
        $attributes = $request->validated();
        try {
            $invitation = new Invitation;
            $invitation->name = $attributes['name'];
            $invitation->email = $attributes['email'];
            $invitation->text = $attributes['text'];

            $hash = Str::random(16);
            $invitation->hash = $hash;

            $invitation->user_id = $request->user()->id;
            $invitation->save();

            Mail::to($invitation->email)->send(new MailRegisterInvitation($invitation));

            return redirect()->route('invitations.index')->withStatus("Success.");
        } catch (\Exception $e) {
            $errors = $e->getMessage();
            return back()->withErrors($errors);
        }
    }

    public function resend(Request $request, Invitation $invitation)
    {
        $this->authorize('resend', $invitation);
        //return (new MailRegisterInvitation($invitation))->render();
        Mail::to($invitation->email)->send(new MailRegisterInvitation($invitation));

        return redirect()->route('invitations.index')->withStatus("Success.");
    }

    public function register(RegisterInvitation $request, Invitation $invitation, String $hash)
    {
        $this->authorize('register', [$invitation, $hash]);
        $attributes = $request->validated();
        $user = User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
            'api_token' => Str::random(60),
        ]);
        Auth::loginUsingId($user->id);
        $invitation->target_user_id = $user->id;
        $invitation->save();
        return redirect()->route('home')->withStatus("Welcome.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function show(Invitation $invitation)
    {
        //
    }

    public function show_with_hash(Invitation $invitation, String $hash)
    {
        $this->authorize('viewWithHash', [$invitation, $hash]);
        return view('invitations.show')
        ->withInvitation($invitation)
        ->withHash($hash);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function edit(Invitation $invitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvitation $request, Invitation $invitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invitation  $invitation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invitation $invitation)
    {
        try {
            $invitation->delete();
            return redirect()->route('invitations.index')->withStatus("Success.");
        } catch (\Exception $e) {
            $errors = $e->getMessage();
            return back()->withErrors($errors);
        }
    }
}
