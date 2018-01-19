@extends('layouts.mensagens-app')

@section('content')
<div id="app">
	<mensagem :sala=sala :usuarios=usuarios :mensagens=mensagens :auth_id=auth_id></mensagem>
</div>
@endsection

@section('scripts')
<script>
	var app = new Vue({
		el: '#app',
		data: {
			sala: @JSON($sala),
			usuarios: @JSON($usuarios),
			mensagens: @JSON($mensagens),
			auth_id: {{Auth::id()}},
		}
	})
</script>
@endsection