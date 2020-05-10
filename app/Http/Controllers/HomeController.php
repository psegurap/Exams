<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }

    public function home()
    {
        return view('home');
    }

    public function panel_usuarios()
    {
        $users = User::all();
        return view('panel', compact('users'));
    }

    public function update_rol($campo, $id, $status)
    {
        User::find($id)->update([$campo => $status ]);
        // return [$role, $id, $status];
    }
}
