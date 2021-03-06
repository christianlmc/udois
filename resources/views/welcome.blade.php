@extends('layouts.app')

@section('content')
	@foreach($paginas as $pagina)
	<div class="bg-image-full" style="background-image: url({{ Storage::url('banners/' . $pagina->foto_banner) }}); height: 90vh">
		<div class="container-fluid h-100">
			<div class="row align-items-center h-100">
				<div class="col-12 col-sm-5 offset-sm-7">
					<div class="card bg-udois-blue text-white" style="opacity: .9;">
						<div class="card-body text-right">
							<h5 class="card-title ">{{ $pagina->frase_principal }}
								<img class="rounded-circle float-right" width="80px" src="{{ $admin->foto_perfil ? Storage::url('profiles/' . $admin->foto_perfil) : asset('user.png')}}">
							</h5>
						</div>
						<div class="card-footer text-left">
							<a href="/sala/criar/{{$pagina->id}}" class="text-white"><span class="oi oi-chat"></span> Falar com o {{ $admin->nome }}</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
@endsection
