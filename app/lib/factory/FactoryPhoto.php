<?php
namespace lib\factory;
//use app\models\Photos\Photo as Photo;
use Photo;
use Auth;

class FactoryPhoto {

	public static function createPhoto($input,$file)
	{
		$photo = new Photo();
        if ( !empty($input["photo_aditionalImageComments"]) )
            $photo->aditionalImageComments = $input["photo_aditionalImageComments"];
        $photo->allowCommercialUses = $input["photo_allowCommercialUses"];
        $photo->allowModifications = $input["photo_allowModifications"];
        $photo->city = $input["photo_city"];
        $photo->country = $input["photo_country"];
        if ( !empty($input["photo_description"]) )
            $photo->description = $input["photo_description"];
        if ( !empty($input["photo_district"]) )
            $photo->district = $input["photo_district"];
        if ( !empty($input["photo_imageAuthor"]) )
            $photo->imageAuthor = $input["photo_imageAuthor"];
        $photo->name = $input["photo_name"];
        $photo->state = $input["photo_state"];
        if ( !empty($input["photo_street"]) )
            $photo->street = $input["photo_street"];
  
        if(!empty($input["workDate"])){             
           $photo->workdate = $input["workDate"];
           $photo->workDateType = "year";
        }elseif(!empty($input["decade_select"])){             
           $photo->workdate = $input["decade_select"];
           $photo->workDateType = "decade";
        }elseif (!empty($input["century"]) && $input["century"]!="NS") { 
           $photo->workdate = $input["century"];
           $photo->workDateType = "century";
        }else{ 
           $photo->workdate = NULL;
        }

        if(!empty($input["photo_imageDate"])){             
            $photo->dataCriacao = $this->date->formatDate($input["photo_imageDate"]);
            $photo->imageDateType = "date";
        }elseif(!empty($input["decade_select_image"])){             
            $photo->dataCriacao = $input["decade_select_image"];
            $photo->imageDateType = "decade";
        }elseif (!empty($input["century_image"]) && $input["century_image"]!="NS") { 
            $photo->dataCriacao = $input["century_image"];
            $photo->imageDateType = "century";
        }else{ 
            $photo->dataCriacao = NULL;
        }            
        $photo->nome_arquivo = $file->getClientOriginalName();
        $photo->user_id = Auth::user()->id;
        $photo->dataUpload = date('Y-m-d H:i:s');
        return $photo;
	}

	public static function updatePhoto($input,$file, $photo)
	{

	}

	
}