<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$permission_admin = Permission::where('name', 'admin')->first();
		if (! $permission_admin) $permission_admin = Permission::create(['name' => 'admin']);

		$permission_login_as = Permission::where('name', 'login as')->first();
		if (! $permission_login_as) $permission_login_as = Permission::create(['name' => 'login as']);

		$permission_assign_role = Permission::where('name', 'assign role')->first();
		if (! $permission_assign_role) $permission_assign_role = Permission::create(['name' => 'assign role']);

		$permission_remove_role = Permission::where('name', 'remove role')->first();
		if (! $permission_remove_role) $permission_remove_role = Permission::create(['name' => 'remove role']);

		$permission_chat = Permission::where('name', 'chat')->first();
		if (! $permission_chat) $permission_chat = Permission::create(['name' => 'chat']);

		$permission_memos = Permission::where('name', 'memos')->first();
		if (! $permission_memos) $permission_memos = Permission::create(['name' => 'memos']);

		$permission_passwords = Permission::where('name', 'passwords')->first();
		if (! $permission_passwords) $permission_passwords = Permission::create(['name' => 'passwords']);

		$permission_posts = Permission::where('name', 'posts')->first();
		if (! $permission_posts) $permission_posts = Permission::create(['name' => 'posts']);

		$permission_uploads = Permission::where('name', 'uploads')->first();
		if (! $permission_uploads) $permission_uploads = Permission::create(['name' => 'uploads']);


		$role_admin = Role::where('name', 'admin')->first();
		if (! $role_admin) $role_admin = Role::create(['name' => 'admin']);

		$role_roles_manager = Role::where('name', 'roles manager')->first();
		if (! $role_roles_manager) $role_roles_manager = Role::create(['name' => 'roles manager']);

		$role_user = Role::where('name', 'user')->first();
		if (! $role_user) $role_user = Role::create(['name' => 'user']);

		
        $role_admin->syncPermissions([$permission_admin]);
        $role_roles_manager->syncPermissions([
			$permission_assign_role,
			$permission_remove_role
		]);
		$role_user->syncPermissions([
			$permission_chat,
			$permission_memos,
			$permission_passwords,
			$permission_posts,
			$permission_uploads,
		]);
    }
}
