@extends('layouts.main')
@section('title')Inicio @endsection
@section('content')
    <main>
        <div class="row">
            <div v-for="exam in exams" class="col-md-6 mt-2">
                <div class="test-records">
                    <div class="row">
                        <div class="col-lg-7 text-info">
                            <p class="mb-1 text-capitalize">@{{exam.materia_info.materia}}</p>
                            <p class="mb-1 text-dark"><span class="text-info">Facilitador:</span> @{{exam.materia_info.facilitador.name}}</p>
                        </div>
                        <div class="col-lg-5 text-right">
                            <p v-if="exam.disponible == 0" class="bg-danger btn btn-sm text-white btn-section d-inline-block mb-1 px-2 rounded-0 text-center">No Disponible</p>
                            <a v-if="exam.disponible == 1" :href="homepath + '/examenes/llenar/' + exam.id">
                                <p class="bg-success btn btn-sm text-white btn-section d-inline-block mb-1 px-2 rounded-0 text-center">Disponible</p>
                            </a>
                            {{-- <p class="bg-warning text-white d-inline-block mb-1 px-2 rounded text-center">Completado</p> --}}
                            {{-- <p class="bg-info text-white d-inline-block mb-1 px-2 rounded text-center">Calificado</p> --}}
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