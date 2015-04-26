<?php

class User extends Cartalyst\Sentry\Users\Eloquent\User
{
	public function profiles()
	{
		return $this->hasOne('Profile','user_id');
	}
}