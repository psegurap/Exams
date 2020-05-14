@extends('layouts.main')
@section('title')Panel de usuarios @endsection
@section('styles')
    
@endsection
@section('content')
    <main>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="text-right border-bottom pb-3">
                    <a href="/register">
                        <button class="btn btn-info">Registrar Usuario</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="table" class="table table-bordered table-hover table-sm text-center table-responsive-sm" style="width:100%">
                    <thead class="table-header bg-info text-white">
                        <tr>
                            <th>{{__('ID')}}</th>
                            <th>{{__('Nombre')}}</th>
                            <th>{{__('Username')}}</th>
                            <th>{{__('Estado')}}</th>
                            <th>{{__('Estudiante')}}</th>
                            <th>{{__('Facilitador')}}</th>
                            <th>{{__('Administrador')}}</th>
                            {{-- <th>{{__('Opciones')}}</th> --}}
                        </tr>
                    </thead>
                    <tbody class="bg-light"></tbody>
                </table>
            </div>
        </div>
        <!-- Modal Materia -->
        <div class="modal fade" id="EstudianteModal" tabindex="-1" role="dialog" aria-labelledby="MateriaModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title mb-0 h6">{{__('Editar Estudiante')}}</p>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <section class="row">
                            <aside class="col-md-12">
                                <div class="form-group">
                                    <label class="" for="">Nombre:</label>
                                    <input v-validate="'required'" type="text" v-model="estudiante.nombre" name="name" class="form-control single-input-form" placeholder="Coloca el nombre de la materia...">
                                    <span class="text-danger" style="font-size: 12px;" v-show="errors.has('name')">* @{{ errors.first('name') }}</span>
                                </div>
                            </aside>
                            <aside class="col-md-12">
                                <div class="form-group">
                                    <label for="">Materia:</label>
                                    <select v-validate="'required'" v-model="estudiante.materia" name="subject" id="" class="form-control single-input-form">
                                        <option disabled value="">Selecciona materia</option>
                                        <option v-for="materia in materias" :value="materia.id">@{{materia.materia}}</option>
                                    </select>
                                    <span class="text-danger" style="font-size: 12px;" v-show="errors.has('subject')">* @{{ errors.first('subject') }}</span>
                                </div>
                            </aside>
                        </section>
                    </div>
                    <div class="modal-footer">
                        <button type="button" @click="validate(updateEstudiante)" class="btn btn-warning btn-sm rounded-0">{{__('Actualizar')}}</button>
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

        var users = {!! json_encode($users) !!} 
        var materias = {!! json_encode($materias) !!} 

        var main = new Vue({
            el: 'main',
            data: {
                users : users,
                materias : materias,
                estudiante: {
                    nombre : '',
                    materia : '',
                },
                current_id : null,
                dt : null,
            },
            mounted: function(){
                var _this = this;
                this.initDataTable();
                setTimeout(function(){
                    $('.custom-control-input').on('change', function(){
                        var _this_ = _this;
                        var coming_values = $(this).attr('info_input').split(',');
                        var activo = $(this).prop("checked");

                        _this_.updateRole(coming_values[0], coming_values[1], activo)
                    });
                }, 1000);
            },
            watch: {
                users : function(val){
                    var _this = this;
                    this.dt.clear()
                    this.dt.rows.add(val);
                    this.dt.draw();

                    setTimeout(function(){
                    $('.custom-control-input').on('change', function(){
                        var _this_ = _this;
                        var coming_values = $(this).attr('info_input').split(',');
                        var activo = $(this).prop("checked");

                        _this_.updateRole(coming_values[0], coming_values[1], activo)
                    });
                }, 100);
                },
                'CurrentEstudiante': function(val){
                    let estudiante = val[0];
                    if(estudiante){
                        this.estudiante.nombre = estudiante.name;
                        this.estudiante.materia = estudiante.estudiante_materia[0].id;
                        // this.materia.facilitador = materia.facilitador_id;
                    }
                }
            },
            computed: {
                CurrentEstudiante: function(){
                    var _this = this;
                    return this.users.filter(function(user){
                        return user.id == _this.current_id;
                    }) 
                }
            },
            methods: {
                closeModal: function(){
                    var _this = this
                    this.estudiante.nombre = '';
                    this.estudiante.materia = '';
                    setTimeout(function() {
                        _this.errors.clear();
                    }, 100);
                },
                updateRole: function(role, id, estado){
                    var _this = this;
                    estado = estado ? 1 : 0;
                    axios.post(homepath + '/usuarios/update_rol/' + role + '/' + id + '/' + estado).then(function(response){
                        _this.users = response.data;
                    }).catch(function(error){
                        console.log(error)
                    });
                },
                agregarMateria: function(id){
                    this.current_id = id;
                    $('#EstudianteModal').modal('show');
                },
                updateEstudiante: function(){
                    var _this = this;
                    axios.post(homepath + '/usuarios/update_estudiante/' + this.CurrentEstudiante[0].id + '/' + this.estudiante.materia).then(function(response){
                        _this.users = response.data;
                        $('#EstudianteModal').modal('hide');
                        _this.closeModal();
                    }).catch(function(error){
                        console.log(error)
                    });
                },
                initDataTable: function(){
                    this.dt = $('#table').DataTable({
                        data : this.users,
                        // responsive : true,
                        columns: [
                            {data : 'id'},
                            {data : 'name'},
                            {data : 'username'},
                            {
                                // data : 'status',
                                render: function(data, type, row){
                                    if(row.status == 1){
                                        return "<div class='custom-control custom-switch'><input type='checkbox' info_input='status," + row.id + "' class='custom-control-input' id='status"+ row.id +"' checked><label class='custom-control-label' for='status"+ row.id +"'></label></div>"
                                        // return "<div class='d-flex justify-content-around'><div class='text-warning' title='Agregar Materia'><i onclick='main.agregarMateria("+row.id+")' style='cursor:pointer' class='fa fa-plus-circle fa-lg' aria-hidden='true'></i></div><div class='custom-control custom-switch'><input type='checkbox' info_input='status," + row.id + "' class='custom-control-input' id='estado"+ row.id +"' checked><label class='custom-control-label' for='estado"+ row.id +"'></label></div></div>"
                                    }else{
                                        return "<div class='custom-control custom-switch'><input type='checkbox' info_input='status," + row.id + "' class='custom-control-input' id='status"+ row.id +"'><label class='custom-control-label' for='status"+ row.id +"'></label></div>"
                                        // return "<div class='d-flex justify-content-around'><div class='text-light'><i class='fa fa-plus-circle fa-lg' aria-hidden='true'></i></div><div class='custom-control custom-switch'><input type='checkbox' info_input='status," + row.id + "' class='custom-control-input' id='estado"+ row.id +"'><label class='custom-control-label' for='estado"+ row.id +"'></label></div></div>"
                                        // return "<div class='custom-control custom-switch'><input type='checkbox' info_input='status," + row.id + "' class='custom-control-input' id='estado"+ row.id +"'><label class='custom-control-label' for='estado"+ row.id +"'></label></div>"
                                    }
                                }
                            },
                            {
                                // data : 'estudiante',
                                render: function(data, type, row){
                                    if(row.estudiante == 1){
                                        return "<div class='d-flex justify-content-center'><div class='custom-control custom-switch'><input type='checkbox' info_input='estudiante," + row.id + "' class='custom-control-input' id='estudiante"+ row.id +"' checked><label class='custom-control-label' for='estudiante"+ row.id +"'></label></div><div class='text-warning' title='Agregar Materia'><i onclick='main.agregarMateria("+row.id+")' style='cursor:pointer' class='fa fa-plus-circle fa-lg' aria-hidden='true'></i></div></div>"
                                    }else{
                                        return "<div class='d-flex justify-content-center'><div class='custom-control custom-switch'><input type='checkbox' info_input='estudiante," + row.id + "' class='custom-control-input' id='estudiante"+ row.id +"'><label class='custom-control-label' for='estudiante"+ row.id +"'></label></div><div class='text-light'><i class='fa fa-plus-circle fa-lg' aria-hidden='true'></i></div></div>"
                                    }
                                }
                            },
                            {
                                // data : 'facilitador',
                                render: function(data, type, row){
                                    if(row.facilitador == 1){
                                        return "<div class='custom-control custom-switch'><input type='checkbox' info_input='facilitador," + row.id + "' class='custom-control-input' id='facilitador"+ row.id +"' checked><label class='custom-control-label' for='facilitador"+ row.id +"'></label></div>"
                                    }else{
                                        return "<div class='custom-control custom-switch'><input type='checkbox' info_input='facilitador," + row.id + "' class='custom-control-input' id='facilitador"+ row.id +"'><label class='custom-control-label' for='facilitador"+ row.id +"'></label></div>"
                                    }
                                }
                            },
                            {
                                // data : 'administrador',
                                render: function(data, type, row){
                                    if(row.administrador == 1){
                                        return "<div class='custom-control custom-switch'><input type='checkbox' info_input='administrador," + row.id + "' class='custom-control-input' id='administrador"+ row.id +"' checked><label class='custom-control-label' for='administrador"+ row.id +"'></label></div>"
                                    }else{
                                        return "<div class='custom-control custom-switch'><input type='checkbox' info_input='administrador," + row.id + "' class='custom-control-input' id='administrador"+ row.id +"'><label class='custom-control-label' for='administrador"+ row.id +"'></label></div>"
                                    }
                                }
                            },
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