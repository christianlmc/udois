<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="h-100">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>
			@yield('title', config('app.name', 'Udois'))
		</title>

		<!-- Styles -->
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('css/udois.css') }}" rel="stylesheet">
	</head>
	<body style="min-height: 100%">
		<!-- Scripts -->
		<script src="{{ mix('js/app.js') }}"></script>
		<script src="{{ mix('js/popper.js') }}"></script>
		<script src="{{ mix('js/bootstrap.js') }}"></script>
		<nav class="navbar navbar-dark bg-dark pb-1 sticky-top">		
			<nav class="navbar-brand udois text-udois-blue">
				<h3>
					<a href="/home">
						<span class="oi oi-chevron-left"></span>
					</a>
					{{$sala->nome}}
				</h3>
			</nav>
			<div class="btn-group" role="group">
				<button class="btn btn-lg btn-dark text-info my-2 my-sm-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="oi oi-menu"></span>
				</button>
				<div class="dropdown-menu">
					@if(Auth::guest())
						<a class="dropdown-item {{Request::is("/") ? "active" : " "}}" href="/">Home</a>
						<a class="dropdown-item {{Request::is("login") ? "active" : " "}}" href="/login">Login/Registro</a>
					@else
						<a class="dropdown-item {{Request::is("/") ? "active" : " "}}" href="/">Home</a>
						@if(Auth::user()->admin)
							<a class="dropdown-item {{Request::is("cria-pagina") ? "active" : " "}}" href="/cria-pagina">Páginas</a>
							<a class="dropdown-item {{Request::is("lista-pagina") ? "active" : " "}}" href="/lista-pagina">Lista Páginas</a>
						@endif
						<a class="dropdown-item {{Request::is("perfil") ? "active" : " " }}" href="/perfil">Meu perfil</a>
						<a class="dropdown-item" href="{{ route('logout') }}"
							onclick="event.preventDefault();
									 document.getElementById('logout-form').submit();">
							Sair
						</a>
						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							{{ csrf_field() }}
						</form>
					@endif
				</div>
			</div>
		</nav>
		<div id="app">
			<div id="mensagens" class="container-fluid" style="overflow-y: scroll; height: 83vh">
				<div v-for="mensagem in mensagens" 
					:class="[eh_usuario_local(mensagem.membro.usuario_id) ? mensagem_direita.alinhamento : mensagem_esquerda.alinhamento,'my-2'] ">

					<div class="media">
						<img v-show="!eh_usuario_local(mensagem.membro.usuario_id)" 
							width="80px" 
							:src="foto_usuario(mensagem.membro.usuario_id)" 
							class="rounded-circle">
						<div class="media-body col-12">
							<div :class="[eh_usuario_local(mensagem.membro.usuario_id) ? mensagem_direita.cor : mensagem_esquerda.cor,  'card']">
								<div class="card-body">
									@{{mensagem.texto}}
								</div>
								<div class="card-footer px-1 py-0">
									<small class="text-muted">@{{mensagem.hora_enviado}}</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer class="container-fluid fixed-bottom">
			<div class="input-group my-2">
				<input type="text" class="form-control" placeholder="Escreva uma mensagem..." aria-label="mensagem" aria-describedby="basic-addon1">
				<div class="input-group-append">
					<button class="btn btn-outline-udois-blue" type="button"><span class="oi oi-chat"></span></button>
					<button class="btn btn-outline-udois-blue" type="button"><span class="oi oi-paperclip"></span></button>
					<button class="btn btn-outline-udois-blue" type="button"><span class="oi oi-microphone"></span></button>
				</div>
			</div>
		</footer>
		<script>
			var app = new Vue({
				el: '#app',
				data: {
					sala: @JSON($sala),
					usuarios: @JSON($usuarios),
					mensagens: @JSON($mensagens),
					mensagem_esquerda: { cor: 'bg-light', alinhamento: 'col-8 col-md-5 px-0'},
					mensagem_direita:  { cor: 'bg-wpp-green', alinhamento: 'col-8 offset-4 col-md-5 offset-md-7'}
				},
				methods: {
					eh_usuario_local: function(usuario_id){
						if ({{Auth::id()}} == usuario_id) {
							return true;
						}
						return false;
					},
					foto_usuario: function(usuario_id){
						this.usuarios.filter(function (usuario) {
							return "sqtring"
							if (usuario.id == usuario_id) {
								console.log(usuario.foto_perfil)
								return "usuario.foto_perfil"
							}
						});
					},
					//Funcao que faz ele dar scroll pro fim das mensagens
					scrollToEnd: function(){
						var mensagens = document.querySelector("#mensagens")
						var scrollHeight = mensagens.scrollHeight
						mensagens.scrollTop = scrollHeight
					}
				},
				mounted() {
					this.scrollToEnd()
				},
			})
		</script>
	</body>
</html>

