@extends('layouts.app')

@section('navbar-name', 'Lista Página')

@section('content')

@if (session('status'))
	<div class="row justify-content-center">
		<div class="col-sm col-md-4 alert alert-success">
			{{ session('status') }}
		</div>
	</div>
@endif
<ul class="list-group">
    @foreach ($paginas as $pagina)
		<a href="#" class="list-group-item list-group-item-action">
			<div class="row">
				<div class="col-lg-2">
					<h5>{{ $pagina->titulo }}</h5>
				</div>
				<div class="col-lg-2 offset-lg-8 text-right">
					<button type="button" data-toggle="modal" data-target="#delete-page" data-page-name="{{ $pagina->titulo }}" data-page-id="{{ $pagina->id }}" class="btn btn-danger">Excluir</button>
					<button type="button" data-toggle="modal" data-target="#edit-page" data-page-id="{{ $pagina->id }}" class="btn btn-primary">Editar</button>
				</div>
			</div>
		</a>
    @endforeach
</ul>

<div class="modal fade" id="delete-page" tabindex="-1" role="dialog" aria-labelledby="delete-modal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="delete-modal">Atenção</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				{!! Form::open(array('url' => '/lista-pagina', 'method' => 'delete')) !!}
					<input type="text" name="id" value="" hidden>
					<button type="submit" class="btn btn-danger" id="excluir-pagina">Excluir a Página</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="edit-page" tabindex="-1" role="dialog" aria-labelledby="edit-modal" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="edit-modal">Editar Página</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{!! Form::open(array('url' => '/lista-pagina', 'method' => 'put', 'id' => 'form', 'files' => true)) !!}
					<div class="row justify-content-center">
						<div class="col-9">
							<div class="form-group">
								<input type="text" class="form-control {{ $errors->has('titulo') ? ' is-invalid' : '' }}" name="titulo" aria-describedby="titulo" placeholder="Título" value="{{ old('titulo') }}" required disabled>
								<div class="invalid-feedback">
									{{ $errors->first('titulo') }}
								</div>
							</div>
						</div>
						<a class="col-3 enable-btn" href="javascript:void(0)">Alterar</a>
					</div>
					<div class="row justify-content-center">
						<div class="col-9">
							<div class="form-group">
								<input type="text" class="form-control {{ $errors->has('frase_principal') ? ' is-invalid' : '' }}" name="frase_principal" aria-describedby="frase_principal" placeholder="Frase Principal" value="{{ old('frase_principal')}}" required disabled>
								<div class="invalid-feedback">
									{{ $errors->first('frase_principal') }}
								</div>
							</div>
						</div>
						<a class="col-3 enable-btn" href="javascript:void(0)">Alterar</a>
					</div>
					<div class="row justify-content-center">
						<div class="col-9">
							<div class="form-group">
								<input type="text" class="form-control {{ $errors->has('frase_2') ? ' is-invalid' : '' }}" name="frase_2" aria-describedby="frase_2" placeholder="Frase 2" value="{{ old('frase_2') }}" disabled>
								<div class="invalid-feedback">
									{{ $errors->first('frase_2') }}
								</div>
							</div>
						</div>
						<a class="col-3 enable-btn" href="javascript:void(0)">Alterar</a>
					</div>
					<div class="row justify-content-center">
						<div class="col-9">
							<div class="form-group">
								<input type="text" class="form-control {{ $errors->has('frase_3') ? ' is-invalid' : '' }}" name="frase_3" aria-describedby="frase_3" placeholder="Frase 3" value="{{ old('frase_3') }}" disabled>
								<div class="invalid-feedback">
									{{ $errors->first('frase_3') }}
								</div>
							</div>
						</div>
						<a class="col-3 enable-btn" href="javascript:void(0)">Alterar</a>
					</div>
					<div class="row justify-content-center">
						<div class="col-9">
							<div class="form-group">
								<input type="text" class="form-control {{ $errors->has('frase_4') ? ' is-invalid' : '' }}" name="frase_4" aria-describedby="frase_4" placeholder="Frase 4" value="{{ old('frase_4') }}" disabled>
								<div class="invalid-feedback">
									{{ $errors->first('frase_4') }}
								</div>
							</div>
						</div>
						<a class="col-3 enable-btn" href="javascript:void(0)">Alterar</a>
					</div>
					<div class="row justify-content-center">
						<div class="col-9">
							<div class="form-group">
								<input type="text" class="form-control {{ $errors->has('url') ? ' is-invalid' : '' }}" name="url" aria-describedby="url" placeholder="URL" value="{{ old('url') }}" required disabled>
								<div class="invalid-feedback">
									{{ $errors->first('url') }}
								</div>
							</div>
						</div>
						<a class="col-3 enable-btn" href="javascript:void(0)">Alterar</a>
					</div>
					<div class="row justify-content-center">
						<div class="col-9">
							<div class="form-group">
								<button class="btn btn-primary btn-block form-control {{ $errors->has('foto_banner') ? ' is-invalid' : '' }}" id="upload-button" type="button" onclick="chooseFile()" disabled>Upload Banner</button>
								<input type="file" id="upload" name="foto_banner" value="Selecione uma imagem" accept="image/*" hidden disabled>
								<div class="invalid-feedback" id="invalid-file">
									{{ $errors->first('foto_banner') }}
								</div>
							</div>
						</div>
						<a class="col-3 enable-btn" href="javascript:void(0)">Alterar</a>
					</div>
					<input type="text" name="id" value="" hidden>
					<div class="modal-footer">
						<button type="submit" class="btn btn-udois-blue text-white">Editar Página</button>
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
					</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script>
$('.enable-btn').click(function (){
	$(this).prev().find(':input').prop("disabled", false);
});

$('#delete-page').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget)
	var page_name = button.data('page-name')
	var page_id = button.data('page-id')
	var modal = $(this)
	modal.find('.modal-body').empty().append("Tem certeza que deseja excluir a página " + page_name)
	modal.find("input[name='id']").val(page_id)
});

$('#edit-page').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget)
	var page_id = button.data('page-id')
	$.ajax({
		type: "GET",
		url: 'lista-pagina/' + page_id,
		success: function (data) {
			$("#form").find("input").prop("disabled", true)
			$("#form").find("input[name='_method']").prop("disabled", false)
			$("#form").find("input[name='_token']").prop("disabled", false)
			$("#form").find("input[name='id']").prop("disabled", false)
			$("#upload-button").prop('disabled', true);
			$('#upload-button').text('Upload Banner');
			$("input[name='id']").val(data.id)
			$("input[name='titulo']").val(data.titulo)
			$("input[name='frase_principal']").val(data.frase_principal)
			$("input[name='frase_2']").val(data.frase_2)
			$("input[name='frase_3']").val(data.frase_3)
			$("input[name='frase_4']").val(data.frase_4)
			$("input[name='url']").val(data.url)	
		},
		error: function (data) {
			alert("Por favor, tente novamente mais tarde");
		}
	});
});

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

function chooseFile() {
    $("#upload").click();
}
</script>
@endsection
