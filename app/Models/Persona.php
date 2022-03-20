<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'descripcion'
    ];

   
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha'=>'date',
        'hora'=>'time',
        'created_at'=>'datetime',
        'updated_at'=>'datetime'
    ];

    public function cita()
    {
        return $this->hasMany('App\Models\Cita');
    }
}
