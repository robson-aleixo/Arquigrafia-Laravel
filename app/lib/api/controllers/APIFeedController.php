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
			->select('f.id', 'p.id as photo_id', 'p.name', 'p.nome_arquivo')
			->where('users.id', '=', $id)
			->orderBy('p.updated_at')->get());
	}
}