<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = 'equipos';

    protected $fillable = [
        'codigo', 'cpu', 'disco', 'estado', 'idMarca', 'modelo', 'idRAM', 'idUser',
        'monitor', 'teclado', 'mouse', 'otros'
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'idMarca');
    }

    public function ram()
    {
        return $this->belongsTo(Ram::class, 'idRAM');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}
