<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Examen;
use App\Tema;
use App\Pregunta;
use App\Respuesta;
use App\ExamenCompletado;
use App\Materia;

class ExamenController extends Controller
{
    public function all()
    {
        $examenes = Examen::with(['temas' => function($query){
            $query->with('preguntas')->where('status', 1)->get();
        }])->where('status', 1)->get();
        return view('examenes.all_examenes', compact('examenes'));
    }

    public function create()
    {
        $materias = Materia::where('status', 1)->get();
        return view('examenes.create', compact('materias'));
    }

    public function store(Request $request)
    {
        $template_info =  $request->template;
        $temas =  $request->temas;

        $template_data = [
            'nombre' => $template_info['nombre'],
            'materia' => $template_info['materia'],
            'descripcion' => $template_info['descripcion'],
            'facilitador_id' => 1,
            'status' => 1,
        ];
        $examen = Examen::create($template_data);

        foreach ($temas as $tema) {
            $tema_info = [
                'nombre' => $tema['nombre'],
                'tipo_pregunta' => $tema['tipo'],
                'examen_id' => $examen->id,
                'status' => 1,
            ];
            $created_tema = Tema::create($tema_info);

            foreach ($tema['preguntas'] as $pregunta) {
                if(count($pregunta['opciones']) > 0){
                    $opciones = implode('||', $pregunta['opciones']);
                }else{
                    $opciones = null;
                }
                $pregunta_info = [
                    'pregunta' => $pregunta['pregunta'],
                    'select_options' => $opciones,
                    'tema_id' =>$created_tema->id,
                    'status' => 1,
                ];
                Pregunta::create($pregunta_info);
            }
        }
        return response()->json($examen, 200);
    }

    public function llenar_examen($id)
    {
        $examen = Examen::with(['materia_info', 'temas' => function($query){
            $query->with('preguntas')->where('status', 1)->get();
        }])->find($id);

        // dd($examen->temas);
        $examen->temas = $examen->temas->map(function($tema){
            $tema = $tema->preguntas->map(function($pregunta){
                if($pregunta['select_options'] == null){
                    return $pregunta;
                }else{
                    $pregunta['select_options'] = explode('||', $pregunta['select_options']);
                    return $pregunta;
                }
            });
            return $tema;
        });

        return view('examenes.llenar_examen', compact('examen'));
    }

    public function store_respuestas(Request $request)
    {
        $temas =  $request->temas;

        $examen_data = [
            'template_id' => $request->examen_id,
            'user_id' => 1,
            'status' => 1
        ];
        $examen_completado = ExamenCompletado::create($examen_data);

        foreach ($temas as $tema) {
            foreach ($tema['preguntas'] as $pregunta) {
                
                $respuesta_info = [
                    'examen_completado_id' => $examen_completado->id,
                    'question_id' => $pregunta['id'],
                    'respuesta' => $pregunta['respuesta'],

                ];
                Respuesta::create($respuesta_info);
            }
        }
        return response()->json($examen_completado->id, 200);
    }

    public function examen_completado($id)
    {
        $examen_completado = ExamenCompletado::with(['examen' => function($examen) use ($id){
            $examen->with(['materia_info', 'temas' => function($tema) use ($id){
                $tema->with(['preguntas' => function($pregunta) use ($id){
                    $pregunta->with(['respuesta' => function($respuesta) use ($id){
                        $respuesta->where('examen_completado_id', $id)->get();
                    }])->get();
                }])->get();
            }])->get();
        }])->find($id);

        // $examen_completado->created_at = 'asdasasdd';
        // $examen_completado['created_at'] = date("m-d-Y", strtotime($examen_completado['created_at']));

        return view('examenes.completado', compact('examen_completado'));
    }
}