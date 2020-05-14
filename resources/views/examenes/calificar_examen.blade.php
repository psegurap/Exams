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
                        {{-- <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-0" for="">Fecha:</label>
                                <input disabled type="text" :value="examen_completado.created_at" class="form-control single-input-form" placeholder="Coloca el nombre del examen...">
                            </div>
                        </div> --}}
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-0" for="">Calificacion final:</label>
                                <input type="text"  v-model="examen.calificacion" class="form-control single-input-form" id="calificacion" placeholder="Coloca la calificación final...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-1">
                                <label class="mb-0">Notas:</label>
                                <textarea name="" id="" v-model="examen.notas" cols="30" rows="4" class="form-control single-area-form" placeholder="Colocar alguna una nota adicional..."></textarea>
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
                                                            <div class="col-md-10">
                                                                <p style="word-wrap: break-word;" class="mb-1">@{{index + 1}}. @{{_pregunta.pregunta}}</p>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group">
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" class="custom-control-input" :pregunta_info="[tema.id, _pregunta.id, 1]" :id="'defaultInline1' + _pregunta.id" :checked="_pregunta.calificacion == 1" :name="_pregunta.id">
                                                                        <label class="custom-control-label" :for="'defaultInline1' + _pregunta.id">Correcto</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" class="custom-control-input custom-control-input-incorrect" :pregunta_info="[tema.id, _pregunta.id, '0']" :checked="_pregunta.calificacion == 0" :id="'defaultInline2' + _pregunta.id" :name="_pregunta.id">
                                                                        <label class="custom-control-label" :for="'defaultInline2' + _pregunta.id">Incorrecto</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-12">
                                                                <p class="mb-1">
                                                                    {{-- <span :class="[tema.tipo_pregunta == 'text_libre' ? 'white-space: pre-line' : '']" class="bg-success text-white py-1 px-2 rounded d-inline-block"> --}}
                                                                    <span style="background: #000f2b" :class="[tema.tipo_pregunta == 'texto_libre' ? 'texto_libre px-3 pb-3 rounded' : 'px-2 rounded-0']" class="btn text-white btn-section btn-sm text-left">
                                                                        @{{_pregunta.respuesta}}
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
            <div class="col-12 mb-2">
                <div class="text-right">
                    <div class="cancel_saving_button d-inline-block">
                        <button :disabled="examen.calificacion == '' || examen.calificacion == null" @click="validarCalificadas()" class="btn btn-success rounded-0 ml-2">Guardar Calificación</button>
                        <a :href="homepath">
                            <button class="btn btn-danger rounded-0 ml-2">Salir</button>
                        </a>
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
        
        function Pregunta(id, pregunta, opciones, respuesta, calificacion){
            this.id = id;
            this.pregunta = pregunta;
            this.opciones = opciones;
            this.respuesta = respuesta;
            this.calificacion = calificacion;
        }

        var examen_completado = {!! json_encode($examen_completado) !!}

        var main = new Vue({
            el : 'main',
            data: {
                examen_completado : examen_completado,
                current_examen : null,
                examen : {
                    id: examen_completado.id,
                    calificacion : examen_completado.calificacion_final,
                    notas : examen_completado.notas,
                },
                current_tema : null,
                current_pregunta : null,
            },
            mounted: function(){
                var _this = this;
                this.examen_completado.created_at = moment(examen_completado.created_at).format('DD-MM-YYYY');

                setTimeout(function(){
                    $(document).ready(function () {
                        $("#calificacion").keypress(function (e) {
                            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                                    return false;
                            }
                        });
                    });
                }, 100);

                this.examen_completado.examen.temas = this.examen_completado.examen.temas.map(function(tema){
                    tema.preguntas = tema.preguntas.map(function(pregunta){
                        pregunta = new Pregunta(pregunta.id, pregunta.pregunta, pregunta.select_options, pregunta.respuesta.respuesta, pregunta.respuesta.respuesta_calificacion);
                        return pregunta;
                    });
                    return tema;
                })

                setTimeout(function(){
                    $(".custom-control-input").on('change', function (val) {
                        var _this_ = _this;
                        var coming_values = $(this).attr('pregunta_info').split(",");
                        _this_.updatePregunta(coming_values[0], coming_values[1], coming_values[2]);
                    });
                }, 1000);
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
                updatePregunta: function(tema_id, pregunta_id, calificacion){
                    var _this = this;
                    for (let index = 0; index < this.examen_completado.examen.temas.length; index++) {
                        if (this.examen_completado.examen.temas[index].id == tema_id) {
                            for (let ind = 0; ind < this.examen_completado.examen.temas[index].preguntas.length; ind++) {
                                if (this.examen_completado.examen.temas[index].preguntas[ind].id == pregunta_id) {
                                    this.examen_completado.examen.temas[index].preguntas[ind].calificacion = calificacion;
                                }
                            }
                        }
                    }
                },
                validarCalificadas: function(){
                    var completado = true;
                    for (let index = 0; index < this.examen_completado.examen.temas.length; index++) {
                        for (let ind = 0; ind < this.examen_completado.examen.temas[index].preguntas.length; ind++) {
                            if (this.examen_completado.examen.temas[index].preguntas[ind].calificacion === '') {
                                completado = false;
                                break;
                            }
                        }
                    }
                    console.log(completado)
                    if(completado){
                        this.guardarRespuestas();
                    }else{
                        $.toast({
                            heading: 'Error',
                            text: '{{__("Aun tienes preguntas sin calificar")}}',
                            showHideTransition: 'fade',
                            icon: 'error',
                            position : 'top-right'
                        })
                    }
                },
                guardarRespuestas: function(){
                    var _this = this;
                    $(".cancel_saving_button").LoadingOverlay("show");
                    axios.post(homepath + '/examenes/store/calificacion', {examen: this.examen, temas : this.examen_completado.examen.temas}).then(function(response){
                        $(".cancel_saving_button").LoadingOverlay("hide");
                        swal({
                            text: "{{__('¡La colificación fue guardada!')}}",
                            icon: "success",
                        }).then(function(){
                            window.location.href = homepath + "/examenes/completados";
                        });
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