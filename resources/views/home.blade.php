@extends('layouts.app')

@section('content')
<ul class="list-group">
	<chat :salas=salas>
	</chat>
</ul>
@endsection

@section('scripts')
<script>
	var app = new Vue({
		el: '#app',
		data: {
			salas: {!! json_encode($salas) !!},
		}
	})
</script>
@endsection
