<?php 
  $news = DB::table('news')->where('user_id', '=', Auth::user()->id)->orWhere('user_id', '=', 0)->orderBy('updated_at', 'desc')->take(6)->get(); 
?>
<div class="gallery_box">
<p>Noticias </p>
</div>	