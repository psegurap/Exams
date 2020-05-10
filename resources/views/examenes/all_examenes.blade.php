@extends('layouts.main')
@section('title')Exámenes @endsection
@section('styles')
    
@endsection
@section('content')
    <main>
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="text-right border-bottom pb-3">
                    <a :href="homepath + '/examenes/create'">
                        <button class="btn btn-info">Crear Examen</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="table" class="table table-bordered table-hover table-sm text-center table-responsive-sm" style="width:100%">
                    <thead class="table-header bg-info text-white">
                        <tr>
                            <th>{{__('Examen')}}</th>
                            <th>{{__('Facilitador')}}</th>
                            <th>{{__('Materia')}}</th>
                            <th>{{__('Modificado')}}</th>
                            <th>{{__('Estado')}}</th>
                            <th>{{__('Opciones')}}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light"></tbody>
                </table>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>

        var examenes = {!! json_encode($examenes) !!}

        var main = new Vue({
            el: 'main',
            data: {
                examenes : examenes,
            },
            mounted: function(){
                this.initDataTable();
            },
            methods: {
                initDataTable: function(){
                    this.dt = $('#table').DataTable({
                        data : this.examenes,
                        // responsive : true,
                        columns: [
                            {data : 'nombre'},
                            {data : 'facilitador_id'},
                            {data : 'materia'},
                            {data : 'updated_at'},
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
                                    return "<div class='d-flex justify-content-around'><div class='text-info' style='font-size: 1.5em;'><i onclick='main.editTemplate("+data+")' style='cursor:pointer' class='fa fa-pencil-square-o' aria-hidden='true'></i></div><div class='text-danger' style='font-size: 1.5em';><i onclick='main.deleteTemplate("+data+")' style='cursor:pointer' class='fa fa-trash' aria-hidden='true'></i></div></div>"
                                }
                            }
                            
                        ]
                    });
                },
            }
        });
  
    </script>
@endsection