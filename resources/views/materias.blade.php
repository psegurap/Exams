@extends('layouts.main')
@section('title')Materias @endsection
@section('styles')
    
@endsection
@section('content')
    <main>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="text-right border-bottom pb-3">
                    <button @click="openModal('MateriaModal', 'create')" class="btn btn-info">Registrar Materia</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="table" class="table table-bordered table-hover table-sm text-center table-responsive-sm" style="width:100%">
                    <thead class="table-header bg-info text-white">
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Materia')}}</th>
                            <th>{{__('Facilitador')}}</th>
                            <th>{{__('Estado')}}</th>
                            <th>{{__('Opciones')}}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light"></tbody>
                </table>
            </div>
        </div>
        <!-- Modal Materia -->
        <div class="modal fade" id="MateriaModal" tabindex="-1" role="dialog" aria-labelledby="MateriaModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <p v-if="materia_view == 'create'" class="modal-title mb-0 h6">{{__('Agregar Materia')}}</p>
                        <p v-if="materia_view == 'edit'" class="modal-title mb-0 h6">{{__('Editar Materia')}}</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <section class="row">
                            <aside class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="">Nombre:</label>
                                    <input v-validate="'required'" type="text" v-model="materia.nombre" name="name" class="form-control single-input-form" placeholder="Coloca el nombre de la materia...">
                                    <span class="text-danger" style="font-size: 12px;" v-show="errors.has('name')">* @{{ errors.first('name') }}</span>
                                </div>
                            </aside>
                            <aside class="col-md-12">
                                <div class="form-group">
                                    <label for="">Facilitador:</label>
                                    <select v-validate="'required'" v-model="materia.facilitador" name="facilitator" id="" class="form-control single-input-form">
                                        <option disabled value="">Selecciona facilitador</option>
                                        <option value="1">laborum at assumenda</option>
                                        <option value="2">omnis velit modi</option>
                                        <option value="3">consequatur veritatis eius</option>
                                        <option value="4">exercitationem velit doloremque</option>
                                    </select>
                                    <span class="text-danger" style="font-size: 12px;" v-show="errors.has('facilitator')">* @{{ errors.first('facilitator') }}</span>
                                </div>
                            </aside>
                        </section>
                    </div>
                    <div class="modal-footer">
                        <button v-if="materia_view == 'create'" type="button" @click="validate(agregarMateria)" class="btn btn-info btn-sm rounded-0">{{__('Agregar')}}</button>
                        <button v-if="materia_view == 'edit'" type="button" @click="validate(updateMateria)" class="btn btn-warning btn-sm rounded-0">{{__('Actualizar')}}</button>
                        <button type="button" class="btn btn-danger btn-sm rounded-0" @click="closeModal()" data-dismiss="modal">{{__('Cerrar')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        Vue.use(VeeValidate);

        var materias = {!! json_encode($materias) !!} 

        var main = new Vue({
            el: 'main',
            data: {
                materias : materias,
                materia: {
                    nombre : '',
                    facilitador : '',
                },
                materia_view: 'create',
                current_materia : null,
            },
            mounted: function(){
                this.initDataTable();
            },
            watch: {
                materias : function(val){
                    this.dt.clear()
                    this.dt.rows.add(val);
                    this.dt.draw();
                },
                'CurrentMateria': function(val){
                    let materia = val[0];
                    if(materia){
                        this.materia.nombre = materia.materia;
                        this.materia.facilitador = materia.facilitador_id;
                    }
                }
            },
            computed: {
                CurrentMateria: function(){
                    var _this = this;
                    return this.materias.filter(function(materia){
                        return materia.id == _this.current_materia;
                    }) 
                }
            },
            methods: {
                openModal: function(modal, type){
                    this.materia_view = type;
                    this.pregunta_view = type;
                    setTimeout(function(){
                        $("#" + modal).modal('show');
                    }, 100);
                },
                closeModal: function(){
                    var _this = this
                    this.materia.nombre = '';
                    this.materia.facilitador = '';
                    setTimeout(function() {
                        _this.errors.clear();
                    }, 100);
                },
                agregarMateria: function(){
                    var _this = this;
                    axios.post(homepath + '/materias/store', {materia : this.materia}).then(function(response){
                        _this.materias = response.data;
                        _this.materia.nombre = '';
                        _this.materia.facilitador = '';
                        setTimeout(function() {
                            _this.errors.clear();
                        }, 100);
                        $('#MateriaModal').modal('hide');
                    }).catch(function(error){
                        console.log(error)
                    });
                },
                editMateria: function(id){
                    this.current_materia = id;
                    this.openModal('MateriaModal', 'edit');
                },
                updateMateria: function(){
                    var _this = this;
                    axios.post(homepath + '/materias/update/' + this.current_materia, {materia : this.materia}).then(function(response){
                        _this.materias = response.data;
                        _this.materia.nombre = '';
                        _this.materia.facilitador = '';
                        setTimeout(function() {
                            _this.errors.clear();
                        }, 100);
                        $('#MateriaModal').modal('hide');
                    }).catch(function(error){
                        console.log(error)
                    });
                },
                deleteMateria: function(id){
                    var _this = this;
                    axios.post(homepath + '/materias/delete/' + id).then(function(response){
                        _this.materias = response.data;
                    }).catch(function(error){
                        console.log(error)
                    });
                },
                initDataTable: function(){
                    this.dt = $('#table').DataTable({
                        data : this.materias,
                        // responsive : true,
                        columns: [
                            {data : 'id'},
                            {data : 'materia'},
                            {data : 'facilitador_id'},
                            {
                                data: 'status',
                                render: function(data, row){
                                    if(data == 1){
                                        return '<i class="fa fa-circle text-success" aria-hidden="true"></i>'
                                    }else{
                                        return '<i class="fa fa-circle text-secondary" aria-hidden="true"></i>'
                                    }
                                }
                            },
                            {
                                data : 'id',
                                render: function(data, row){
                                    return "<div class='d-flex justify-content-around'><div class='text-info' style='font-size: 1.5em;'><i onclick='main.editMateria("+data+")' style='cursor:pointer' class='fa fa-pencil-square-o' aria-hidden='true'></i></div><div class='text-danger' style='font-size: 1.5em';><i onclick='main.deleteMateria("+data+")' style='cursor:pointer' class='fa fa-trash' aria-hidden='true'></i></div></div>"
                                }
                            }
                            
                        ]
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
                            text: '{{__("Necesitas corregir los errores")}}',
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