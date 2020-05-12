<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Examen;
use App\Materia;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $exams = Examen::with(['materia_info' => function($materia){
            $materia->with('facilitador')->get();
        }])->where('status', 1)->get();
        return view('index', compact('exams'));
    }

    public function home()
    {
        return view('home');
    }

    public function panel_usuarios()
    {
        $users = User::all();
        $materias = Materia::where('status', 1)->get();
        return view('panel', compact('users', 'materias'));
    }

    public function update_estudiante($id, $materia)
    {
        return [$id, $materia];
        $users = User::all();
        return response()->json($users, 200);
    }

    public function update_rol($campo, $id, $status)
    {
        User::find($id)->update([$campo => $status ]);
        $users = User::all();
        return response()->json($users, 200);
    }
}
