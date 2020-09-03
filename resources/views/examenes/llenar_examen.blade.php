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
                                <input disabled type="text" :value="examen.estudiante" class="form-control single-input-form" placeholder="Coloca el nombre del examen...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-0" for="">Facilitador:</label>
                                <input disabled type="text" :value="examen.materia_info.facilitador.name" class="form-control single-input-form" placeholder="Coloca el nombre del examen...">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-1">
                                <label class="mb-0" for="">Fecha:</label>
                                <input disabled type="text" :value="date" class="form-control single-input-form" placeholder="Coloca el nombre del examen...">
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group mb-1">
                                <label class="mb-0" for="">Descripción:</label>
                                <textarea disabled :value="examen.descripcion" name="" id="" cols="30" rows="4" class="form-control single-area-form" placeholder="Coloca la descripcion del examen..."></textarea>
                            </div>
                        </div>
                        <div class="col-md-2 align-items-end d-flex">
                            <div>
                                <p style="font-size: 4em;" class="font-weight-bold mb-0" id="timer">00:00</p>
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
                                        <p  class="mb-0 text-white">@{{tema.nombre}}</p>
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
                    <div class="cancel_saving_button d-inline-block">
                        <button @click="validarCompletadas()" class="btn btn-success rounded-0 ml-2">Enviar Respuestas</button>
                        <a :href="homepath">
                            <button class="btn btn-danger rounded-0 ml-2">Salir</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
         <!-- Modal Pregunta-->
        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="AlertModal" tabindex="-1" role="dialog" aria-labelledby="AlertModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content border-0">
                    <div class="modal-header py-2 bg-info">
                    </div>
                    <div class="modal-body py-1">
                        <section class="row">
                            <aside class="col-md-12">
                                <div class="align-items-center d-flex justify-content-between">
                                    <span v-if="alert_type == 'completado'" class="font-weight-bold">Ya has completado esta prueba anteriormente.</span>
                                    <span v-if="alert_type == 'disponible'" class="font-weight-bold">Esta prueba no se encuentra disponible.</span>
                                    <span v-if="alert_type == 'unavailable'" class="font-weight-bold">Esta prueba ya se encuentra cerrada.</span>
                                    <div class="border d-inline-block m-1 ">
                                        <a :href="homepath">
                                            <button class="btn btn-sm btn-danger btn-section rounded-0">Regresar</button>
                                        </a>
                                    </div>
                                </div>
                            </aside>
                        </section>
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

        var examen = {!! json_encode($examen) !!}
        var completado = {!! json_encode($completado) !!}

        var main = new Vue({
            el : 'main',
            data: {
                examen : examen,
                completado: completado,
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
                alert_type : null,
            },
            mounted: function(){

                if(this.completado.length > 0 || this.examen.disponible == 0){
                    if(this.completado.length > 0){
                        this.alert_type = 'completado';
                    }else{
                        this.alert_type = 'disponible';
                    }
                    $('#AlertModal').modal('show')
                }

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

                var timer_date;
                if(window.localStorage.getItem('timer_date')){
                    timer_date = window.localStorage.getItem('timer_date');
                }else{
                    window.localStorage.setItem('timer_date', moment(new Date()).add(10, 'm').format('YYYY/MM/DD HH:mm:ss'));
                    timer_date = window.localStorage.getItem('timer_date');
                }
                
                setTimeout(function () {
                    $('#timer').countdown(timer_date, function(event) {
                        $(this).html(event.strftime('%M:%S'));
                    }).on('finish.countdown', function(){
                        _this.alert_type = 'unavailable';
                        $('#AlertModal').modal('show')
                    });
                }, 500);
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
                    $(".cancel_saving_button").LoadingOverlay("show");
                    axios.post(homepath + '/examenes/store/respuestas', {examen_id: this.examen.id, temas : this.current_examen}).then(function(response){
                        $(".cancel_saving_button").LoadingOverlay("hide");
                        swal({
                            text: "{{__('¡Tus respuestas fueron guardadas!')}}",
                            icon: "success",
                        }).then(function(){
                            window.localStorage.removeItem('timer_date');
                            window.location.href = homepath + '/examenes/completado/' + response.data;
                        });
                        console.log(response.data)
                    }).catch(function(error){
                        if(error.response.data == 'unavailable'){
                            _this.alert_type = 'unavailable';
                            $('#AlertModal').modal('show')
                        }else{
                            $.toast({
                                heading: 'Error',
                                text: '{{__("Ha ocurrido un error guardando las respuestas.")}}',
                                showHideTransition: 'fade',
                                icon: 'error',
                                position : 'top-right'
                            })
                            console.log(error.response.data)
                        }
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