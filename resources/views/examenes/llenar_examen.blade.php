@extends('layouts.main')
@section('title'){{$examen->materia_info->materia}} @endsection
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
                                <input disabled type="text" :value="examen.materia_info.materia" class="form-control single-input-form">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-0" for="">Estudiante:</label>
                                <input disabled type="text" v-model="examen_info.estudiante" class="form-control single-input-form" placeholder="Coloca el nombre del examen...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-0" for="">Facilitador:</label>
                                <input disabled type="text" :value="examen.materia_info.facilitador_id" class="form-control single-input-form" placeholder="Coloca el nombre del examen...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-0" for="">Fecha:</label>
                                <input disabled type="text" :value="date" class="form-control single-input-form" placeholder="Coloca el nombre del examen...">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-1">
                                <label class="mb-0" for="">Descripción:</label>
                                <textarea disabled :value="examen.descripcion" name="" id="" cols="30" rows="4" class="form-control single-area-form" placeholder="Coloca la descripcion del examen..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div style="width: 100%;">
                <div v-for="tema in current_examen" class="col-12">
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
                                                            <div class="col-12">
                                                                <div class="form-group" v-if="tema.tipo == 'completa'">
                                                                    <input type="text" class="form-control single-input-form" :pregunta_info="[tema.id, _pregunta.id]" placeholder="Escribe tu respuesta aqui">
                                                                </div>
                                                                <div class="form-group" v-if="tema.tipo == 'falsoVerdadero'">
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" class="custom-control-input" :pregunta_info="[tema.id, _pregunta.id, 'Verdadero']" :id="'defaultInline1' + _pregunta.id" :name="_pregunta.id">
                                                                        <label class="custom-control-label" :for="'defaultInline1' + _pregunta.id">Verdadero</label>
                                                                    </div>
                                                                    <div class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" class="custom-control-input" :pregunta_info="[tema.id, _pregunta.id, 'Falso']" :id="'defaultInline2' + _pregunta.id" :name="_pregunta.id">
                                                                        <label class="custom-control-label" :for="'defaultInline2' + _pregunta.id">Falso</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" v-if="tema.tipo == 'selectMultiple'">
                                                                    <div v-for="(opcion, ind) in _pregunta.opciones" class="custom-control custom-radio custom-control-inline">
                                                                        <input type="radio" class="custom-control-input" :pregunta_info="[tema.id, _pregunta.id, opcion]" :id="'SelecMultiple' + index + ind" :name="'SelecMultiple' + index">
                                                                        <label class="custom-control-label" :for="'SelecMultiple' + index + ind">@{{opcion}}</label>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group" v-if="tema.tipo == 'texto_libre'">
                                                                    <textarea name="" id="" cols="30" rows="10" class="form-control single-area-form" :pregunta_info="[tema.id, _pregunta.id]" placeholder="Coloca la respuesta aqui..."></textarea>
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
            <div class="col-12 mb-2">
                <div class="text-right">
                    <button @click="validarCompletadas()" class="btn btn-success rounded-0 ml-2">Enviar Respuestas</button>
                    <button class="btn btn-danger rounded-0 ml-2">Salir</button>
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

        var examen = {!! json_encode($examen) !!}

        var main = new Vue({
            el : 'main',
            data: {
                examen : examen,
                current_examen : null,
                examen_info : {
                    estudiante : 'et dolorem qui',
                    facilitador : 'architecto itaque cupiditate',
                    fecha : 'illo laboriosam dolorem',
                    descripcion : 'quo ipsum laborum Maxime ex quia sit provident voluptatibus recusandae dolor eligendi sint. Impedit autem eos optio. Omnis ratione velit quia voluptatem. Aperiam corporis et est ab doloremque facere asperiores et saepe. Odio deserunt et. Optio voluptate ullam nobis iusto rerum aliquid odit.',
                },
                current_tema : null,
                current_pregunta : null,
                date : null,
            },
            mounted: function(){
                if(window.innerWidth > 500){
                    $('#sidebar').toggleClass('active');
                }

                this.date = moment().format('DD-MM-YYYY');

                this.current_examen = this.examen.temas.map(function(tema){
                    tema = new Tema(tema.id, tema.nombre, tema.tipo_pregunta, tema.preguntas);
                    tema.preguntas = tema.preguntas.map(function(pregunta){
                        pregunta = new Pregunta(pregunta.id, pregunta.pregunta, pregunta.select_options);
                        return pregunta;
                    });
                    return tema;
                })

                var _this = this;
                setTimeout(function(){
                    $(".custom-control-input").on('change', function (val) {
                        var _this_ = _this;
                        var coming_values = $(this).attr('pregunta_info').split(",");
                        _this_.updatePregunta(coming_values[0], coming_values[1], coming_values[2]);
                    });

                    $(".single-input-form").on('change', function (val) {
                        var _this_ = _this;
                        var coming_values = $(this).attr('pregunta_info').split(",");
                        _this_.updatePregunta(coming_values[0], coming_values[1], $(this).val());
                    });

                    $(".single-area-form").on('change', function (val) {
                        var _this_ = _this;
                        var coming_values = $(this).attr('pregunta_info').split(",");
                        _this_.updatePregunta(coming_values[0], coming_values[1], $(this).val());
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