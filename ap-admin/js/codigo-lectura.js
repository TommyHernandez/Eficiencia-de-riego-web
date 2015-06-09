/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

window.addEventListener("load", function () {
    var pagina = 0;

    function cargarPagina(pagina) {
        pagina = pagina;
        $.ajax({
            url: "ajaxLecturaselect.php?pagina=" + pagina,
            success: function (result) {
                destruirTabla();
                construirTabla(result);
                var enlaces = document.getElementsByClassName("enlace");
                for (var i = 0; i < enlaces.length; i++)
                    agregarEvento(enlaces[i]);
            },
            error: function () {
                tostada("Error al cargar la tabla",3);
            }
        });
    }
      /*=== EVENTOS  ===*/
    function agregarEvento(elemento) {
        var datahref = elemento.getAttribute("data-href");
        $(elemento).on("click", function(e){
            cargarPagina(datahref)
        });
    };

    /* ====  DIALOGOS de CONFIRMACION  ====  */
    function confirmar(evento, mensaje) {
        evento.preventDefault(); //prevenimos la accion por defecto
        //capturamos el dialogo modal que esta definido en un Div
        $("#contenidomodal").html("¿Borrar?"); //asignamos un mensaje
        //ahora mediante Jquery capturamos  los botone sy le damos funcion
        $("#btsi").unbind("click"); //eliminamos el escuchador click
        $("#btsi").on("click", function () {
            $("#dialogomodal").modal('hide');
            //realizamos una peticion AJAX
            $.ajax({
                url: "ajaxLecturadelete.php?id=" + mensaje + "&pagina=" + pagina,
                success: function (result) {
                    if (result.estado) {
                        tostada("Se ha borrado a " + mensaje + " correctametne");
                        cargarPagina(pagina);
                    } else {
                        tostada("No se ha podido Borrar", 2);
                    }
                },
                error: function () {
                    tostada("Ha fallado el borrado", 3);
                }
            });
        });
        $("#btno").unbind("click");
        $("#btno").on("click", function (e) {
            //usando la tostada como un warning
            tostada("Cacelando!", 2);
            $("#dialogomodal").modal('hide');
        });
        $('#dialogomodal').modal('show');
    }
    ;

    function destruirTabla() {
        var div = document.getElementById("divajax");
        while (div.hasChildNodes()) {
            div.removeChild(div.firstChild);
        }
    }

    function definirBorrar(clase) {
        var elementos, i;
        elementos = document.getElementsByClassName(clase);
        for (i = 0; i < elementos.length; i = i + 1) {
            id = elementos[i].getAttribute("data-borrar");
            elementos[i].onclick = function () {
                confirmar(event, id);
            };
        }
    }

    /*=== DIALOGOS  ===*/
    function tostada(mensaje, tipo) {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        if (mensaje !== '') {
            if (tipo == '2') {
                toastr.warning(mensaje);

            } else if (tipo == '3') {
                toastr.error(mensaje);
            } else {
                toastr.success(mensaje);
            }
        }
    }
    /*===   ===*/
    function construirTabla(datos) {
        var tabla = document.createElement("table");
        tabla.setAttribute("class", "table table-striped");
        var tr, td;
        for (var i = 0; i < datos.lecturas.length; i++) {
            if (i === 0) {
                var thead = document.createElement("thead");
                tr = document.createElement("tr");
                for (var j in datos.lecturas[i]) {
                    td = document.createElement("th");
                    td.textContent = j;
                    tr.appendChild(td);
                }
                tr.appendChild(document.createElement("th"));
                tr.appendChild(document.createElement("th"));
                thead.appendChild(tr);
                tabla.appendChild(thead);
            }

            tr = document.createElement("tr");
            for (var j in datos.lecturas[i]) {
                td = document.createElement("td");
                td.textContent = datos.lecturas[i][j];
                tr.appendChild(td);
            }

            td = document.createElement("td");
            td.innerHTML = "<a  class='enlace_borrar' data-borrar='" + datos.lecturas[i].id + "'>BORRAR</a>";
            tr.appendChild(td);
            tabla.appendChild(tr);
        }
        /*paginacion*/
        tr = document.createElement("tr");
        td = document.createElement("th");
        td.setAttribute("colspan", 10);
        td.innerHTML += "<a class='enlace' data-href='" + datos.paginas.inicio + "'>&lt;&lt;</a> ";
        td.innerHTML += "<a class='enlace' data-href='" + datos.paginas.anterior + "'>&lt;</a> ";
        if (datos.paginas.primero !== -1)
            td.innerHTML += "<a  class='enlace' data-href='" + datos.paginas.primero + "'>" + (parseInt(datos.paginas.primero) + 1) + "</a> ";
        if (datos.paginas.segundo !== -1)
            td.innerHTML += "<a  class='enlace' data-href='" + datos.paginas.segundo + "'>" + (parseInt(datos.paginas.segundo) + 1) + "</a> ";
        if (datos.paginas.actual !== -1)
            td.innerHTML += "<a  class='enlace' data-href='" + datos.paginas.actual + "'>" + (parseInt(datos.paginas.actual) + 1) + "</a> ";
        if (datos.paginas.cuarto !== -1)
            td.innerHTML += "<a  class='enlace' data-href='" + datos.paginas.cuarto + "'>" + (parseInt(datos.paginas.cuarto) + 1) + "</a> ";
        if (datos.paginas.quinto !== -1)
            td.innerHTML += "<a  class='enlace' data-href='" + datos.paginas.quinto + "'>" + (parseInt(datos.paginas.quinto) + 1) + "</a> ";
        td.innerHTML += "<a  class='enlace' data-href='" + datos.paginas.siguiente + "'>&gt;</a> ";
        td.innerHTML += "<a  class='enlace' data-href='" + datos.paginas.ultimo + "'>&gt;&gt;</a> ";
        tr.appendChild(td);
        tabla.appendChild(tr);
        var div = document.getElementById("divajax");
        div.appendChild(tabla);
        definirBorrar("enlace_borrar");
      
    }

    $("#btnlecturas").on("click", function () {
        cargarPagina(0);
    });
});
