@extends('layouts.mensagens-app')

@section('content')
<div id="app">
	<mensagem :socket=socket :sala=sala :usuarios=usuarios :mensagens=mensagens :auth_id=auth_id></mensagem>
</div>
@endsection

@section('scripts')
<script>
	var socket = io('http://' + window.location.hostname + ':3000');	

	console.log(window.location)
	var app = new Vue({
		el: '#app',
		data: {
			sala: @JSON($sala),
			usuarios: @JSON($usuarios),
			mensagens: @JSON($mensagens),
			auth_id: {{Auth::id()}},
			socket: socket,
		}
	})
</script>
@endsection