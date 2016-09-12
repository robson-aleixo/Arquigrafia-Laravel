<h4>Ajude a reportar a foto</h4>
<div id="reportPhoto" class="reportPhoto">

   <br>
   {{ Form::open(array( 'url' => '/photos/reportPhoto')) }}
   {{ Form::hidden('_photo', $photo_id) }}

   <div class="four columns"><p>{{ Form::label('reportType', 'Tipo de denuncia') }}</p></div>
   <div class="four columns row">
      <p>{{ Form::checkbox('reportTypes[]', 'tipo1' ) }} <label>Conteúdo inapropiado</label></p>
      <p>{{ Form::checkbox('reportTypes[]', 'tipo2' ) }} <label>É spam</label></p>
      <p>{{ Form::checkbox('reportTypes[]', 'tipo3' ) }} <label>Penso que não tem relação com Arquitetura</label></p>
      <p>{{ Form::checkbox('reportTypes[]', 'tipo4' ) }} <label>Imagem não tem relação com o título</label></p>
      <p>{{ Form::checkbox('reportTypes[]', 'tipo5' ) }} <label>Imagem com dados incorretos</label></p>
      <div class="error"></div>   
   </div>
   
   <div class="four columns"><p>{{ Form::label('reportComment', 'Observação') }}</p></div>
   <div class="four columns row">
      <p>{{ Form::textarea('reportComment', null, ['size' => '50x4', 'maxlength' => '200']) }} <br></p>
   </div>

   <p>{{ Form::submit("ENVIAR", array('class'=>'btn')) }}</p>

   {{ Form::close() }}
</div>
<script type="text/javascript">
 var formModal = $('#reportPhoto form');
 formModal.find('button').click(function (e) {
   formModal.submit();
});
 formModal.submit( function(e) {

   var reportTypes = formModal.find("input[name='reportTypes[]']:checked");
   var div_error = formModal.find('.error');
   div_error.empty();
   if ( reportTypes.length == 0 ) {
     div_error.text('Deve-se selecionar ao menos 1 tipo de denuncia');
     e.preventDefault();
  }
});
</script>

<style>
 #reportPhoto p { margin: 2px; color: #000; }
 #reportPhoto #info { margin-top: 50px; }
 #reportPhoto #info label { color: #777; }
 #reportPhoto input, #reportPhoto textarea { border-color: #aaa; }
 #reportPhoto .img_container { width: 220px; border-radius: 3px; -moz-border-radius: 3px;
  -webkit-border-radius: 3px; position: relative; margin-top: 10px; min-height: 200px; }
  #reportPhoto .img_container img { width: 100%; }

</style>

