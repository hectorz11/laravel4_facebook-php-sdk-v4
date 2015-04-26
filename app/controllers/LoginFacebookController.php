<?php

class LoginFacebookController extends BaseController {

	private $fb;

	public function __construct(FacebookHelper $fb)
	{
		$this->fb = $fb;
	}

	public function login() 
	{
		return Redirect::to($this->fb->getUrlLogin());
	}

	public function callback()
	{
		if( !$this->fb->generateSessionFromRedirect()) {
			//session
			return Redirect::to('/')->with('mensaje',"Error de conexion con facebook");
		}
		
		$user_fb = $this->fb->getGraph();
		
		if(empty($user_fb)) {
			return Redirect::to('/')->with('mensaje','Data de facebook.');
		}
		$profile = Profile::whereUidFb($user_fb->getProperty('id'))->first();

		if(empty($profile)) {
			$user = new User;
			$user->setHasher(new Cartalyst\Sentry\Hashing\NativeHasher);
			$user->first_name = $user_fb->getProperty('first_name');
			$user->last_name = $user_fb->getProperty('last_name');
			$user->email = $user_fb->getProperty('email');
			$user->password = Hash::make($user_fb->getProperty('username'));
			$user->activated = true;
			$user->save();

			$profile = new Profile();
			$profile->birthday = $user_fb->getProperty('birthday');
			$profile->photo = 'http://graph.facebook.com/'.$user_fb->getProperty('id').'/picture?type=large';
			$profile->uid_fb = $user_fb->getProperty('id');
			$profile->user_id = $user->id;
			$profile->status = 1;
			$profile = $user->profiles()->save($profile);
		}
		$profile->access_token_fb = $this->fb->getToken();
		$profile->save();

		$user = Sentry::findUserById($profile->users->id);

		Sentry::login($user,false);
		return Redirect::to('/')->with('mensaje', 'Login facebook');
	}
}