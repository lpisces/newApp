<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\User;


class UserRepository 
{

	protected $user;

	public function __construct(User $user) 
  {
		$this->user = $user;
  }

	public function create($data)
	{
		return User::create($data);
	}

}
