<?php
namespace modules\collaborative\controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use modules\collaborative\models\Tag;
use modules\institutions\models\Institution as Institution;
use Photo;
use DB;
use Illuminate\Support\Facades\Validator;

class TagsController extends \BaseController {

	public function indexAll()
	{
		$tags = Tag::all();
		return $tags;
	}

	public function index()
	{
		$tags = Tag::all();
        return \View::make('tag.index', ['tags' => $tags]);
	}

	public function refreshCount() {
		$photos = Photo::all();
		echo "processando...\r\n";
		\DB::update('update tags set count = 0');
		foreach ($photos as $photo) {
			$photo_tags = $photo->tags;
			echo "Foto de ID = " . $photo->id . ":\r\n";
			foreach ($photo_tags as $tag) {
				$tag->count = $tag->count + 1;
				$tag->save();
				echo "Tag atualizada: " . $tag->name . "\r\n";
			}
		}
		$deleted = Photo::onlyTrashed()->get();
		foreach ($deleted as $photo) {
			\DB::table('tag_assignments')->where('photo_id', '=', $photo->id)->delete();
		}
	}

	public function create() 
    {
        return \View::make('tag.create');
    }

    public function store()
    {
        //first, we will receive the form from the tag.create view
        $input = \Input::all();

        $validator = \Validator::make(
            $input,
            array(
                'name' => 'required', 
                'description' => 'sometimes', 
                'category' => 'sometimes',
                 'is' => 'sometimes|exists:tags,name'
            )
        );

        //for now, inputing wrong data resets the form
        if ($validator->fails())
        {
            return \View::make('tag.create');
        }

        //create the new tag and add it to the database
        $tag = new Tag;
        $tag->name = $input['name'];
        $tag->description = $input['description'];
        $tag->category = $input['category'];
        $tag->type = 'Acervo'; //only 'Acervo' tags can be edited and created by admins
        $equiv = Tag::where('name', $input['is'])->first();
        $tag->is = 0;
        if ($equiv != null) { $tag->is = $equiv->id;}
        $tag->save();

        //returns you, inefficiently, to the tag.index view
        $tags = Tag::all();
        return \View::make('tag.index', ['tags' => $tags]);
    }

    public function edit($id) 
    {
        $tag = Tag::find($id);
        $equiv = Tag::find($tag->is);
        $equivName = '';
        if($equiv != null) {$equivName = $equiv->name;}
        return \View::make('tag.edit', ['tagVec' => [$tag, $equivName]]);
    }

    public function query_description($name) 
    {
        // $tag = Tag::where('name', $name)->first();
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: Content-Type");
        header('Content-Type: application/json');
        $tag = Tag::find($name);
        $json = array('description' => $tag->description);
        // \log::info($tag->description);

        return json_encode($json);
    }

    public function update($id)
    {
        $input = \Input::all();

        $validator = \Validator::make(
            $input,
            array(
                'name' => 'required', 
                'description' => 'sometimes', 
                'category' => 'sometimes', 
                'is' => 'sometimes|exists:tags,name'
            )
        );

        //for now, inputting wrong data resets the form
        if ($validator->fails())
        {
            return TagsController::edit($id);
        }
        
        //finds the tag and edits it accordingly
        $tag = Tag::find($id);  
        $tag->name = $input['name'];
        $tag->description = $input['description'];
        $tag->category = $input['category'];
        $tag->type = 'Acervo';
        $equiv = Tag::where('name', $input['is'])->first();
        if ($equiv != null) { $tag->is = $equiv->id;}
        else $tag->is = 0;
        $tag->save();

        //returns you, inefficiently, to the tag.index view
        $tags = Tag::all();
        return \View::make('tag.index', ['tags' => $tags]);
    }

    public function destroy($id)
    {
        TagsController::purge($id);

        //returns you, inefficiently, to the tag.index view
        $tags = Tag::all();
        return \View::make('tag.index', ['tags' => $tags]);
    }

    public function purge($id) //actually destroys tags
    {
        $tag = Tag::find($id);
        foreach(Tag::where('is', $id)->get() as $dependancies) //'recursively' destroys all equivalent terms
        {
            TagsController::purge($dependancies->id);
        }
        $tag->delete();
        return;
    }

}
