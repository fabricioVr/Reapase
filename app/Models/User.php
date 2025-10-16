<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'nombreUsuario',
        'clave',
        'role_id',
        'nombre',
        'paterno',
        'materno',
        'ci',
    ];

    protected $hidden = [
        'clave',
    ];

    // Para que Laravel use 'clave' como campo de contraseña en autenticación
    public function getAuthPassword()
    {
        return $this->clave;
    }

    // Relación con Role usando role_id
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
