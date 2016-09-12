<?php

class ReportController extends \BaseController {

	public function index()
	{
		//$tags = Report::all();
		//return $tags;
	}

	public function reportPhoto() { 
		
	Input::flash();
    $input = Input::all();
    
	$rules = array(
        'reportTypes' => 'required',
        '_photo' => 'required'
    ); 
    $validator = Validator::make($input, $rules);   

	if ($validator->fails()) {
      $messages = $validator->messages();
      return Redirect::to('/photos/'.$input["_photo"])->withErrors($messages);//TODO
    } else {

		$photo_id = $input["_photo"];
        $user = Auth::user();
		$photo = Photo::find($photo_id);
		$types =$input["reportTypes"];
        $comment =$input["reportComment"];

        $commaSeparatedTypes = implode(",", array_values($types));

		$result = Report::getFirstOrCreate($user, $photo, $commaSeparatedTypes, $comment);
    
    	return Redirect::to('/photos/'.$photo->id)->with('message', '<strong>Imagem reportada com sucesso</strong>');

    	
    }
	
	}

	public function showModalReportPhoto($id) {
		
		return Response::json(View::make('photos.form-report')
			->with(['photo_id' => $id])
			->render());
	}


}
