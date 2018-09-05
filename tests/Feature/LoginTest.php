<?php

namespace Tests\Feature;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * login test. expect succeed
     *
     * @return void
     */
    public function testLoginSucc()
    {
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
    }

    /**
     * login test. expect failed
     *
     * @return void
     */
    public function testLoginFailed()
    {
				$response = $this->withHeaders([
            'Accept' => 'application/x.jt.v1+json',
        ])->json('POST', '/api/login', ['username' => 'test1', 'password' => 'testtest']);

				$response
            ->assertStatus(401);
    }


    /**
     * guard test. expect succeed
     *
     * @return void
     */
		public function testAccessSucc()
		{
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
        ])->json('GET', '/api/whoami');

				//var_dump($response->json());
				$response
            ->assertStatus(200);
		}

    /**
     * guard test. expect failed
     *
     * @return void
     */
		public function testAccessFailed()
		{
				$access_token = 'abc';

				$response = $this->withHeaders([
            'Accept' => 'application/x.jt.v1+json',
						'Authorization' => 'Bearer '. $access_token,
        ])->json('GET', '/api/whoami');

				//var_dump($response->json());
				$response
            ->assertStatus(401);
		}
}
