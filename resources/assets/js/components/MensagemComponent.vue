<template>
    <div>
        <div id="mensagens" class="container-fluid" style="overflow-y: scroll; height: 83vh">
            <div v-for="mensagem in mensagens" 
                :class="[eh_usuario_local(mensagem.usuario.id) ? mensagem_direita.alinhamento : mensagem_esquerda.alinhamento,'my-2'] ">

                <div class="media">
                    <img v-show="!eh_usuario_local(mensagem.usuario.id)" 
                        width="80px" 
                        :src="foto_usuario(mensagem.usuario.id)" 
                        class="rounded-circle">
                    <div class="media-body col-12">
                        <div :class="[eh_usuario_local(mensagem.usuario.id) ? mensagem_direita.cor : mensagem_esquerda.cor,  'card']">
                            <div class="card-body">
                                <div class="card-text">{{mensagem.texto}}</div>
                                <div class="card-text">
                                    <small class="text-muted">{{mensagem.hora_enviado}}</small>
                                    <span v-show="eh_usuario_local(mensagem.usuario.id)" 
                                    :class="[mensagem.hora_visualizado == null ? 'text-muted' : 'text-info', 'oi oi-check']"
                                    :title="mensagem.hora_visualizado"
                                    >
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="container-fluid fixed-bottom">
            <div class="input-group my-2">
                <input type="text" class="form-control" placeholder="Escreva uma mensagem..." v-model="texto" @keyup.enter="enviar_mensagem()" autofocus>
                <div class="input-group-append">
                    <button class="btn btn-outline-udois-blue" type="button" @click="enviar_mensagem()"><span class="oi oi-chat"></span></button>
                    <button class="btn btn-outline-udois-blue" type="button"><span class="oi oi-paperclip"></span></button>
                    <button class="btn btn-outline-udois-blue" type="button"><span class="oi oi-microphone"></span></button>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>
    export default {
        props: ['sala', 'usuarios', 'mensagens', 'auth_id', 'socket'],
        mounted() {
            var self = this

            this.scrollToEnd()
            
            this.socket.emit('joining', window.location.pathname);
            this.socket.on('chat message',function(msg){
                self.mensagens.push(msg)
                Vue.nextTick(function () {
                    self.scrollToEnd()
                })
            });

            this.visualizar_mensagem(false, false)
            this.socket.on('seen messages',function(datetime){
                for(var i = 0; i < self.mensagens.length; i++){
                    if (self.mensagens[i].hora_visualizado == null && self.mensagens[i].usuario.id == self.auth_id){
                        console.log(self.mensagens[i])
                        self.mensagens[i].hora_visualizado = datetime
                    }
                }
            });
        },
        data: function () {
            return {
                texto: '',
                mensagem_esquerda: { cor: 'bg-light', alinhamento: 'col-8 col-md-5 px-0'},
                mensagem_direita:  { cor: 'bg-wpp-green', alinhamento: 'col-8 offset-4 col-md-5 offset-md-7'},
            }
        },
        watch: {
            mensagens: function () {
                var self = this
                var mensagens_nao_lidas = false

                //Verifica se ha mensagem nao lida
                for(var i = 0; i < self.mensagens.length; i++){
                    if (self.mensagens[i].usuario.id != self.auth_id && self.mensagens[i].hora_visualizado == null){
                        mensagens_nao_lidas = true
                        break
                    }
                }

                if(mensagens_nao_lidas == false)
                    return
                else{
                    this.visualizar_mensagem(true, true)
                }
            }
        },
        methods: {
            visualizar_mensagem: function (filtrado, mensagens_nao_lidas) {
                var url = window.location.href
                var self = this

                if (filtrado == false) {
                    for(var i = 0; i < self.mensagens.length; i++){
                        console.log(self.mensagens[i])
                        if (self.mensagens[i].usuario.id != self.auth_id && self.mensagens[i].hora_visualizado == null){
                            mensagens_nao_lidas = true
                            break
                        }
                    }
                }

                console.log(mensagens_nao_lidas)

                if(mensagens_nao_lidas == true){
                    axios.put(url)
                        .then(function (response){
                            console.log(response.data)
                            self.socket.emit('seen messages', response.data[0].hora_visualizado);
                        })
                }
            },
            enviar_mensagem: function(){
                if (!this.texto) { return }
                var self = this

                var url = window.location.href

                axios.post(url, {
                        texto: this.texto
                    })
                    .then(function (response){
                        // console.log(response.data)
                        self.socket.emit('chat message', response.data);
                    })

                this.texto = ''

            },
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
