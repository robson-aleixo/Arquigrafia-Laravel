<?php
namespace lib\api\controllers;
use Photo;

class APIPhotosController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return \Response::json(\Photo::all()->toArray());
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
		$input = \Input::all();
		
		$rules = array( 
			'photo_name' => 'required',
	        'photo_imageAuthor' => 'required',
	        'tags' => 'required',
	        'photo_country' => 'required',  
	        'authorized' => 'required',
	        'photo' => 'max:10240|required|mimes:jpeg,jpg,png,gif',
	        'photo_imageDate' => 'date_format:d/m/Y|regex:/[0-9]{2}\/[0-9]{2}\/[0-9]{4}/'
      	);
		$validator = \Validator::make($input, $rules);
		if ($validator->fails()) {
			return $validator->messages();
		}
		
		if (\Input::hasFile('photo') and \Input::file('photo')->isValid()) {
        	$file = \Input::file('photo');
        
			/* Armazenamento */
			$photo = new Photo;

			if ( !empty($input["photo_aditionalImageComments"]) )
	        //$photo->aditionalImageComments = $input["photo_aditionalImageComments"];
	      	$photo->allowCommercialUses = $input["photo_allowCommercialUses"];
	        $photo->authorized = $input["authorized"];
	        $photo->allowModifications = $input["photo_allowModifications"];
	        if( !empty($input["photo_city"]) )
	          $photo->city = $input["photo_city"];
	        $photo->country = $input["photo_country"];
	        if ( !empty($input["photo_description"]) )
	          $photo->description = $input["photo_description"];
	        if ( !empty($input["photo_district"]) )
	          $photo->district = $input["photo_district"];
	        if ( !empty($input["photo_imageAuthor"]) )
	          $photo->imageAuthor = $input["photo_imageAuthor"];
	        $photo->name = $input["photo_name"];
	        if ( !empty($input["photo_state"]) )
	          $photo->state = $input["photo_state"];
	        if ( !empty($input["photo_street"]) )
	          $photo->street = $input["photo_street"];
	      	$photo->user_id = $input["user_id"];
	      	$photo->dataUpload = date('Y-m-d H:i:s');
	      	$photo->nome_arquivo = $file->getClientOriginalName();

			$photo->save();

			$tags = str_replace("\"", "", $input["tags"]);
			$tags = str_replace("[", "", $input["tags"]);
			$tags = str_replace("]", "", $input["tags"]);

			return $tags;
			//return "Tags: ". $tags . " Type: " . gettype($tags);
			$tags = \PhotosController::formatTags($tags);
			$tagsSaved = \PhotosController::saveTags($tags,$photo);
              
            if(!$tagsSaved){ 
                  $photo->forceDelete();
                  $messages = array('tags'=>array('Inserir pelo menos uma tag'));                  
                  return "Tags error";                  
            }
			//Photo e salva para gerar ID automatico

			$ext = $file->getClientOriginalExtension();
      		$photo->nome_arquivo = $photo->id.".".$ext;

      		$photo->save();

      		$metadata       = \Image::make(\Input::file('photo'))->exif();
  	        // $public_image   = \Image::make(\Input::file('photo'))->rotate($angle)->encode('jpg', 80);
  	        // $original_image = \Image::make(\Input::file('photo'))->rotate($angle);
  	        $public_image   = \Image::make(\Input::file('photo'))->encode('jpg', 80);
  	        $original_image = \Image::make(\Input::file('photo'));
  
  	        $public_image->widen(600)->save(public_path().'/arquigrafia-images/'.$photo->id.'_view.jpg');
	        $public_image->heighten(220)->save(public_path().'/arquigrafia-images/'.$photo->id.'_200h.jpg');
	        $public_image->fit(186, 124)->encode('jpg', 70)->save(public_path().'/arquigrafia-images/'.$photo->id.'_home.jpg');
	        $public_image->fit(32,20)->save(public_path().'/arquigrafia-images/'.$photo->id.'_micro.jpg');
	        $original_image->save(storage_path().'/original-images/'.$photo->id."_original.".strtolower($ext));

	        return $photo->id;

		}
		return "No image sent";
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$photo = \Photo::find($id);
		$sender = \User::find($photo->user_id);
		if (!is_null($photo->institution_id)) {
			$sender = \Institution::find($photo->institution_id);
		}
		$license = \Photo::licensePhoto($photo);
		$authorsList = $photo->authors->lists('name');
		return \Response::json(["photo" => $photo, "sender" => $sender, "license" => $license, "authors" => $authorsList]);
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
