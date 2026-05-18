<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $fillable = [
    'user_id',
    'juego_id',
    'cantidad'
];
    //
    public function juego()
    {
        return $this->belongsTo(Juego::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    
}
