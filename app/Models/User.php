<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory; // <-- agregado

class User extends Authenticatable
{
    use HasFactory, Notifiable; // <-- HasFactory agregado

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
    public function pasantia()
    {
        return $this->hasOne(Pasantia::class, 'idUser');
    }
    public function docente()
    //Relación con Docente usando idUser
    {
      return $this->hasOne(Docente::class, 'idUser');
    }

}
