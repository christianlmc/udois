@extends('layouts.app')

@section('navbar-name', 'Cria Página')

@section('content')
<div class="container">
	<div class="card border-0">
		<div class="card-body">
			<div class="row justify-content-center">
				<h2 id="title">Nova Página</h2>
			</div>
			@if (session('status'))
				<div class="row justify-content-center">
				    <div class="col-sm col-md-4 alert alert-success">
				        {{ session('status') }}
				    </div>
				</div>
			@endif
			{!! Form::open(array('url' => '/cria-pagina', 'id' => 'form', 'files' => true)) !!}
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<input type="text" class="form-control {{ $errors->has('titulo') ? ' is-invalid' : '' }}" name="titulo" aria-describedby="titulo" placeholder="Título" value="{{ old('titulo') }}" required>
							<div class="invalid-feedback">
								{{ $errors->first('titulo') }}
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<input type="text" class="form-control {{ $errors->has('frase_principal') ? ' is-invalid' : '' }}" name="frase_principal" aria-describedby="frase_principal" placeholder="Frase Principal" value="{{ old('frase_principal')}}" required>
							<div class="invalid-feedback">
								{{ $errors->first('frase_principal') }}
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<input type="text" class="form-control {{ $errors->has('frase_2') ? ' is-invalid' : '' }}" name="frase_2" aria-describedby="frase_2" placeholder="Frase 2" value="{{ old('frase_2') }}">
							<div class="invalid-feedback">
								{{ $errors->first('frase_2') }}
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<input type="text" class="form-control {{ $errors->has('frase_3') ? ' is-invalid' : '' }}" name="frase_3" aria-describedby="frase_3" placeholder="Frase 3" value="{{ old('frase_3') }}">
							<div class="invalid-feedback">
								{{ $errors->first('frase_3') }}
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<input type="text" class="form-control {{ $errors->has('frase_4') ? ' is-invalid' : '' }}" name="frase_4" aria-describedby="frase_4" placeholder="Frase 4" value="{{ old('frase_4') }}">
							<div class="invalid-feedback">
								{{ $errors->first('frase_4') }}
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<input type="text" class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" aria-describedby="url" placeholder="URL" value="{{ old('url') }}" required>
							<div class="invalid-feedback">
								{{ $errors->first('url') }}
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-sm col-md-4">
						<div class="form-group">
							<button class="btn btn-outline-primary btn-block form-control {{ $errors->has('foto_banner') ? ' is-invalid' : '' }}" id="upload-button" type="button" onclick="chooseFile()">Upload Banner</button>
							<input type="file" id="upload" name="foto_banner" value="Selecione uma imagem" accept="image/*" hidden>
							<div class="invalid-feedback" id="invalid-file">
								{{ $errors->first('foto_banner') }}
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<button type="submit" class="btn btn-udois-blue text-white">Criar Página</button>
				</div>
			{!! Form::close() !!}
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
$('#upload').change(function() {
	var file = $('#upload')[0].files[0];
	if (file){
		$('#upload-button').text('Imagem: ' +  file.name);
		$('#upload-button').removeClass("is-invalid");
	}
	else{
		$('#upload-button').text('Upload Banner');
	}
});

$("#form").submit(function(event){

    var file = $('#upload')[0].files[0];
	if (!file){
		event.preventDefault();
		$('#upload-button').addClass("is-invalid");
		$('#invalid-file').text("Selecione uma imagem.");
	}
	else{
		$('#form').submit();
	}
});

function chooseFile() {
    $("#upload").click();
}
</script>
@endsection
