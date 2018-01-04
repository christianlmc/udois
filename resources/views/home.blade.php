@extends('layouts.app')

@section('content')

<ul class="list-group">
    @foreach ($salas as $sala)
    <a href="#" class="media list-group-item-action">
    	@if($sala->foto_sala == null)
        	<img class="align-self-center mr-3 rounded-circle img-fluid img-thumbnail" width="80px" src="{{ $sala->grupo ? asset('group.png') : asset('user.png')}}">
        @else
        	<img class="align-self-center mr-3 rounded-circle img-fluid img-thumbnail" width="80px" src="{{Storage::url('profiles/' . $sala->foto_sala)}}">
        @endif
        <div class="media-body">
            <h5 class="mt-0 mb-1">{{ $sala->nome }}</h5>
            <small class="text-muted">{{ $sala->descricao }}</small>
        </div>
    </a>
    <hr class="col-12 my-1">
    @endforeach
</ul>
@endsection
