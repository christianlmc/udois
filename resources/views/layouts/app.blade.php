<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ config('app.name', 'Udois') }}</title>

		<!-- Styles -->
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<link href="{{ asset('css/udois.css') }}" rel="stylesheet">
	</head>
	<body>
		<div id="app"></div>
		<!-- Scripts -->
		<script src="{{ mix('js/app.js') }}"></script>
		<script src="{{ mix('js/popper.js') }}"></script>
		<script src="{{ mix('js/bootstrap.js') }}"></script>

		<nav class="navbar navbar-dark bg-dark pb-1">
			@if(starts_with(Request::route()->getName(), "navbar-custom-name"))
				<h3 class="navbar-brand udois text-udois-blue">{{title_case(str_after(Request::route()->getName(), "navbar-custom-name"))}}</h3></p>
			@else			
				<a class="navbar-brand udois text-udois-blue" href="/"><h3>UDOIS</h3></a>
			@endif
			<div class="btn-group" role="group">
				@if(!Request::is("home"))
				<a class="btn btn-lg btn-dark text-info my-2 my-sm-0" href="/home" >
					<span class="oi oi-chat"></span>
				</a>
				@endif
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
		<div style="min-height: 63vh">
			@yield('content')
		</div>
		<footer>
			<div class="jumbotron jumbotron-fluid mb-0 text-center bg-udois-blue">
				<div class="container-fluid text-white">
					<h1 class="udois display-3">UDOIS</h1>
					<h1 class="udois display-4">+ 8.000 CLIENTES</h1>					
				</div>
			</div>
			<div class="jumbotron jumbotron-fluid mb-0 py-4 text-center bg-dark">
				<div class="container text-white">
					<h4 class="display-7">UDOIS</h4>
					<p>CNPJ: 07.960.232/0001-30</p>
				</div>
			</div>
	    </footer>
		
	</body>
</html>
