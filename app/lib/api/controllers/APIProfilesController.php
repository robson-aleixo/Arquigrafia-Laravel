<?php 
namespace lib\api\controllers;

class APIProfilesController extends \BaseController {

	public function getProfile($id) {
		$user = \User::find($id);
		return \Response::json(array_merge($user->toArray(), ["followers" => count($user->followers), "following" => count($user->following), "photos" => count($user->photos)]));
	}

	public function getUserPhotos($id) {
		$user_photos = \DB::table('photos')->whereNull('deleted_at')->whereNull('institution_id')->where('user_id', '=', $id)->orderBy('created_at', 'desc')->take(20)->get();
		return \Response::json($user_photos);
	}

	public function getMoreUserPhotos($id) {
		$input = \Input::all();
		$max_id = $input["max_id"];

		$user_photos = \DB::table('photos')->whereNull('deleted_at')->whereNull('institution_id')->where('user_id', '=', $id)->where('id', '<', $max_id)->orderBy('created_at', 'desc')->take(20)->get();
		return \Response::json($user_photos);
	}

	public function getFollowers($id) {
		$user = \User::find($id);
		return \Response::json($user->followers);
	}

	public function getFollowing($id) {
		$user = \User::find($id);
		return \Response::json(["users" => $user->following, "institutions" => $user->followingInstitution]);
	}
}