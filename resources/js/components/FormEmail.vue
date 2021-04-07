<template>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Enviar Email</div>

                <div class="card-body">
                    <div>
                        <label for="nombre">Asunto *:</label>
                        <input name="name" placeholder="Asunto" class="required" v-model="asunto" /><br />
                        
                        <label for="mail">Destinatario *:</label>
                        <input name="mail" placeholder="Destinatario" class="required" v-model="destino" /><br />
                                
                        <label id="mensaje" for="comentario">Mensaje *:</label>
                        <textarea id="modif02" placeholder="Escribeme tu comentario aquí" name="comment" v-model="mensaje"></textarea><br />
                                        
                        <div id="aster" > * | Campos obligatorios</div>
                                                
                        <input class="btn btn-primary" type="submit" id="boton" value="Enviar" v-on:click="sendMail()" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
export default {
    data(){
        return {
            asunto: '',
            destino: '',
            mensaje: ''
        }
    },
    methods: {
        sendMail(){
            let params = {
                asunto: this.asunto,
                destino: this.destino,
                mensaje: this.mensaje
            };
            axios.post("sendMail", {
                asunto: this.asunto,
                destino: this.destino,
                mensaje: this.mensaje
            }).then((rs) => {
                alert("Mensaje en Cola de Envio...")
                this.asunto = '';
                this.destino = '';
                this.mensaje = '';
            })
        }
    }
}
</script>

<style>

</style>