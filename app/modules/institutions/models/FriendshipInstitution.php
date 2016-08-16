<?php
namespace modules\institutions\models;
use modules\institutions\models\FriendshipInstitution as FriendshipInstitution;
use modules\institutions\models\Institution;
use User;

class FriendshipInstitution extends \Eloquent {

	protected $fillable = ['following_user_id','institution_id'];
	protected $table = 'friendship_institution';

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function institution()
	{
		return $this->belongsTo('Institution');
	}

  	public static function updateUserIdInFriendshipInstitution($accountFrom, $accountTo)
	{ 
		FriendshipInstitution::where('following_user_id', '=', $accountFrom->id)
      ->update(array('following_user_id' => $accountTo->id));    
  	} 

}