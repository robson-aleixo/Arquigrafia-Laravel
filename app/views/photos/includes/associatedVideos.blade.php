    <div class="twelve columns row step-1">
        <h1><span class="step-text">Vídeos associados</span></h1>
    </div>
    <div class="seven columns alpha row">
            <div class="two columns alpha">
                <p>&nbsp;&nbsp;&nbsp;&nbsp;{{ Form::label('name_video_youtube', 'Link do vídeo youtube:') }}</p>
            </div>
            <div class="five columns omega">
                <p>{{ Form::text('video_youtube', $videoYoutube, array('id' => 'video_youtube','style'=>'width:280px')) }} <br>   
                
                    <div class="error">{{ $errors->first('video_youtube') }}</div>
                </p>
                <p>Ex. https://www.youtube.com/watch?v=XXXXXXXX ou <br>
                   &nbsp; &nbsp; &nbsp;  https://www.youtube.com/embed/XXXXXXXX
                </p>
            </div>
            <br><br>
            <br class="clear">
            <div class="two columns alpha">
                <p>&nbsp;&nbsp;&nbsp;&nbsp;{{ Form::label('name_video_vimeo', 'Link do vídeo vimeo:') }}</p>
            </div>
            <div class="five columns omega">
                <p>{{ Form::text('video_vimeo', $videoVimeo, array('id' => 'video_vimeo','style'=>'width:280px')) }} <br>
                    <div class="error">{{ $errors->first('video_vimeo') }}</div>
                </p>
                <p>Ex. https://vimeo.com/00000 ou <br>
                   &nbsp; &nbsp; &nbsp;  https://player.vimeo.com/video/00000000
                </p>
            </div>
    </div>