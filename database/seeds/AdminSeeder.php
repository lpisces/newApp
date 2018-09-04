<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
	DB::table('users')->insert([
          'name' => "zebrapool",
          'email' => 'zebrapool@gmail.com',
          'password' => bcrypt('zebrapool'),
    ]);
  }
}
