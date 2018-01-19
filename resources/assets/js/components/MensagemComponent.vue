<template>
    <div>
        <div id="mensagens" class="container-fluid" style="overflow-y: scroll; height: 83vh">
            <div v-for="mensagem in mensagens" 
                :class="[eh_usuario_local(mensagem.membro.usuario_id) ? mensagem_direita.alinhamento : mensagem_esquerda.alinhamento,'my-2'] ">

                <div class="media">
                    <img v-show="!eh_usuario_local(mensagem.membro.usuario_id)" 
                        width="80px" 
                        :src="foto_usuario(mensagem.membro.usuario_id)" 
                        class="rounded-circle">
                    <div class="media-body col-12">
                        <div :class="[eh_usuario_local(mensagem.membro.usuario_id) ? mensagem_direita.cor : mensagem_esquerda.cor,  'card']">
                            <div class="card-body">
                                {{mensagem.texto}}
                            </div>
                            <div class="card-footer px-1 py-0">
                                <small class="text-muted">{{mensagem.hora_enviado}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="container-fluid fixed-bottom">
            <div class="input-group my-2">
                <input type="text" class="form-control" placeholder="Escreva uma mensagem..." aria-label="mensagem" aria-describedby="basic-addon1">
                <div class="input-group-append">
                    <button class="btn btn-outline-udois-blue" type="button"><span class="oi oi-chat"></span></button>
                    <button class="btn btn-outline-udois-blue" type="button"><span class="oi oi-paperclip"></span></button>
                    <button class="btn btn-outline-udois-blue" type="button"><span class="oi oi-microphone"></span></button>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    export default {
        props: ['sala', 'usuarios', 'mensagens', 'auth_id'],
        mounted() {
            console.log('Component mounted.')
        },
        data: function () {
            return {
                mensagem_esquerda: { cor: 'bg-light', alinhamento: 'col-8 col-md-5 px-0'},
                mensagem_direita:  { cor: 'bg-wpp-green', alinhamento: 'col-8 offset-4 col-md-5 offset-md-7'},
            }
        },
        methods: {
            eh_usuario_local: function(usuario_id){
                if (this.auth_id == usuario_id) {
                    return true;
                }
                return false;
            },
            foto_usuario: function(usuario_id){
                var usuario
                usuario = this.usuarios.filter(function(usuario){
                    return usuario_id == usuario.id
                })
                return usuario[0].foto_perfil
            },
            //Funcao que faz ele dar scroll pro fim das mensagens
            scrollToEnd: function(){
                var mensagens = document.querySelector("#mensagens")
                var scrollHeight = mensagens.scrollHeight
                mensagens.scrollTop = scrollHeight
            }
        },
    }
</script>
