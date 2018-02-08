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
		<script src="{{ mix('js/socket.io.js') }}"></script>
		<script src="{{ asset('js/recorder.js') }}"></script>

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
		@yield('content')
		@yield('scripts')
	</body>
</html>

