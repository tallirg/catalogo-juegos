<!DOCTYPE html>
<html lang="es">
    <head>
         <link rel="preconnect" href="https://fonts.googleapis.com">
         <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
         <link href="https://fonts.googleapis.comm/css2?family=Exo+2:ital,wght@0,100.900;1,100..900&display=swap" rel="stylesheet">

         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
         <meta charset="UTF-8">
         <title>AGREGAR</title>
         <link rel="stylesheet" href="{{ asset('css/syles3.css') }}">
 </head>

 <body>
    <header>
        <h2>AGREGAR JUEGOS</h2>
    </header>

    <nav class="explicacion">
           <div class="explicacion">Bienvenido administrador</div>
           <ul class="opciones">
                 <li onclick="mostrar('agregar')">Agregar</li>
                 <li onclick="mostrar('eliminar')">Eliminar</li>
                 <li onclick="mostrar('editar')">Editar</li>
           </ul>
    </nav>

    <main id="cuestionario">
          <div id="agregar" class="seccion">
               <h3>Agregar Juegos</h3>
               <input type="text" id="nombre" placeholder="Nombre del Juego">
               <input type="text" id="imagen" placeholder="URL de la Imagen">
               <input type="text" id="categoria" placeholder="Categoria">
               <input type="text" id="empresa" placeholder="Empresa">
               <input type="text" id="fecha" placeholder="Fecha">
               <input type="text" id="etiqueta" placeholder="Etiquetas">
               
               <button type="button" id="btnAgregar">Agregar</button>
           </div>
 
           <div id="eliminar" class="seccion">
               <h3>Eliminar Juegos</h3>
               <div id="lista-eliminar">

               </div>
           </div>

           <div id="editar" class="seccion">
               <h3>Editar Juegos</h3>
               <div id="lista-editar">

               </div>

               <h4>Editar Juegos</h4>
               <input type="text" id="edit-nombre" placeholder="Nombre">
               <input type="text" id="edit-imagen" placeholder="Imagen">
               <input type="text" id="edit-categoria" placeholder="Categoria">
               <input type="text" id="edit-empresa" placeholder="Empresa">
               <input type="text" id="edit-fecha" placeholder="Fecha">
               <input type="text" id="edit-etiquetas" placeholder="Etiquetas">

               <button id="btnGuardarCambios">Guardar Cambios</button>
           </div>
        </main>

        <footer>
                <p>@ 2026 Mi Aplicacion | Todos los derechos reservados</p>
        </footer>

        <script src="{{ asset('js/backend.js') }}"></script>
    </body>
</html>
           
