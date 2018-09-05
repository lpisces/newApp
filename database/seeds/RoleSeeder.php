<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
		// Reset cached roles and permissions
    app()['cache']->forget('spatie.permission.cache');

    // create permissions

		// user permissions
    Permission::create(['name' => 'create user']);
    Permission::create(['name' => 'edit profile']);
    Permission::create(['name' => 'disable user login']);
    Permission::create(['name' => 'enable user login']);

		// role manage permissions
    Permission::create(['name' => 'create role']);
    Permission::create(['name' => 'delete role']);
    Permission::create(['name' => 'edit role']);

		// priv permissions
    Permission::create(['name' => 'assign role']);
    Permission::create(['name' => 'revoke role']);
		
		$admin = Role::create(['name' => 'admin']);
		$admin->givePermissionTo(Permission::all());

		$user = Role::create(['name' => 'user']);
		$user->givePermissionTo('edit profile');
  }
}
