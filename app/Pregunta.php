<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pregunta extends Model
{
    use SoftDeletes;
    
    protected $table = 'preguntas';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function respuesta()
    {
        return $this->hasOne('App\Respuesta', 'question_id', 'id');
    }
}
