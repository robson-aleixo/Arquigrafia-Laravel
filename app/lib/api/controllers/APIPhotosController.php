<?php
namespace lib\api\controllers;

class APIPhotosController extends \BaseController {


	public function __construct()
	{
    	$this->afterFilter(function ($route, $req, $resp) {
    	$resp->headers->set('Access-Control-Allow-Origin', '*');
    	return $resp;
		});
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$all_photos = \Photo::all();
		return \Response::json($all_photos->toArray());
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		/* Validação do input */
		$input = Input::all();
		$rules = array( 'photo_name' => 'required',
      					'photo_imageAuthor' => 'required',
      					'tags' => 'required',
      					'photo_country' => 'required', 
      					);
		$validator = Validator::make($input, $rules);
		if ($validator->fails()) {
			return ;
		}
		/* Armazenamento */
		$photo = new Photo;
		
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return \Response::json(\Photo::find($id)->toArray());
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
