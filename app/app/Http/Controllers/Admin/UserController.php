<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->authorizeResource(User::class, 'user');
	}

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = User::all();
    return view('admin.users.index')->withUsers($users);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.users.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreUser $request)
  {
    $validated = $request->validated();
    try {
      $user = new User;
      $user->name = $validated['name'];
      $user->email = $validated['email'];
      $user->password = Hash::make(Str::random(10));
      $user->save();
      return redirect()->route('admin.users.edit', $user)->withStatus("Success.");
    } catch (\Exception $e) {
      $errors = $e->getMessage();
      return back()->withErrors($errors);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function show(User $user)
  {
    return view('admin.users.show')->withUser($user);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function edit(User $user)
  {
    return view('admin.users.edit')->withUser($user);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateUser $request, User $user)
  {
    $validated = $request->validated();
    try {
      $user->name = $validated['name'];
      $user->email = $validated['email'];
      $user->save();
      return redirect()->route('admin.users.edit', $user)->withStatus("Success.");
    } catch (\Exception $e) {
      $errors = $e->getMessage();
      return back()->withErrors($errors);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function destroy(User $user)
  {
    try {
      $user->delete();
      return redirect()->route('admin.users.index')->withStatus("Success.");
    } catch (\Exception $e) {
      $errors = $e->getMessage();
      return back()->withErrors($errors);
    }
  }

	/**
	 * Login as the specified user.
	 *
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function loginAs(User $user)
	{
		$this->authorize('loginAs', $user);
		Auth::loginUsingId($user->id);
		return redirect()->route('home')->withStatus("Logged in as $user->name.");
	}

	/**
	 * Assign role to the user.
	 *
   * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function assignRole(Request $request, User $user)
	{
    try {
      $role = $request->role;
      if ($user->hasRole($role)) {
        return back()->withErrors("$user->name has $role role.");
      }
      $this->authorize('assignRole', [$user, $role]);
      $user->assignRole($role);
      return redirect()->route('admin.users.edit', $user)->withStatus("Success.");
    } catch (\Exception $e) {
      $errors = $e->getMessage();
      return back()->withErrors($errors);
    }
	}

	/**
	 * Remove role from the user.
	 *
   * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\User  $user
	 * @return \Illuminate\Http\Response
	 */
	public function removeRole(Request $request, User $user, Role $role)
	{
    try {
      $this->authorize('removeRole', [$user, $role]);
      $user->removeRole($role);
      return redirect()->route('admin.users.edit', $user)->withStatus("Success.");
    } catch (\Exception $e) {
      $errors = $e->getMessage();
      return back()->withErrors($errors);
    }
	}
}
