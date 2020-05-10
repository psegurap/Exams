@extends('layouts.main')
@section('title')Panel de usuarios @endsection
@section('styles')
    
@endsection
@section('content')
    <main>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="text-right border-bottom pb-3">
                    <button @click="openModal('MateriaModal', 'create')" class="btn btn-info">Registrar Usuario</button>
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

        var users = {!! json_encode($users) !!} 

        var main = new Vue({
            el: 'main',
            data: {
                users : users,
                materia: {
                    nombre : '',
                    facilitador : '',
                },
                materia_view: 'create',
                current_materia : null,
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
                // materias : function(val){
                //     this.dt.clear()
                //     this.dt.rows.add(val);
                //     this.dt.draw();
                // },
                // 'CurrentMateria': function(val){
                //     let materia = val[0];
                //     if(materia){
                //         this.materia.nombre = materia.materia;
                //         this.materia.facilitador = materia.facilitador_id;
                //     }
                // }
            },
            computed: {
                // CurrentMateria: function(){
                //     var _this = this;
                //     return this.materias.filter(function(materia){
                //         return materia.id == _this.current_materia;
                //     }) 
                // }
            },
            methods: {
                updateRole: function(role, id, estado){
                    estado = estado ? 1 : 0;

                    axios.post(homepath + '/usuarios/update_rol/' + role + '/' + id + '/' + estado).then(function(response){

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
                                        return "<div class='custom-control custom-switch'><input type='checkbox' info_input='status," + row.id + "' class='custom-control-input' id='estado"+ row.id +"' checked><label class='custom-control-label' for='estado"+ row.id +"'></label></div>"
                                    }else{
                                        return "<div class='custom-control custom-switch'><input type='checkbox' info_input='status," + row.id + "' class='custom-control-input' id='estado"+ row.id +"'><label class='custom-control-label' for='estado"+ row.id +"'></label></div>"
                                    }
                                }
                            },
                            {
                                // data : 'estudiante',
                                render: function(data, type, row){
                                    if(row.estudiante == 1){
                                        return "<div class='custom-control custom-switch'><input type='checkbox' info_input='estudiante," + row.id + "' class='custom-control-input' id='estudiante"+ row.id +"' checked><label class='custom-control-label' for='estudiante"+ row.id +"'></label></div>"
                                    }else{
                                        return "<div class='custom-control custom-switch'><input type='checkbox' info_input='estudiante," + row.id + "' class='custom-control-input' id='estudiante"+ row.id +"'><label class='custom-control-label' for='estudiante"+ row.id +"'></label></div>"
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