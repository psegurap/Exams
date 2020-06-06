@extends('layouts.main')
@section('title'){{ $examen_completado->examen->materia_info->materia}} @endsection
@section('styles')
    
@endsection
@section('content')
    <main>
        <div class="row">
            <div class="col-12">
                <div class="header-pages rounded-top text-white">
                    <span class="text-uppercase">Información General</span>
                </div>
            </div>
            <div class="col-12 mb-3">
                <div class="test-records">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-0" for="">Materia:</label>
                                <input disabled type="text" :value="examen_completado.examen.materia_info.materia" class="form-control single-input-form" >
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-0" for="">Estudiante:</label>
                                <input disabled type="text" :value="examen_completado.user.name" class="form-control single-input-form" placeholder="Coloca el nombre del examen...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-0" for="">Facilitador:</label>
                                <input disabled type="text" :value="examen_completado.examen.materia_info.facilitador.name" class="form-control single-input-form" placeholder="Coloca el nombre del examen...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-0" for="">Fecha:</label>
                                <input disabled type="text" :value="examen_completado.created_at" class="form-control single-input-form" placeholder="Coloca el nombre del examen...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-1">
                                <label class="mb-0">Notas Adicionales:</label>
                                <textarea disabled name="" id="" :value="examen_completado.notas" cols="30" rows="5" class="form-control single-area-form" placeholder="No hay notas adicionales."></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mt-2">
                                <div class="d-inline-block">
                                    <span class="btn btn-primary btn-section btn-sm rounded-0 text-light waves-effect waves-light">Calificación:</span>
                                    <span v-if="examen_completado.calificacion_final != null" class="btn btn-sm btn-success btn-section rounded-0">@{{examen_completado.calificacion_final}}</span>
                                    <span v-else class="btn btn-sm btn-danger btn-section rounded-0">No Disponible</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="width: 100%;" class="mb-4">
                <div v-for="tema in examen_completado.examen.temas" class="col-12">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="header-pages" style="background-color: #17a2b8;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="mb-0 text-white">@{{tema.nombre}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-2">
                            <div class="test-records">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="test-records">
                                            <div class="row">
                                                <div v-for="(_pregunta,index) in tema.preguntas" class="col-12 mb-2">
                                                    <div class="question-container rounded border">
                                                        <div class="row">
                                                            <div class="col-md-11">
                                                                <p style="word-wrap: break-word;" class="mb-1">@{{index + 1}}. @{{_pregunta.pregunta}}</p>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <div>
                                                                    <span v-if="_pregunta.respuesta.respuesta_calificacion == 1"><i class="fa fa-check fa-lg text-success" aria-hidden="true"></i></span>
                                                                    <span v-if="_pregunta.respuesta.respuesta_calificacion == 0"><i class="fa fa-times fa-lg text-danger" aria-hidden="true"></i></span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="mb-1">
                                                                    <span style="background: #000f2b" :class="[tema.tipo_pregunta == 'texto_libre' ? 'texto_libre px-3 pb-3 rounded' : 'px-2 rounded-0']" class="btn text-white btn-section btn-sm text-left">
                                                                        @{{_pregunta.respuesta.respuesta}}
                                                                    </span>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
    </main>
@endsection

@section('scripts')
    <script>
        Vue.use(VeeValidate);

        function Tema(id, nombre, tipo, preguntas){
            this.id = id;
            this.nombre = nombre;
            this.tipo = tipo;
            this.preguntas = preguntas;
        }
        
        function Pregunta(id, pregunta, opciones){
            this.id = id;
            this.pregunta = pregunta;
            this.opciones = opciones;
            this.respuesta = ''
        }

        var examen_completado = {!! json_encode($examen_completado) !!}

        var main = new Vue({
            el : 'main',
            data: {
                examen_completado : examen_completado,
                current_examen : null,
                examen_info : {
                    materia : 'deleniti provident nobis',
                    estudiante : 'et dolorem qui',
                    facilitador : 'architecto itaque cupiditate',
                    fecha : 'illo laboriosam dolorem',
                    descripcion : 'quo ipsum laborum Maxime ex quia sit provident voluptatibus recusandae dolor eligendi sint. Impedit autem eos optio. Omnis ratione velit quia voluptatem. Aperiam corporis et est ab doloremque facere asperiores et saepe. Odio deserunt et. Optio voluptate ullam nobis iusto rerum aliquid odit.',
                },
                current_tema : null,
                current_pregunta : null,
            },
            mounted: function(){
                this.examen_completado.created_at = moment(examen_completado.created_at).format('DD-MM-YYYY');
            },
            computed : {
                CurrentTema: function(){
                    var _this = this;
                    return this.template_info.temas.filter(function(tema){
                        _this.preguntas = tema.preguntas;
                        return tema.id == _this.current_tema;
                    });
                },
                CurrentPregunta: function(){
                    var _this = this;
                    return this.preguntas.filter(function(pregunta){
                        return pregunta.id == _this.current_pregunta;
                    });
                },
            },
            watch : {
                
            },
            methods: {
                randomString: function(){
                    var result = '';
                    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                    var charactersLength = characters.length;
                    for ( var i = 0; i < 10; i++ ) {
                        result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    }
                    return result;
                },
                openModal: function(modal, type, current_modal){
                    this.tema_view = type;
                    this.pregunta_view = type;
                    this.current_modal = current_modal;
                    setTimeout(function(){
                        $("#" + modal).modal('show');
                    }, 100);
                },
                closeModal: function(){
                    var _this = this
                    this.tema.nombre = '';
                    this.tema.tipo = '';
                    this.pregunta.pregunta = '';
                    this.pregunta.opciones = [];
                    setTimeout(function() {
                        _this.errors.clear();
                    }, 100);
                },
                updatePregunta: function(tema_id, pregunta_id, respuesta){
                    var _this = this;
                    for (let index = 0; index < this.current_examen.length; index++) {
                        if (this.current_examen[index].id == tema_id) {
                            for (let ind = 0; ind < this.current_examen[index].preguntas.length; ind++) {
                                if (this.current_examen[index].preguntas[ind].id == pregunta_id) {
                                    this.current_examen[index].preguntas[ind].respuesta = respuesta;
                                }
                            }
                        }
                    }
                },
                validarCompletadas: function(){
                    var completado = true;
                    for (let index = 0; index < this.current_examen.length; index++) {
                        for (let ind = 0; ind < this.current_examen[index].preguntas.length; ind++) {
                            if (this.current_examen[index].preguntas[ind].respuesta == '') {
                                completado = false;
                                break;
                            }
                        }
                    }
                    if(completado){
                        this.guardarRespuestas();
                    }else{
                        $.toast({
                            heading: 'Error',
                            text: '{{__("Aun tienes preguntas sin responder")}}',
                            showHideTransition: 'fade',
                            icon: 'error',
                            position : 'top-right'
                        })
                    }
                },
                guardarRespuestas: function(){
                    var _this = this;
                    axios.post(homepath + '/examenes/store/respuestas', {examen_id: this.examen.id, temas : this.current_examen}).then(function(response){
                        console.log(response.data)
                    }).catch(function(error){
                        console.log(error)
                    });
                },
                validate: function(callback){
                    var _this = this;
                    this.$validator.validateAll().then(function(result){
                        if(result){
                            callback();
                        }else{
                            $.toast({
                            heading: 'Error',
                            text: '{{__("You need to fix the errors")}}',
                            showHideTransition: 'fade',
                            icon: 'error',
                            position : 'top-right'
                            })
                        }
                    })
                }
            }
        });
    </script>
@endsection