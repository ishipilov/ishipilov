<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
    return view('admin.permissions.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
    $validated = $request->validate([
      'name' => [ 'required', 'string', 'unique:permissions']
    ]);
    try {
      $permission = new Permission;
      $permission->name = $validated['name'];
      $permission->save();
      return redirect()->route('admin.roles.index')->withStatus("Success.");
    } catch (\Exception $e) {
      $errors = $e->getMessage();
      return back()->withErrors($errors);
    }
    return $validated;
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Permission $permission)
	{
    return view('admin.permissions.edit')->withPermission($permission);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Permission $permission)
	{
    $validated = $request->validate([
      'name' => [ 'required', 'string', 'unique:roles']
    ]);
    try {
      $permission->name = $validated['name'];
      $permission->save();
      return redirect()->route('admin.permissions.edit', $permission)->withStatus("Success.");
    } catch (\Exception $e) {
      $errors = $e->getMessage();
      return back()->withErrors($errors);
    }
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Permission $permission)
	{
    try {
      $permission->delete();
      return redirect()->route('admin.roles.index')->withStatus("Success.");
    } catch (\Exception $e) {
      $errors = $e->getMessage();
      return back()->withErrors($errors);
    }
	}
}
