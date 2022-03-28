function cambiar(){
    var elemento = document.getElementById('accion');

    var formularioRegistro = document.getElementById("registrarse");
    var formularioInicio = document.getElementById("iniciar_sesion");

    if(elemento.innerHTML == "Registrarse"){
        elemento.innerHTML = "Iniciar Sesion";

        formularioRegistro.style.display = "block";
        formularioInicio.style.display = "none";
    }else{
        elemento.innerHTML = "Registrarse";

        formularioRegistro.style.display = "none";
        formularioInicio.style.display = "block";
    }
}

function agregarProducto(){
    var lista = document.getElementById('productosLista');
    var elemento = document.getElementById('productos');
    var precio_total = document.getElementById('precio_total');

    var valores = lista.options[lista.selectedIndex].value.split(" ");

    var maximo = elemento.value.split(",");
    
    if(maximo.length <= 10){
        precio_total.value = parseInt(precio_total.value) + parseInt(valores[2]);

        elemento.value += lista.options[lista.selectedIndex].value + ",";
    }else{
        alert("El maximo son 10 articulos");
    }
}