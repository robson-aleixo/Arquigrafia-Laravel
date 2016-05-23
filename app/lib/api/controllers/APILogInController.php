<?php
namespace lib\api\controllers;

class APILogInController extends \BaseController {

	public function verify_credentials() {
		$input = \Input::all(); 
		if(\Auth::validate(['login' => $input["login"], 'password' => $input["password"]])) {
			$token = \User::userInformation($input["login"])->remember_token;
			return \Response::json(['login' => $input["login"], 'token' => $token, 'valid' => 'true']);
		}
		return \Response::json(['login' => $input["login"], 'token' => '', 'valid' => 'false']);
	}
}
