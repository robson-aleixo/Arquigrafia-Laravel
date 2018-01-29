<?php
namespace modules\moderation\models;

class ModerationType extends \Eloquent {
	protected $fillable = ['moderation_type'];

  // Constants
  const CURATOR_MIN_POINTS = 150;
  const MODERATOR_MIN_POINTS = 75;

	public function moderators() {
		return $this->hasMany('Moderator');
	}

  /**
   * Business rule function - Define the moderation id for a given number of points
   * @param  {Number}  points  The total number of points
   * @return  {Number}  Returns the id for moderation or null if the user does not have one
   */
  public static function moderationTypeIdFromPoint($totalPoints) {
    $moderationId = null;

    if ($totalPoints >= ModerationType::CURATOR_MIN_POINTS) {
      // If the user has more than 150 points, he/she is a curator
      $moderationId = ModerationType::where('moderation_type', '=', 'curator')->first()->id;
    } else if ($totalPoints >= ModerationType::MODERATOR_MIN_POINTS) {
      // If the user has more than 75 points, he/she is a moderator
      $moderationId = ModerationType::where('moderation_type', '=', 'moderator')->first()->id;
    }

    return $moderationId;
  }
}
