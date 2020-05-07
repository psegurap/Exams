<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlantillaController extends Controller
{
    public function all(){
        return view('plantillas.all_templates');
    }

    public function create(){
        return view('plantillas.create');
    }
}
