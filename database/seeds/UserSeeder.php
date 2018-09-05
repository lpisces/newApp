<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
		$guest = App\User::create(
			[
				'name' => 'guest',
				'email' => 'guest@guest.com',
				'password' => bcrypt('123456'),
			]
		);

		$guest->assignRole('user');
  }
}
