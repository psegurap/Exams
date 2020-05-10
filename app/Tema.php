<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tema extends Model
{
    use SoftDeletes;
    
    protected $table = 'temas';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function preguntas(){
        return $this->hasMany('App\Pregunta', 'tema_id', 'id');
    }
}
