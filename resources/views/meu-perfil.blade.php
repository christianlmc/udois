@extends('layouts.app')

@section('content')
<script src="{{ mix('js/croppie.js') }}"></script>
<link href="{{ asset('css/croppie.css') }}" rel="stylesheet">
<div class="container">
	<div class="card border-0">
		<div class="card-body">
			<div class="row justify-content-center">
				<h2 id="title">Editar Perfil</h2>
			</div>
			{!! Form::open(array('url' => '/perfil/atualizar', 'id' => 'login-form', 'files' => true)) !!}
				<div class="row justify-content-center">
					<div class="col-sm col-md-4 text-center">
						<div class="form-group">
						<img id="profile-pic" class="align-self-center rounded-circle img-fluid img-thumbnail" width="200px" src="{{ Auth::user()->foto_perfil ? Auth::user()->foto_perfil : asset('user.png')}}">
						</div>
					</div>
				</div>
				<!-- Button trigger modal -->
				<div class="row justify-content-center">
					<div class="col-sm col-md-4 text-center">
						<div class="form-group">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#change-profile-pic">
								Alterar foto
							</button>
						</div>
					</div>
				</div>

				<input type="file" id="upload"  value="Selecione uma imagem" accept="image/*">

				<input type="text" id="photo-file" name="foto_perfil" value="" hidden>
				
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

<!-- Modal -->
<div class="modal fade" id="change-profile-pic" tabindex="-1" role="dialog" aria-labelledby="change-profile-pic" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="change-profile-pic">Alterar foto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div id="edit-profile"></div>
			</div>
			<div class="modal-footer">
				<button id="upload-photo" class="btn btn-udois-blue text-white" onclick="chooseFile();">Selecionar nova foto</button>
				<button id="send-photo" class="btn btn-udois-blue text-white" data-dismiss="modal">Salvar Alterações</button>
				<button id="cancel-upload" class="btn btn-udois-blue text-white" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>

<script>
$("document").ready(function(){
	$('input[type=file]').hide();	
});

$('#change-profile-pic').on('shown.bs.modal', function (e) {
	$("#edit-profile").empty();
	var $uploadCrop = $('#edit-profile').croppie({
	    viewport: { width: 250, height: 250,type: 'circle' },
	    boundary: { width: 300, height: 300 },
	    url: $('#profile-pic').attr('src'),

	});

	$('#upload-photo').show();
	$('#cancel-upload').show();	
	
	$('#send-photo').on('click', function () {
		$uploadCrop.croppie('result').then(function (resp) {
			$("#profile-pic").attr('src', resp);
			$("#photo-file").attr('value', resp);
		});
	});

});


$('#change-profile-pic').on('hidden.bs.modal', function (e) {
	$("#edit-profile").empty();
});

function chooseFile() {
    $("#upload").click();
}

function readFile(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#edit-profile').croppie('bind', {
				url: e.target.result
			});
			$('#cancel-upload').show();
			$('#upload-photo').hide();
		}

		reader.readAsDataURL(input.files[0]);
	}
}

$('#upload').on('change', function () { readFile(this); });
</script>
@endsection
