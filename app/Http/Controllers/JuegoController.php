<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use App\Models\Carrito;
use Illuminate\Support\Facades\Auth;

class JuegoController extends Controller
{
    public function menu()
    {
        $buscar = request('q');

        $genres = request('genres', []);

        $params = [
            'key' => env('RAWG_API_KEY'),
            'search' => $buscar,
            'page_size' => 5
        ];

        if(!empty($genres)){
            $params['genres'] = implode(',', $genres);
        }

        $response = Http::withoutVerifying()->get(
    'https://api.rawg.io/api/games',
    $params
);

        $juegos = $response->json()['results'];

        $contadorCarrito = 0;

        if(Auth::check()){
            $contadorCarrito = Carrito::where('user_id', Auth::id())
                ->sum('cantidad');
        }

        return view(
            'menu',
            compact('juegos', 'contadorCarrito')
        );
    }
}