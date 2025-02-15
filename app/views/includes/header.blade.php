	<!--   CABEÇALHO   -->
	<div class="header container">
    <div class="twelve columns">
	  	<!--   LOGO   -->
      <div class="four columns alpha">
        <a href="{{ URL::to("/home") }}" id="logo"></a>
        <p id="beta">beta</p>
      </div>

      <!--   MENU SUPERIOR   -->
      <div id="first_menu" class="four columns">
          <!--   MENU INSTITUCIONAL   -->
          <!--
          <ul id="top_menu_items">
            <li><a href="project.php" id="project">O projeto</a></li>
            <li><a href="faq.php" id="help">Ajuda</a></li>
            <li><a href="#" id="contact">Contato</a></li>
          </ul>
          -->
          <!--   FIM - MENU INSTITUCIONAL   -->
        <!--   MENU DE BUSCA   -->
        <form id="search_buttons_area" action="{{ URL::to("/") }}/search" method="post" accept-charset="UTF-8">
          <!--   BARRA DE BUSCA   -->
          <input type="text" class="search_bar" id="search_bar" name="q" value=""/>

          <input type="hidden" value="8" name="perPage" />
          <!--   BOTÃO DA BARRA DE BUSCA   -->
          <input type="submit" class="search_bar_button cursor" value="" />
          <!--   BOTÃO DE BUSCA AVANÇADA   -->
          <!--  <a href="#" id="complete_search"></a> -->
        </form>
        <!--   FIM - MENU DE BUSCA   -->
      </div>
      <!--   FIM - MENU SUPERIOR   -->

      <!--   ÁREA DO USUARIO   -->
      {{-- <div id="loggin_area_institutional"> --}}
      <div id="loggin_area" class="four columns omega">

      @if (Auth::check())
        @if ( Session::has('institutionId') )
          <a id="user_name" href="{{ URL::to('/institutions/' . $institution->id) }}">{{Session::get('displayInstitution') }} {{-- $institution->name; --}}</a>
          <a id="user_photo" href="{{ URL::to('/institutions/' . $institution->id) }}">
            @if( ! empty($institution->photo) )
              <img src="{{ asset($institution->photo) }}" width="48" height="48" class="user_photo_thumbnail"/>
            @else
              <img src="{{ URL::to("/") }}/img/avatar-institution.png" width="48" height="48" class="user_photo_thumbnail"/>
            @endif
          </a>
        @else
          <a id="user_name" href="{{ URL::to('/users/' . Auth::id()) }}">{{ str_limit( Auth::user()->name, $limit = 23, $end = '...') }}</a>
          <a id="user_photo" href="{{ URL::to('/users/' . Auth::id()) }}">
            @if ( ! empty(Auth::user()->photo) )
              <img  src="{{ asset(Auth::user()->photo) }}"
                class="user_photo_thumbnail profile-picture"/>
            @else
              <img src="{{ URL::to('/img/avatar-48.png') }}" width="48" height="48"
                class="user_photo_thumbnail profile-picture"/>
            @endif
          </a>
        @endif

        <a href="{{ URL::to("/users/logout/") }}" id="logout" class="btn">SAIR</a><br />
        <ul id="logged_menu">
          <li>
            <div id="notification-icon-container">
              <?php
                $notesCounter = Auth::user()->notifications()->unread()->count();
                if ($notesCounter != 1) $title = "Você tem " . $notesCounter . " notificações não lidas";
                else $title = "Você tem " . $notesCounter . " notificação não lida";
              ?>
              <a onclick="toggleNotes()" id="notification" title="{{$title}}"><i class="notification">&nbsp;</i> NOTIFICAÇÕES</a>
              @if ($notesCounter > 0) <div id="bubble"> {{$notesCounter}} </div>  @endif
            </div>
          </li>

          <!-- <li><a href="#" id="comunities" title="Comunidades">&nbsp;</a></li> -->
          @if(Session::has('institutionId'))
            <li><a href="{{ URL::to("/institutions/form/upload") }}" name="modal" title="Enviar uma imagem"><i class="upload">&nbsp;</i> UPLOAD</a></li>
          @else
            <li><a href="{{ URL::to("/photos/upload") }}" name="modal" title="Enviar uma imagem"><i class="upload">&nbsp;</i> UPLOAD</a></li>
          @endif
          <!-- <li><a href="#" id="messages" title="Você tem 19 mensagens">&nbsp;</a></li> -->

          {{-- @if (Auth::user()->photos->count() > 0 ) --}}
            @if(Auth::user()->albums->count() > 0)
              <li><a href="{{ URL::to('/albums') }}" title="Meus álbuns"><i class="photos">&nbsp;</i> ALBUNS</a></li>
            @else
              <li><a href="{{ URL::to('/albums/create') }}" title="Crie seu álbum personalizado"><i class="photos">&nbsp;</i> ALBUNS</a></li>
            @endif
          {{-- @endif --}}

          <li>
            <div id="new-message-container" class="new-message">
              <a href="{{ URL::to('/chats') }}">MENSAGENS</a>
              @if (Auth::user()->newMessagesCount() > 0) <div id="bubble2"> {{Auth::user()->newMessagesCount()}} </div>  @endif
            </div>
          </li>

          <li class="contributions-list">
            <div>
              <a href="{{ URL::to('/users/contributions') }}" title="Contribuições">
                <i class="contributions">&nbsp;</i> CONTRIBUIÇÕES
              </a>
            </div>
          </li>
          
          @if(Auth::user()->admin == True)
            <li class = "top-space"><a href="{{ URL::to('/adm-reports') }}" title="Visualize os relatórios sobre os dados do Arquigrafia"><i class="sheet">&nbsp;</i> RELATÓRIOS</a></li>
          @endif
          <!-- <li><a href="{{ URL::to("/badges") }}" id="badge" title="Vizualizar badges">&nbsp;</a></li>-->
        </ul>

        <div id="notes-box">
          <div id="notes-header">
            <p id="box-title"> Notificações </p>
            <p id="read-all"><a onclick="readAll()"> Marcar todas como lidas </a></p>
          </div>
          <div id="notes-container">
            @if(Auth::user()->notifications->isEmpty())
              <p id="no-notes">Você não possui notificações</p>
            @else
              @include("includes.notes", ['user' => Auth::user(), 'max' => 5])
            @endif
          </div>
          <div id="notes-footer">
            <p><a href="{{ URL::to("/notifications") }}">Ver todas</a></p>
          </div>
        </div>
      @else

        <!--   BOTÃO DE LOGIN   -->
        <a href="{{ URL::to("/users/login/") }}" name="modal" id="login_button" class="btn">ENTRAR</a>

        <!--   BOTÃO DE CADASTRO   -->
        <a href="{{ URL::to("/users/account") }}" name="modal" class="btn" id="registration_button">CRIAR UMA CONTA</a>
      @endif

      </div>
      <!--   FIM - ÁREA DO USUARIO   -->


      <!--   MENSAGENS DE ENVIO / FALHA DE ENVIO   -->
      <div id="message_delivery" class="message_delivery" >Mensagem enviada!</div>
      <div id="fail_message_delivery" class="message_delivery" >Falha no envio.</div>
      <div id="message_upload_ok" class="message_delivery" >Upload efetuado com sucesso!</div>
      <div id="message_upload_error" class="message_delivery" >Erro - Arquivo inválido!</div>
      <div id="message_login_error" class="message_delivery" >Erro - Login ou senha inválidos!</div>
      <div id="generic_error" class="message_delivery_generic" ></div>
      <!--   TESTE DE FUNCIONAMENTO DA FUNÇÃO   -->
  	</div>
  </div>

  <input id="context_path" type="hidden" value=""/>

	<!--   FIM - CABEÇALHO   -->
