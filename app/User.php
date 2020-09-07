<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'status', 'estudiante', 'facilitador', 'administrador'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function estudiante_materia()
    {
        return $this->belongsToMany('App\Materia', 'estudiante_materia', 'estudiante_id', 'materia_id')->withTimestamps();
    }

    public function examen_completado()
    {
        return $this->hasOne('App\ExamenCompletado', 'user_id', 'id');
    }

    public function facilitador_materia()
    {
        return $this->hasMany('App\Materia', 'facilitador_id', 'id');
    }
}
