<?php

/* ALBUMS */
Route::resource('/albums','lib\album\controllers\AlbumsController');
Route::get('/albums/photos/add', 'lib\album\controllers\AlbumsController@paginateByUser');
Route::get('/albums/{id}/photos/rm', 'lib\album\controllers\AlbumsController@paginateByAlbum');
Route::get('/albums/{id}/photos/add', 'lib\album\controllers\AlbumsController@paginateByOtherPhotos');
Route::get('/albums/get/list/{id}', 'lib\album\controllers\AlbumsController@getList');
Route::post('/albums/photo/add', 'lib\album\controllers\AlbumsController@addPhotoToAlbums');
Route::delete('/albums/{album_id}/photos/{photo_id}/remove', 'lib\album\controllers\AlbumsController@removePhotoFromAlbum');

/* ALBUMS - ajax */
Route::get('/albums/get/cover/{id}', 'lib\album\controllers\AlbumsController@paginateCoverPhotos');
Route::post('/albums/{id}/update/info', 'lib\album\controllers\AlbumsController@updateInfo');
Route::post('/albums/{id}/detach/photos', 'lib\album\controllers\AlbumsController@detachPhotos');
Route::post('/albums/{id}/attach/photos', 'lib\album\controllers\AlbumsController@attachPhotos');
Route::get('/albums/{id}/paginate/photos', 'lib\album\controllers\AlbumsController@paginateAlbumPhotos');
Route::get('/albums/{id}/paginate/other/photos', 'lib\album\controllers\AlbumsController@paginatePhotosNotInAlbum');



