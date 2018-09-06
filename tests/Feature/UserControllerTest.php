<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class UserControllerTest extends TestCase
{

	use DatabaseTransactions;

  /**
   * create user as admin role.
   *
   * @return void
   */
  public function testCreateUser()
  {

		$response = $this->withHeaders([
        'Accept' => 'application/x.jt.v1+json',
    ])->json('POST', '/api/login', ['name' => 'admin', 'password' => '123456']);
		
		$response
        ->assertStatus(200)
        ->assertJsonStructure([
					'access_token',
					'expires_in',
					'token_type',
        ]);
		$access_token = $response->json()["access_token"];
	
		$response = $this->withHeaders([
    	'Accept' => 'application/x.jt.v1+json',
			'Authorization' => 'Bearer '. $access_token,
		])->json('PUT', '/api/user', ['name' => 'guest2', 'password' => '123456']);

		$response
			->assertStatus(200)
			->assertJsonStructure([
				'data',
				'meta',
			]);

		$response = $this->withHeaders([
        'Accept' => 'application/x.jt.v1+json',
    ])->json('POST', '/api/login', ['name' => 'guest', 'password' => '123456']);
		
		$response
        ->assertStatus(200)
        ->assertJsonStructure([
					'access_token',
					'expires_in',
					'token_type',
        ]);
		$access_token = $response->json()["access_token"];
	
		$response = $this->withHeaders([
    	'Accept' => 'application/x.jt.v1+json',
			'Authorization' => 'Bearer '. $access_token,
		])->json('PUT', '/api/user', ['name' => 'guest2', 'password' => '123456']);

		$response->assertStatus(422);
  }
}
