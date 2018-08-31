<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $primaryKey = "id";
    //public $timestamps = false; //laravel crea dos columnas que contienen informacion de cuando un registro se creó y se actualizó

    protected $fillable = [ //asigna los campos de la tabla de BD
        'nombre',
        'descripcion',

    ];

    protected $guarded = [ //campos que no se quieren incluir

    ];

}
