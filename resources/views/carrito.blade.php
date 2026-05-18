<!DOCTYPE html>
<html lang = "es">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Exo+2:ital,wght@0,100.900;1,100..900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <meta charset="UTF-8">
        <title>CARRITO</title>
        <link rel="stylesheet" href="{{ asset('css/syles4.css') }}">
    </head>
    
    <body>
        <header>
            <h2>Bienvenido a su carrito</h2>
            
            <a href="{{ url('/menu') }}" class="btn-regresar">
                <i class="fas fa-arrow-left"></i>
                Volver al menú
            </a>
        </header>

        <nav class="runrun">
            <div class="runrun">Administrar su carrito</div>
        </nav>

        <main>
            <h3>Juegos a comprar</h3>
            <div id="lista-carrito">

@foreach($items as $item)

<div class="item-carrito">

    <img src="{{ $item->juego->imagen }}"
         width="150">

    <h3>{{ $item->juego->nombre }}</h3>

    <p>Categoria:
        {{ $item->juego->categoria }}
    </p>

    <p>Empresa:
        {{ $item->juego->empresa }}
    </p>

    <p>Cantidad:
        {{ $item->cantidad }}
    </p>

<a href="{{ url('/eliminar-carrito/'.$item->id) }}"
   class="btn-eliminar">

   <i class="fas fa-trash"></i>
   Eliminar
</a>

</div>

@endforeach

</div>
                
            <a href="{{ url('/pagar') }}" class="btn-pagar">
    <i class="fas fa-credit-card"></i>
    Pagar con Stripe
</a> 
        </main>

        <footer>
            <p>@ 2026 Mi Aplicacion | Adi</p>
        </footer>

        <script src="{{ asset('js/backend.js') }}"></script> 
    </body>
</html>