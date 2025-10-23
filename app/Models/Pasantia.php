<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasantia extends Model
{
    use HasFactory;

    protected $table = 'pasantias';

    protected $fillable = [
        'idUser',
        'fechaInicio',
        'fechaFinal',
        'horaIngreso',
    ];

    // Relación con el usuario (pasanet/empleado)
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}
