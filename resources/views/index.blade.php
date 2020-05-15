@extends('layouts.main')
@section('title')Inicio @endsection
@section('content')
    <main>
        <div class="row">
            <div v-if="exams.length > 0" v-for="(exam, index) in exams" class="col-md-6 mt-2">
                <div class="test-records">
                    <div class="row">
                        <div class="col-lg-7 text-info">
                            <p class="mb-1 text-capitalize">@{{exam.materia_info.materia}}</p>
                            <p class="mb-1 text-dark"><span class="text-info">Facilitador:</span> @{{exam.materia_info.facilitador.name}}</p>
                        </div>
                        <div class="col-lg-5 text-right">
                            <p v-if="exam.disponible == 0" class="bg-danger btn btn-sm text-white btn-section d-inline-block mb-1 px-2 rounded-0 text-center">No Disponible</p>
                            <a v-else-if="exam.disponible == 1 && exam.examenes_completados.length == 0" :href="homepath + '/examenes/llenar/' + exam.id">
                                <p class="bg-success btn btn-sm text-white btn-section d-inline-block mb-1 px-2 rounded-0 text-center"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> Disponible</p>
                            </a>
                            <a v-else-if="exam.examenes_completados.length > 0 && exam.examenes_completados[0].calificacion_final == null" target="_blank" :href="homepath + '/examenes/completado/' + exam.examenes_completados[0].id">
                                <p class="bg-warning btn btn-sm text-white btn-section d-inline-block mb-1 px-2 rounded-0 text-center"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> Completado</p>
                            </a>
                            <a v-else-if="exam.examenes_completados.length > 0 && exam.examenes_completados[0].calificacion_final != null" target="_blank" :href="homepath + '/examenes/completado/' + exam.examenes_completados[0].id">
                                <p class="bg-info btn btn-sm text-white btn-section d-inline-block mb-1 px-2 rounded-0 text-center"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> Calificado</p>
                            </a>
                        </div>
                    </div>
                    {{-- <a href="#" class="text-dark">
                    </a> --}}
                </div>
            </div>
            <div v-if="exams.length == 0" class="col-md-6 mt-2">
                <div class="test-records">
                    <div class="row">
                        <div class="col-lg-7 text-info">
                            <p class="mb-1 text-capitalize">@{{user.estudiante_materia[0].materia}}</p>
                            <p class="mb-1 text-dark"><span class="text-info">Facilitador:</span> @{{user.estudiante_materia[0].facilitador.name}}</p>
                        </div>
                        <div class="col-lg-5 text-right">
                            <p class="bg-danger btn btn-sm text-white btn-section d-inline-block mb-1 px-2 rounded-0 text-center">No Disponible</p>
                        </div>
                    </div>
                    {{-- <a href="#" class="text-dark">
                    </a> --}}
                </div>
            </div>
        </div>
    </main>
@endsection

@section('scripts')
    <script>
        var exams = {!! json_encode($exams) !!}
        var user = {!! json_encode($user) !!}

        var main = new Vue({
            el: 'main',
            data: {
                exams : exams,
            },
            mounted: function(){
                
            },
            watch: {
                
            },
            computed: {
                
            },
            methods: {
                
            }
        });
    </script>
@endsection