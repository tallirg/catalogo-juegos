<!DOCTYPE html>
<html lang = "es">
<head>
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@100..900&display=swap" rel="stylesheet">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=0">
   <title>Menu</title>
   <link rel="stylesheet" href="{{ asset('css/syles2.css') }}">
</head>
<body>
   <header>
     <h2>PocketGames</h2>
     <form action="/menu" method="get" class="buscar">
     <input type="search" name="q" placeholder="Buscar..." class="busqueda">
     <button type="submit" class="boton-buscar">Buscar</button>
     </form>
     <a class="botonxd" href="{{ url('/agregarJ') }}">+</a>
     <p class="menu-registro">Login/Registro</p>
     <div class="carrito">
          <a href="{{ url('/carrito') }}" id="carrito-link">
             <i class="fas fa-shopping-cart"></i>
             <span id="contador-carrito">
                {{ $contadorCarrito }}
            </span>
          </a>
     </div>
   </header>
   
@if(session('success'))

<div class="mensaje-exito" id="mensajeExito">

    <span>
        {{ session('success') }}
    </span>

    <button class="cerrar-mensaje"
            onclick="cerrarMensaje()">

        <i class="fas fa-times"></i>

    </button>

</div>

@endif

   <nav class="navegacion">
       <div class="logo">Te podria interesar</div>
       <ul class="nav-links">
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Juegos</a></li>
            <li><a href="#">Ofertas</a></li>
            <li><a href="#">Categorias</a></li>
            <li><a href="#">Top Ventas</a></li>
       </ul>
   </nav>

   <div class="barra">
        <aside class="sidebar">
        <section class="filtros">
           <h3>Filtros</h3>
           <form action="/menu" method="GET" class="form-filtros">

    <label>
        <input type="checkbox"
               name="genres[]"
               value="action"

               {{ in_array('action', request('genres', [])) ? 'checked' : '' }}>
        Accion
    </label>

    <label>
        <input type="checkbox"
               name="genres[]"
               value="role-playing-games-rpg"

               {{ in_array('role-playing-games-rpg', request('genres', [])) ? 'checked' : '' }}>
        RPG
    </label>

    <label>
        <input type="checkbox"
               name="genres[]"
               value="horror"

               {{ in_array('horror', request('genres', [])) ? 'checked' : '' }}>
        Terror
    </label>

    <button type="submit">
        Filtrar
    </button>

    <a href="/menu" class="btn-limpiar">
        Limpiar filtros
    </a>

</form>
        </section>

        <section class="contenido-extra">
            <h3>Top Juegos</h3>
            <ul>
                   <li><a href="#">Lista de juegos populares</a></li>
            </ul>
        </section>
       </aside>

    <main id="contenedor-juegos">

@foreach($juegos as $juego)

<article class="pokemon">

    <header>
        <h4>{{ $juego['name'] }}</h4>

        <p>
            Rating:
            <span>{{ $juego['rating'] }}</span>

            |

            Fecha:
            <time>
                {{ $juego['released'] }}
            </time>
        </p>
    </header>

    <section class="contenido">

        <img src="{{ $juego['background_image'] ?? asset('img/default.jpg') }}"
             alt="{{ $juego['name'] }}">

        <p>{{ $juego['name'] }}</p>

    </section>

    <footer>

        <p>
            Plataforma:
            {{ $juego['platforms'][0]['platform']['name'] ?? 'N/A' }}
        </p>

        <ul class="tags">

            @foreach($juego['genres'] ?? [] as $genero)

                <li>{{ $genero['name'] }}</li>

            @endforeach

        </ul>

    </footer>

</article>

<form action="{{ url('/agregar-carrito') }}" method="POST">
    @csrf

    <input type="hidden" name="nombre" value="{{ $juego['name'] }}">

    <input type="hidden" name="imagen"
           value="{{ $juego['background_image'] ?? '' }}">

    <input type="hidden" name="categoria"
           value="{{ $juego['genres'][0]['name'] ?? 'Sin categoria' }}">

    <input type="hidden" name="empresa"
           value="{{ $juego['publishers'][0]['name'] ?? 'Desconocido' }}">

    <input type="hidden" name="fecha"
           value="{{ $juego['released'] ?? 'N/A' }}">

    <input type="hidden" name="etiquetas"
           value="{{ json_encode($juego['genres']) }}">

    <button type="submit">
        Agregar al carrito
    </button>
</form>

@endforeach

</main>

    </div> 
  
<footer>
    <p>@ 2026 Mi Aplicacion | Todos los derechos reservados</p>

 <script src="{{ asset('js/backend.js') }}"></script>

</body>
