<?php

class Profile extends Eloquent {

	protected $table = 'profiles';

	protected $fillable = array('nick_name','photo','birthday','uid_fb','access_token_fb','user_id');

	public function users()
	{
		return $this->belongsTo('User','user_id');
	}

}