<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Juego;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        $user = Auth::user();

        $juego = Juego::firstOrCreate(
            [
                'nombre' => $request->nombre
            ],
            [
                'imagen' => $request->imagen,
                'categoria' => $request->categoria,
                'empresa' => $request->empresa,
                'fecha' => $request->fecha,
                'etiquetas' => $request->etiquetas,
                'user_id' => $user->id
            ]
        );

        $item = Carrito::where('user_id', $user->id)
                        ->where('juego_id', $juego->id)
                        ->first();

        if($item){
            $item->increment('cantidad');
        } else {
            Carrito::create([
                'user_id' => $user->id,
                'juego_id' => $juego->id,
                'cantidad' => 1
            ]);
        }

        return redirect('/carrito');
    }

    public function index()
    {
        $items = Carrito::with('juego')
            ->where('user_id', Auth::id())
            ->get();

        return view('carrito', compact('items'));
    }

    public function eliminar($id)
    {
        $item = Carrito::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->first();

        if($item){

            // Si hay más de 1, solo resta cantidad
            if($item->cantidad > 1){

                $item->decrement('cantidad');

            } else {

                // Si solo queda 1, elimina el registro
                $item->delete();
            }
        }

        return redirect('/carrito');
    }

    public function pagar()
{
    Stripe::setApiKey(env('STRIPE_SECRET'));

    $items = Carrito::with('juego')
        ->where('user_id', Auth::id())
        ->get();

    $productos = [];

    foreach($items as $item){

        $productos[] = [
            'price_data' => [
                'currency' => 'mxn',

                'product_data' => [
                    'name' => $item->juego->nombre,
                ],

                'unit_amount' => 29900,
            ],

            'quantity' => $item->cantidad,
        ];
    }

    $checkout_session = Session::create([
        'payment_method_types' => ['card'],

        'line_items' => $productos,

        'mode' => 'payment',

        'success_url' => url('/pago-exitoso'),

        'cancel_url' => url('/carrito'),
    ]);

    return redirect($checkout_session->url);
}
}