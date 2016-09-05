<?php

class Report extends Eloquent {

  public $timestamps = false;

  protected $table = "reports";
  protected $fillable = [ 'photo_id', 'type', 'user_id', 'observation' ];
  
  public function user()
  {
    return $this->belongsTo('User');
  }

  public function photo()
  {
    return $this->belongsTo('Photo');
  }
  
  public static function getFirstOrCreate($user, $photo, $type, $observation) {
    return self::firstOrCreate([
        'user_id' => $user->id,
        'photo_id' => $photo->id,
        'type' => $type,
        'observation' => $observation
      ]);
  }

}