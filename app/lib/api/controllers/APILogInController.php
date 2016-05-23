<?php
namespace lib\api\controllers;

class APILogInController extends \BaseController {

	public function __construct()
	{
    	$this->afterFilter(function ($route, $req, $resp) {
    	$resp->headers->set('Access-Control-Allow-Origin', '*');
    	return $resp;
		});
	}

	public function verify_credentials() {
		$input = \Input::all(); 
		if(\Auth::validate(['login' => $input["login"], 'password' => $input["password"]])) {
			$token = \User::userInformation($input["login"])->remember_token;
			return \Response::json(['login' => $input["login"], 'token' => $token, 'valid' => 'true']);
		}
		return \Response::json(['login' => $input["login"], 'token' => '', 'valid' => 'false']);
	}
}
