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
		$role_admin = Role::where('name', 'admin')->first();
		if (! $role_admin) $role_admin = Role::create(['name' => 'admin']);

		$role_user = Role::where('name', 'user')->first();
		if (! $role_user) $role_user = Role::create(['name' => 'user']);

		$role_posts = Role::where('name', 'posts')->first();
		if (! $role_posts) $role_posts = Role::create(['name' => 'posts']);

		$role_uploads = Role::where('name', 'uploads')->first();
		if (! $role_uploads) $role_uploads = Role::create(['name' => 'uploads']);

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

		$permission_posts = Permission::where('name', 'posts')->first();
		if (! $permission_posts) $permission_posts = Permission::create(['name' => 'posts']);

		$permission_uploads = Permission::where('name', 'uploads')->first();
		if (! $permission_uploads) $permission_uploads = Permission::create(['name' => 'uploads']);

        $role_admin->syncPermissions([$permission_assign_role, $permission_remove_role]);
		$role_user->syncPermissions([$permission_chat, $permission_memos]);
        $role_posts->syncPermissions([$permission_posts]);
        $role_uploads->syncPermissions([$permission_uploads]);
    }
}
