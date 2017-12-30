@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card border-0">
		<div class="card-body">
			<div class="row justify-content-center">
				<h2 id="title">Fazer Login</h2>
			</div>
			<div class="row">
				<div class="col-sm col-md-4 offset-md-4">
					<div class="row font-weight-bold">
						<div class="col-6">
							<a href="javascript:void(0)" class="button-register text-udois-blue">Fazer cadastro</a>
						</div>
						<div class="col-6 text-right">
							<a href="javascript:void(0)" class="button-login form text-udois-blue">Já sou cadastrado</a>
						</div>
					</div>
				</div>
			</div>
			{!! Form::open(array('url' => '/login', 'id' => 'login-form')) !!}
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<input type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" aria-describedby="email" placeholder="Email" value="{{ $errors->has('email') ? old('email') : '' }}">
							<div class="invalid-feedback">
								{{ $errors->first('email') }}
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<input type="password" class="form-control" name="senha" placeholder="Senha">
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<button type="submit" class="btn btn-udois-blue text-white">Login</button>
				</div>
			{!! Form::close() !!}
			{!! Form::open(array('url' => '/register', 'id' => 'register-form')) !!}
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<input type="text" class="form-control {{ $errors->register->has('nome') ? ' is-invalid' : '' }}" name="nome" aria-describedby="nome" placeholder="Nome" value="{{ old('nome') }}">
							<div class="invalid-feedback">
								{{ $errors->register->first('nome') }}
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<input type="email" class="form-control {{ $errors->register->has('email') ? ' is-invalid' : '' }}" name="email" aria-describedby="email" placeholder="Email" value="{{ $errors->register->has('email') ? old('email') : '' }}">
							<div class="invalid-feedback">
								{{ $errors->register->first('email') }}
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<input type="password" class="form-control {{ $errors->register->has('senha') ? ' is-invalid' : '' }}" name="senha" placeholder="Senha">
							<div class="invalid-feedback">
								{{ $errors->register->first('senha') }}
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<input type="password" class="form-control" name="senha_confirmation" placeholder="Confirmar Senha">
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<button type="submit" class="btn btn-udois-blue text-white">Cadastrar</button>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>

<script>
$("document").ready(function(){
	@if($errors->register->any())
		$('#login-form').hide();
		$('#title').text("Registrar")
	@else
    	$("#register-form").hide();
    @endif

});

$('.button-register').click(function() {
	$('#title').fadeOut('fast', function() {
		$(this).text("Registrar").fadeIn('fast');
	});
	$('#register-form').slideDown();
	$('#login-form').slideUp();
});

$('.button-login').click(function() {
	$('#title').fadeOut('fast', function() {
		$(this).text("Fazer Login").fadeIn('fast');
	});
	$('#register-form').slideUp();
	$('#login-form').slideDown();
});
</script>
@endsection
