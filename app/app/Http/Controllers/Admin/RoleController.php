<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $permissions = Permission::orderBy('name')->get();
    $roles = Role::orderBy('name')->get();
    return view('admin.roles.index')
    ->withPermissions($permissions)
    ->withRoles($roles);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    $allPermissions = Permission::orderBy('name')->get();
    return view('admin.roles.create')
    ->withAllPermissions($allPermissions);
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
      'name' => [ 'required', 'string', 'unique:roles'],
      'permissions' => [ 'required', 'array']
    ]);
    try {
      $role = new Role;
      $role->name = $validated['name'];
      $role->save();
      $role->syncPermissions($validated['permissions']);
      return redirect()->route('admin.roles.edit', $role)->withStatus("Success.");
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
  public function edit(Role $role)
  {
    $allPermissions = Permission::orderBy('name')->get();
    return view('admin.roles.edit')
    ->withRole($role)
    ->withAllPermissions($allPermissions);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Role $role)
  {
    $validated = $request->validate([
      'name' => [ 'required', 'string', 'unique:roles'],
      'permissions' => [ 'required', 'array']
    ]);
    try {
      $role->name = $validated['name'];
      $role->save();
      $role->syncPermissions($validated['permissions']);
      return redirect()->route('admin.roles.edit', $role)->withStatus("Success.");
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
  public function destroy(Role $role)
  {
    try {
      $role->delete();
      return redirect()->route('admin.roles.index')->withStatus("Success.");
    } catch (\Exception $e) {
      $errors = $e->getMessage();
      return back()->withErrors($errors);
    }
  }
}
