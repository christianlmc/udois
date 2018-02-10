<template>
	<div class="chat">
		<div class="form-group clearfix m-1">
			<input v-model="busca" class="form-control col-10 col-md-4 float-left" type="search" placeholder="Procurar nome" aria-label="Search">
			<button v-show='admin' type="button" class="btn btn-success float-right" @click="novo_chat" data-toggle="modal" data-target="#usuarios">
				<span class="oi oi-plus"></span>
			</button>
		</div>
		<hr class="my-0">
		<div v-for="sala in salas_filtradas">
			<a :href="'sala/'+ sala.id" class="media list-group-item-action">
				<img class="align-self-center mr-3 rounded-circle img-fluid img-thumbnail" width="80px" :src="sala.foto_sala" >
				<div class="media-body">
					<h5 class="mt-0 mb-1">{{ sala.nome }}</h5>
					<small class="text-muted">{{ sala.descricao }}</small>
				</div>
				
				<div class="m-2">
					<a class="btn btn-primary text-white">
						<span class="badge badge-light" v-show="sala.nao_lidas">{{sala.nao_lidas}}</span>
						<span class="oi oi-chat"></span>
					</a>
				</div>
			</a>
			<hr class="my-0">
		</div>
		<div class="modal fade" id="usuarios" tabindex="-1" role="dialog" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Iniciar uma conversa com:</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div v-for="usuario in usuarios" class="modal-body">
						<a :href="'admin/sala/criar/'+ usuario.id" class="media list-group-item-action">
							<img class="align-self-center mr-3 rounded-circle img-fluid img-thumbnail" width="80px" :src="usuario.foto_sala" >
							<div class="media-body">
								<h5 class="mt-0 mb-1">{{ usuario.nome }}</h5>
								<small class="text-muted">{{ usuario.descricao }}</small>
							</div>

							<div class="m-2">
								<a class="btn btn-primary text-white">
									<span class="oi oi-chat"></span>
								</a>
							</div>
						</a>
						<hr class="my-0">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: ['salas', 'usuarios', 'admin'],
		mounted() {

		},
		data: function () {
    		return {
				busca: ""
			}
		},
		computed: {
	        salas_filtradas: function () {
	            var busca = this.busca;

	            if(!busca){
	                return this.salas;
	            }

	            busca = busca.trim().toLowerCase();

	            var salas_filtradas = _.filter(this.salas, function(sala) {
	            	if (sala.nome.toLowerCase().indexOf(busca) !== -1 || 
	            		sala.descricao.toLowerCase().indexOf(busca) !== -1)
	            	return sala;
	            });

	            return salas_filtradas;
	        }
	    },
	    methods: {
	    	novo_chat: function(){
	    		console.log(this.usuarios[0])
	    	}
	    }
	}
</script>
