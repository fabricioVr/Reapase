<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;

    protected $fillable = [
        'carrera',
        'idUser',
    ];

    // Relación: un docente pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}
