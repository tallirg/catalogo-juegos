<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Juego extends Model
{
    //

    public function carritos(){
        return $this->hasMany(Carrito::class);
    }

    protected $fillable = [
        'nombre',
        'imagen',
        'categoria',
        'empresa',
        'fecha',
        'etiquetas',
        'user_id'
    ];
}
