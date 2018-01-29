<?php
namespace modules\moderation\controllers;

use lib\log\EventLogger;
use modules\moderation\models\Suggestion;
use modules\moderation\models\ModerationType;
use modules\moderation\models\Moderator;
use User;

class ModerationsController extends \BaseController {
	public function __construct() {
    // filtering if user is logged out, redirect to login page
    $this->beforefilter('auth',
      array('except' => ['']));
  }

  /**
   * Save moderator
   */
  public static function createModerator($userId, $moderationTypeId) {
    $userModerator = new Moderator();
    $userModerator->user_id = $userId;
    $userModerator->moderation_type_id = $moderationTypeId;

    // Saving moderator
    $userModerator->save();
  }

  /**
   * Checks the moderation status for a user
   * If there's a new moderation status for the user, update
   */
  public function updateUserModerationStatus() {
		$input = \Input::all();
		$userId = $input['user_id'];
		$suggestions = Suggestion::where('user_id', '=', $userId)->where('accepted', '=', 1)->get();
    $numPoints = 0;
    $updated = false;

    // Counting the number of points that the user has
    foreach($suggestions as $suggestion) {
      $numPoints += $suggestion->numPoints();
    }

    // Checking if the user has a moderation type based on his points
    $moderationTypeId = ModerationType::moderationTypeIdFromPoint($numPoints);

    // User data
    $user = User::where('id', '=', $userId)->first();
    // If the user don't exist, return error
    if ($user == null) {
      return \Response::json((object)[
        'status' => 'error',
        'error' => (array)[
          'User doesn\'t exist',
        ],
      ]);
    }

    // Checking if the user has a moderator level
    $userModerator = Moderator::where('user_id', '=', $userId)->first();

    // If we have a moderation_type_id for the user
    if ($moderationTypeId != null) {
      if ($userModerator == null) {
        // If the user is not a moderator, create one
        ModerationsController::createModerator($userId, $moderationTypeId);
        // Setting that we've updated the moderation status
        $updated = true;
      } else {
        // Here, we check if the moderationTypeId is different, if it's true, update
        if ($userModerator->moderation_type_id != $moderationTypeId) {
          // Update userModerator
          $userModerator->moderation_type_id = $moderationTypeId;
          $userModerator->save();
          // Setting that we've updated the moderation status
          $updated = true;
        }
      }
    }

		return \Response::json((object)[
      'status' => 'ok',
      'result' => (object)[
        'updated' => $updated,
        'user' => $user,
        'moderator' => $userModerator,
      ]
		]);
  }
}
