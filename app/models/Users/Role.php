<?php

class Role extends Eloquent {

  public $timestamps = false;

  protected $fillable = ['name'];

  public function users() {
     return $this->belongsToMany('User', 'users_roles', 'user_id', 'role_id');
  }

  public static function usersRoles() {
  }

  public static function updateUserIdInRoles($accountFrom, $accountTo){
      //DB::table('users_roles')->where('user_id', '=', $accountFrom->id)->update(array('user_id' => $accountTo->id));
      Role::where('user_id', '=', $accountFrom->id)->update(array('user_id' => $accountTo->id));
  }  
  
  public static function proba(){
      $string = "Ok";
      return $string;
  }
 

}