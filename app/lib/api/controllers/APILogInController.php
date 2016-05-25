<?php
namespace lib\api\controllers;

class APILogInController extends \BaseController {

	public function verify_credentials() {
		$input = \Input::all(); 
		if(\Auth::validate(['login' => $input["login"], 'password' => $input["password"]])) {
			$user = \User::where('login', '=', $input["login"])->first();
			$user->mobile_token = \Hash::make(str_random(10));
			$user->save();
			return \Response::json(['login' => $input["login"], 'token' => $user->mobile_token, 'valid' => 'true']);
		}
		return \Response::json(['login' => $input["login"], 'token' => '', 'valid' => 'false']);
	}

	public function validate_mobile_token() {
		$input = \Input::all();
		$user = User::where('login', '=', $input["login"])->first();
		if(!is_null($user)) {
			if($input["token"] == $user->mobile_token) {
				return \Response::json(['auth' => 'true']);
			}
		}
		return \Response::json(['auth' => 'false']);
	}

	public function log_out() {
		$input = \Input::all();
		$user = User::where('login', '=', $input["login"])->first();
		if(!is_null($user)) {
			if($input["token"] == $user->mobile_token) {
				$user->mobile_token = null;
				$user->save();
				return \Response::json(['logged_out' => 'true']);
			}
		}
		return \Response::json(['logged_out' => 'false']);
	}
}
