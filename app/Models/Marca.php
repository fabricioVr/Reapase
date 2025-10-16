<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = 'marcas'; // nombre de la tabla

    protected $fillable = [
        'descripcion',
    ];

    // Si quieres definir relación con equipos
    public function equipos()
    {
        return $this->hasMany(Equipo::class, 'idMarca');
    }
}
