<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
		$admin = App\User::create(
			[
				'name' => 'admin',
				'email' => 'admin@admin.com',
				'password' => bcrypt('123456'),
			]
		);

		$admin->assignRole('admin');
  }
}
