<?php
namespace lib\api\controllers;

class APISearchController extends \BaseController {

	public function search() { 
        $needle = trim(\Input::get("q"));

        if ($needle != "") {        
            $tags = null;
            $allAuthors =  null;
            $query = \Tag::where('name', 'LIKE', '%' . $needle . '%')->where('count', '>', 0);  
            $tags = $query->get(); 
            
            $allAuthors = \DB::table('authors')
            ->join('photo_author', function($join) use ($needle)
            { $join->on('authors.id', '=', 'photo_author.author_id')
              ->where('name', 'LIKE', '%' . $needle . '%');
            })->groupBy('authors.id')->get();
                                          
            $idUserList = \PagesController::userPhotosSearch($needle);
			$query = \Photo::where(function($query) use($needle, $idUserList) {
                $query->where('name', 'LIKE', '%'. $needle .'%');  
                $query->orWhere('description', 'LIKE', '%'. $needle .'%');  
                $query->orWhere('imageAuthor', 'LIKE', '%' . $needle . '%');
                $query->orWhere('country', 'LIKE', '%'. $needle .'%');  
                $query->orWhere('state', 'LIKE', '%'. $needle .'%'); 
                $query->orWhere('city', 'LIKE', '%'. $needle .'%'); 
                if ($idUserList != null && !empty($idUserList)) {
                    $query->orWhereIn('user_id', $idUserList);
                }
            });
            $photos =  $query->orderBy('created_at', 'DESC')->get();

            $query = \Tag::where('name', '=', $needle); 
            $tags = $query->get();
            foreach ($tags as $tag) { 
                $byTag = $tag->photos;                
                $photos = $photos->merge($byTag);
            }   

            $queryAuthor = \Author::where('name', 'LIKE', '%' . $needle . '%'); 
            $authors = $queryAuthor->get();
            foreach ($authors as $author) { 
                $byAuthor = $author->photos;                
                $photos = $photos->merge($byAuthor);                
            }

            $query = \Institution::where(function($query) use($needle) {
                    $query->where('name', 'LIKE', '%'. $needle .'%');                      
                    $query->orWhere('acronym', '=',  $needle);
                });
            $institutions =  $query->get(); 
            
            foreach ($institutions as $institution) { 
                $byInstitution = $institution->photos;
                $photos = $photos->merge($byInstitution);
            }  
        }
        $photos = $photos->sortByDesc('id');
        return \Response::json($photos);
	}

	public function moreSearch() {

	}
}
