<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examen extends Model
{
    use SoftDeletes;
    
    protected $table = 'examenes';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function temas(){
        return $this->hasMany('App\Tema', 'examen_id', 'id');
    }

    public function materia_info(){
        return $this->belongsTo('App\Materia', 'materia', 'id');
    }
}
