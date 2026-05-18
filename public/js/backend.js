let juegos = JSON.parse(localStorage.getItem("juegos")) || [];
let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
let indiceEditar = null;
let btn = document.getElementById("btnAgregar");

if(btn){
    btn.addEventListener("click", agregar);
}

function guardar(){
    localStorage.setItem("juegos", JSON.stringify(juegos));
}

function agregar(){
    let nombre = document.getElementById("nombre").value;
    let imagen = document.getElementById("imagen").value;
    let categoria = document.getElementById("categoria").value;
    let empresa = document.getElementById("empresa").value;
    let fecha = document.getElementById("fecha").value;
    let cate = document.getElementById("etiqueta").value;

    let etiquetas = cate.split(",");

    let juego = {
        nombre,
        imagen,
        categoria,
        empresa,
        fecha,
        etiquetas
    };

    juegos.push(juego);
    guardar();

    console.log("Guardado:", juegos);

    alert("Juego guardado");
}



function mostrar(seccionId){
    const secciones = document.querySelectorAll('.seccion');
    secciones.forEach(sec => sec.classList.remove('activo'));
    document.getElementById(seccionId).classList.add('activo');

    if(seccionId == "eliminar"){
        cargarListaEliminar();
    } else if(seccionId === "editar"){
        cargarListaEditar();
    }
}

window.onload = function(){
    mostrar('agregar');
};

let contenedor = document.getElementById("contenedor-juegos");

if(contenedor){

    let juegosGuardados = JSON.parse(localStorage.getItem("juegos")) || [];

    juegosGuardados.forEach((juego, index) => {

        let etiquetasHTML = "";
        juego.etiquetas.forEach(et => {
            etiquetasHTML += `<li>${et.trim()}</li>`;
        });

        let nuevoJuego = document.createElement("article");
        nuevoJuego.classList.add("pokemon");

        nuevoJuego.innerHTML = `
            <header>
                <h4>${juego.nombre}</h4>
                <p>Desarrollado por: <span>${juego.empresa}</span> | Fecha: <time>${juego.fecha}</time></p>
            </header>

            <section class="contenido">
                <img src="${juego.imagen}" alt="${juego.nombre}">
                <p>${juego.nombre}</p>
            </section>

            <footer>
                <p>Categoria: ${juego.categoria}</p>
                <ul class="tags">
                    ${etiquetasHTML}
                </ul>

                <button class="btnEliminar">Eliminar</button>
                <button class="btnCarrito">Agregar al carrito</button>
            </footer>
        `;

        nuevoJuego.querySelector(".btnEliminar").addEventListener("click", function(){
            juegosGuardados.splice(index, 1);
            localStorage.setItem("juegos", JSON.stringify(juegosGuardados));
            nuevoJuego.remove();
        });
        nuevoJuego.querySelector(".btnCarrito").addEventListener("click", function(){
            agregarAlCarrito();
        });

        contenedor.appendChild(nuevoJuego);
        actualizarContador();
    });
}


function cargarListaEliminar(){
    let juegos = JSON.parse(localStorage.getItem("juegos")) || [];
    let contenedor = document.getElementById("lista-eliminar");

    contenedor.innerHTML = "";

    juegos.forEach((juego, index) => {
        let div = document.createElement("div");
        div.classList.add("item-eliminar");

        div.innerHTML = `
            <p><strong>${juego.nombre}</strong> - ${juego.empresa}</p>
            <button class="btnEliminar">Eliminar</button>
        `;

        div.querySelector(".btnEliminar").addEventListener("click", function(){
           
            juegos.splice(index, 1);
            localStorage.setItem("juegos", JSON.stringify(juegos));

            cargarListaEliminar();
        });

        contenedor.appendChild(div);
        
    })
}

function cargarListaEditar(){
    let juegos= JSON.parse(localStorage.getItem("juegos")) || [];
    let contenedor = document.getElementById("lista-editar");

    contenedor.innerHTML = "";

    juegos.forEach((juego, index) => {
        let div = document.createElement("div");
        

        div.innerHTML = `
            <p><strong>${juego.nombre}</strong> - ${juego.empresa}</p>
            <button class="btnEditar">Editar</button>
        `;

        div.querySelector(".btnEditar").addEventListener("click", function(){
        
            indiceEditar =  index;

            document.getElementById("edit-nombre").value = juego.nombre;
            document.getElementById("edit-imagen").value = juego.imagen;
            document.getElementById("edit-categoria").value = juego.categoria;
            document.getElementById("edit-empresa").value = juego.empresa;
            document.getElementById("edit-fecha").value = juego.fecha;
            document.getElementById("edit-etiquetas").value = juego.etiquetas;

            
        });

        contenedor.appendChild(div);
    })
}

document.getElementById("btnGuardarCambios").addEventListener("click", function(){
    let juegos = JSON.parse(localStorage.getItem("juegos")) || [];

    if(indiceEditar === null){
        alert("Seleccione un juego primero");
        return;
    }

    juegos[indiceEditar] = {
        nombre : document.getElementById("edit-nombre").value,
        imagen : document.getElementById("edit-imagen").value,
        categoria : document.getElementById("edit-categoria").value,
        empresa : document.getElementById("edit-empresa").value,
        fecha : document.getElementById("edit-fecha").value,
        etiquetas : document.getElementById("edit-etiquetas").value.split(",")
    };

    localStorage.setItem("juegos", JSON.stringify(juegos));

    alert("Juego Actualizado");

    cargarListaEditar();
})

//agregar a carrito
function agregarAlCarrito(juego){
    let existe = carrito.find(j => j.nombre === juego.nombre);
    
    if(!existe){
      carrito.push(juego);
      localStorage.setItem("carrito", JSON.stringify(carrito));
      actualizarContador();
 } else {
    alert("Ya esta en el carrito :)");
 } 
}

function actualizarContador(){
    let contador = document.getElementById("contador-carrito");
    if(contador){
        contador.textContent = carrito.length;
    }
}

function cargarListaCarrito(){
    let juegos = JSON.parse(localStorage.getItem("juegos")) || [];
    let contenedor = document.getElementById("lista-carrito");

    contenedor.innerHTML = "";

    juegos.forEach(juego => {
      let div = document.createElement("div");
      div.innerHTML = `
            <p>${juego.nombre}</p>
            <img src="${juego.imagen}" width="100">
            <button class="btnEliminarCarrito">Eliminar</button>
        `;

        div.querySelector(".btnEliminarCarrito").addEventListener("click", function(){
            carrito.splice(index, 1);
            localStorage.setItem("carrito", JSON.stringify(carrito));
            cargarListaCarrito();
        })

        contenedor.appendChild(div);
    })
}

function cerrarMensaje(){

    const mensaje =
        document.getElementById("mensajeExito");

    if(mensaje){
        mensaje.style.display = "none";
    }
}

document.addEventListener("DOMContentLoaded", function() {
    if(document.getElementById("lista-carrito")) {
        cargarListaCarrito();
    }
})