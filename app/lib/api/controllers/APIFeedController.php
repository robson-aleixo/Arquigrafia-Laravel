<?php 
namespace lib\api\controllers;

class APIFeedController extends \BaseController {

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//Seleciona as fotos dos seguidores do usuário ordenados pela ordem de update 
		return \Response::json(\User::join('friendship as fs', 'fs.following_id', '=', 'users.id')
			->join('users as f', 'f.id', '=', 'fs.followed_id')
			->join('photos as p', 'p.user_id', '=', 'f.id')
			->select('f.id as user_id', 'f.photo as avatar', 'p.id as photo_id', 'p.name', 'p.nome_arquivo')
			->where('users.id', '=', $id)
			->whereNull('p.deleted_at')
			->orderBy('p.updated_at')->take(20)->get());
	}

	public function loadMore() {
		$input = \Input::all();
		$max_id = $input["max_id"];
		$min_id = $input["min_id"];

		return \Response::json(\User::join('friendship as fs', 'fs.following_id', '=', 'users.id')
			->join('users as f', 'f.id', '=', 'fs.followed_id')
			->join('photos as p', 'p.user_id', '=', 'f.id')
			->select('f.id as user_id', 'f.photo as avatar', 'p.id as photo_id', 'p.name', 'p.nome_arquivo')
			->where('users.id', '=', $id)
			->where('p.id', '<', $max_id)
			->where('p.id', '>', $min_id)
			->whereNull('p.deleted_at')
			->orderBy('p.updated_at')->take(20)->get());
	}
}