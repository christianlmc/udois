<template>
    <div>
        <div id="mensagens" class="container-fluid" style="overflow-y: scroll; height: 83vh">
            
            <div class="row justify-content-center my-2">
                <button v-show="load_more_btn" type="button" @click="carregar_mensagens()" class="btn badge badge-primary">Carregar mensagens antigas</button>
            </div>

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
                                <div class="card-text" v-if="!mensagem.arquivo">{{mensagem.texto}}</div>
                                <div class="card-text" v-else>
                                    <a :href="'/storage/download/' + sala.id + '/' + mensagem.arquivo">
                                        {{mensagem.texto}}
                                        <span class="oi oi-data-transfer-download"></span>
                                    </a>
                                </div>
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
                    <button class="btn btn-outline-udois-blue" type="button" @click="upload_btn()"><span class="oi oi-paperclip"></span></button>
                    <button class="btn btn-outline-udois-blue" type="button"><span class="oi oi-microphone"></span></button>
                </div>
            </div>
        </footer>
        <input @change="file_selected" type="file" ref="upload" hidden>
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
                for(let i = 0; i < self.mensagens.length; i++){
                    if (self.mensagens[i].hora_visualizado == null){
                        // console.log(self.mensagens[i])
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
                load_more_btn: true,
            }
        },
        watch: {
            mensagens: function () {
                var self = this
                var mensagens_nao_lidas = false

                //Verifica se ha mensagem nao lida
                for(let i = 0; i < self.mensagens.length; i++){
                    if (self.mensagens[i].usuario.id != self.auth_id && self.mensagens[i].hora_visualizado == null){
                        console.log(self.mensagens[i])
                        mensagens_nao_lidas = true
                        break
                    }
                }

                if(mensagens_nao_lidas == false){
                    return
                }
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
                    for(let i = 0; i < self.mensagens.length; i++){
                        // console.log(self.mensagens[i])
                        if (self.mensagens[i].usuario.id != self.auth_id && self.mensagens[i].hora_visualizado == null){
                            mensagens_nao_lidas = true
                            break
                        }
                    }
                }

                // console.log(mensagens_nao_lidas)

                if(mensagens_nao_lidas == true){
                    axios.put(url)
                    .then(function (response){
                        // console.log(response.data)
                        if(response) 
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
            carregar_mensagens: function(){
                var self = this

                var url = window.location.href + '/mensagem/' + this.mensagens[0].id

                axios.get(url).then(function (response){
                    // console.log(response.data)
                    _.forEach(response.data, function(mensagem) {
                        self.mensagens.unshift(mensagem)
                    });
                    if(response.data.length == 0){
                        self.load_more_btn = false
                    }
                })
            },
            //Funcao que verifica se o usuario em questao eh o usuario local
            eh_usuario_local: function(usuario_id){
                return this.auth_id == usuario_id;
            },
            //Funcao que permite o upload de arquivos
            upload_btn: function(){
                this.$refs.upload.click()
            },
            file_selected: function(e){
                let file = e.target.files || e.dataTransfer.files;
                if (!file.length) {
                     return;
                }
                this.upload_file(file[0])
            },
            upload_file: function (file) {
                // let reader = new FileReader()
                let self = this
                let url = window.location.href

                const formData = new FormData()
                formData.append('arquivo', file)

                axios.post(url, formData)
                .then(function (response) {
                  // console.log(response)
                  self.socket.emit('chat message', response.data);
                })
            },
            //Funcao que retorna a foto do usuario
            foto_usuario: function(usuario_id){
                return _.find(this.usuarios, { 'id': usuario_id}).foto_perfil
            },
            //Funcao que faz ele dar scroll pro fim das mensagens
            scrollToEnd: function(){
                let mensagens = document.querySelector("#mensagens")
                let scrollHeight = mensagens.scrollHeight
                mensagens.scrollTop = scrollHeight
            }
        },
    }
</script>
