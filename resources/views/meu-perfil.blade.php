@extends('layouts.app')

@section('content')
<div class="container">
	<div class="card border-0">
		<div class="card-body">
			<div class="row justify-content-center">
				<h2 id="title">Editar Perfil</h2>
			</div>
			{!! Form::open(array('url' => '/login', 'id' => 'login-form')) !!}
				<div class="row justify-content-center">
					<div class="col-sm col-md-4 text-center">
						<div class="form-group">
						<img class="align-self-center rounded-circle img-fluid img-thumbnail" width="200px" src="{{ Auth::user()->foto_perfil ? Auth::user()->foto_perfil : asset('user.png')}}">
					</div>
					</div>
				</div>
				
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<input type="text" class="form-control {{ $errors->has('nome') ? ' is-invalid' : '' }}" name="nome" aria-describedby="nome" placeholder="Nome" value="{{ old('nome') ? old('nome') : Auth::user()->nome }}" required>
							<div class="invalid-feedback">
								{{ $errors->register->first('nome') }}
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<input type="password" class="form-control {{ $errors->has('senha_antiga') ? ' is-invalid' : '' }}" name="senha_antiga" placeholder="Senha Antiga" required>
							<div class="invalid-feedback">
								{{ $errors->first('senha_antiga') }}
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<input type="password" class="form-control {{ $errors->has('senha') ? ' is-invalid' : '' }}" name="senha" placeholder="Nova Senha" required>
							<div class="invalid-feedback">
								{{ $errors->first('senha') }}
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<input type="password" class="form-control" name="senha_confirmation" placeholder="Confirmar Nova Senha" required>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<button type="submit" class="btn btn-udois-blue text-white">Alterar</button>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection
