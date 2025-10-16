<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ram extends Model
{
    protected $table = 'ram'; // nombre de la tabla

    protected $fillable = [
        'capacidad',
        'serie',
    ];

    // Relación con equipos
    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'idRAM');
    }
}
