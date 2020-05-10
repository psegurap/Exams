<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExamenCompletado extends Model
{
    use SoftDeletes;

    protected $table = 'examenes_completados';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function examen()
    {
        return $this->belongsTo('App\Examen', 'template_id', 'id');
    }
}
