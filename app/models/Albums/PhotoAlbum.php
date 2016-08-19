<?php

class PhotoAlbum extends \BaseModel {
	
	protected $fillable = ['album_id','photo_id'];

	protected $table = 'album_elements';

	
	public function album()
	{
			return $this->hasOne('Album');
	}

	public function photo()
	{
		return $this->belongsTo('Photo');
	}


	public static function createAlbumElements($albumId, $photoId)
  	{	//DB::insert('insert into album_elements (album_id, photo_id) values (?, ?)',
  	// array($album->id, $photo->id));
		$photoAlbum = new PhotoAlbum;
		$photoAlbum->album_id = $albumId;
		$photoAlbum->photo_id = $photoId;
		$photoAlbum->timestamps = false;
		$photoAlbum->save();
  	}

}