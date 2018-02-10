@extends('layouts.app')

@section('content')
<ul class="list-group">
	@if(Auth::user()->admin)
	<chat :salas=salas :usuarios=usuarios :admin=true>
	</chat>
	@else
		<chat :salas=salas>
		</chat>
	@endif
</ul>
@endsection

@section('scripts')
<script>
	var app = new Vue({
		el: '#app',
		data: {
			salas: {!! json_encode($salas) !!},
			@if(Auth::user('admin'))
			usuarios: {!! json_encode($usuarios) !!},
			@endif
		}
	})
</script>
@endsection
