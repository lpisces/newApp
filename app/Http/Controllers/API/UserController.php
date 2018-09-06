<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Transformers\UserTransformer;

class UserController extends BaseController
{

	protected $user;

	protected $rules;

	public function __construct(UserRepository $user)
	{
		$this->user = $user;
		$this->rules = [
			'name' => ['required', 'alpha_num', 'between:4,255', 'unique:users,name'],
			'email' => ['email',],
			'password' => ['required', 'between:4,32']
		];	

	}

	protected function checkPermission()
	{
		$user = app('Dingo\Api\Auth\Auth')->user();
		if (!$user->hasRole('admin')) {
			throw new Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException("No permission");
		}
	}

  /**
   * create new user
   *
   * @return \Illuminate\Http\JsonResponse
   */
	public function store()
	{
		$this->checkPermission();

		$payload = app('request')->only('name', 'email', 'password');
		$validator = app('validator')->make($payload, $this->rules);

		if ($validator->fails()) {
			throw new \Dingo\Api\Exception\StoreResourceFailedException('Could not create new user.', $validator->errors());
			return;
		}
		
		return $this->response->item($this->user->create($payload), new UserTransformer)->setMeta(["code" => 200, "msg" => "ok"]);
	}
}
