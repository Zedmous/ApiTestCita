<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;
    protected $fillable = [
        'titulo',
        'motivo',
        'fecha',
        'hora',
        'persona_id'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha'=>'datetime:Y-m-d',
        'hora' => 'datetime:H:i:s',
        'created_at'=>'datetime',
        'updated_at'=>'datetime'
    ];

    public function persona()
    {
        return $this->belongsTo('App\Models\Persona');
    }
}
