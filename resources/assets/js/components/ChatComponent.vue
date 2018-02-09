<template>
	<div class="chat">
		<div class="form-group m-1">
			<input v-model="busca" class="form-control mr-sm-2 col-md-3 col-12" type="search" placeholder="Procurar nome" aria-label="Search">
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
	</div>
</template>

<script>
	export default {
		props: ['salas'],
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
	    }
	}
</script>
