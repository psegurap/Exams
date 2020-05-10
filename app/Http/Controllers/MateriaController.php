<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materia;

class MateriaController extends Controller
{
    public function all()
    {
        $materias = Materia::all();
        return view('materias', compact('materias'));
    }

    public function store(Request $request)
    {

        $materia_info = [
            'materia' => $request->materia['nombre'], 
            'facilitador_id' => $request->materia['facilitador'],
            'status' => 1 
        ];

        Materia::create($materia_info);
        $materias = Materia::all();
        return response()->json($materias, 200);
    }

    public function update(Request $request, $id)
    {
        Materia::find($id)->update(['materia' => $request->materia['nombre'], 'facilitador_id' => $request->materia['facilitador']]);
        $materias = Materia::all();
        return response()->json($materias, 200);
    }

    public function delete($id)
    {
        Materia::destroy($id);
        $materias = Materia::all();
        return response()->json($materias, 200);
    }
}
