<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = false;

    // Relación con usuarios usando 'role_id'
    public function users()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
