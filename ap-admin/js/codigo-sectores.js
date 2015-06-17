
window.addEventListener("load", function () {
    var pagina = 0;
    agregarEventoVerInsertar();
    function cargarPagina(pagina) {
        pagina = pagina;
        $.ajax({
            url: "ajaxSectorselect.php?pagina=" + pagina,
            success: function (result) {
                destruirTabla();
                construirTabla(result);
                var enlaces = document.getElementsByClassName("enlace");
                for (var i = 0; i < enlaces.length; i++)
                    agregarEvento(enlaces[i]);
            },
            error: function () {
                
            }
        });
        agregarEventoVerInsertar();

    }
function confirmar(evento, mensaje) {
        evento.preventDefault(); //prevenimos la accion por defecto
        //capturamos el dialogo modal que esta definido en un Div
        $("#contenidomodal").html("¿Borrar " + mensaje + "?"); //asignamos un mensaje
        //ahora mediante Jquery capturamos  los botone sy le damos funcion
        $("#btsi").unbind("click"); //eliminamos el escuchador click
        $("#btsi").on("click", function () {
            $("#dialogomodal").modal('hide');
            //realizamos una peticion AJAX
            $.ajax({
                url: "ajaxSectordelete.php?id=" + mensaje + "&pagina=" + pagina,
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
    };
    /*=== EVENTOS  ===*/
    function agregarEvento(elemento) {
        var datahref = elemento.getAttribute("data-href");
        elemento.onclick = function (e) {
            cargarPagina(datahref)
        };
    }
    ;

    function agregarEventoVerInsertar() {
        var elemento = document.getElementById("addbtnsectores");
        elemento.addEventListener("click", function () {
            $("#btisiSector").unbind("click");
            $("#btisiSector").on("click", function () {
                //Capturamos todos los elementos del DOM
                var id= $('#idsec').val();
                var olivos = $('#olivos').val();
                var contador = $('#contador').val();             
               var nombre = $("#nsec").val();
                var riego = $('#riego').val();
                var cadena = "id="+id+"&olivos="+olivos+"&contador="+contador+"&nombre="+nombre+"&riego="+riego;
               
                // LLamada AJAX para la insercion
                $.ajax({
                    url: "ajaxSectorInsert.php?" + cadena,
                    success: function (result) {
                        if (result.estado) {
                            tostada("Se ha añadido correctametne");
                        } else {
                            tostada("No se ha podido insertar", 2);
                        }
                    },
                    error: function () {
                        tostada("Ajax ha tenido un error interno", 3);
                    }
                });

                $("#dialogomodalinsertarS").modal('hide');
            });
            $("#btinoSector").unbind("click");
            $("#btinoSector").on("click", function (e) {
                //usando la tostada para dar un aviso
                tostada("Cacelando!", 2);
                $("#dialogomodalinsertarS").modal('hide');
            });
            $('#dialogomodalinsertarS').modal('show');
        }, false);
    }
 
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

//    function definirEditar(clase) {
//        var elementos, i;
//        elementos = document.getElementsByClassName(clase);
//        for (i = 0; i < elementos.length; i = i + 1) {
//            mensaje = elementos[i].getAttribute("data-editar");
//            elementos[i].onclick = verEditar;
//        }
//    }
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
        for (var i = 0; i < datos.usuarios.length; i++) {
            if (i === 0) {
                var thead = document.createElement("thead");
                tr = document.createElement("tr");
                for (var j in datos.usuarios[i]) {
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
            for (var j in datos.usuarios[i]) {
                td = document.createElement("td");
                td.textContent = datos.usuarios[i][j];
                tr.appendChild(td);
            }
//            td = document.createElement("td");
//            td.innerHTML = "<a  class='enlace_editar' data-editar='" + datos.usuarios[i].id + "'>EDITAR</a>";
//            tr.appendChild(td);

            td = document.createElement("td");
            td.innerHTML = "<a  class='enlace_borrar cursord-dedo' data-borrar='" + datos.usuarios[i].id + "'>BORRAR</a>";
            tr.appendChild(td);

            tabla.appendChild(tr);
        }
        /*paginacion*/
        tr = document.createElement("tr");
        td = document.createElement("th");
        td.setAttribute("colspan", 10);
        td.innerHTML += "<a class='enlace cursord-dedo' data-href='" + datos.paginas.inicio + "'>&lt;&lt;</a> ";
        td.innerHTML += "<a class='enlace cursord-dedo' data-href='" + datos.paginas.anterior + "'>&lt;</a> ";
        if (datos.paginas.primero !== -1)
            td.innerHTML += "<a  class='enlace cursord-dedo' data-href='" + datos.paginas.primero + "'>" + (parseInt(datos.paginas.primero) + 1) + "</a> ";
        if (datos.paginas.segundo !== -1)
            td.innerHTML += "<a  class='enlace cursord-dedo' data-href='" + datos.paginas.segundo + "'>" + (parseInt(datos.paginas.segundo) + 1) + "</a> ";
        if (datos.paginas.actual !== -1)
            td.innerHTML += "<a  class='enlace cursord-dedo' data-href='" + datos.paginas.actual + "'>" + (parseInt(datos.paginas.actual) + 1) + "</a> ";
        if (datos.paginas.cuarto !== -1)
            td.innerHTML += "<a  class='enlacecursord-dedo' data-href='" + datos.paginas.cuarto + "'>" + (parseInt(datos.paginas.cuarto) + 1) + "</a> ";
        if (datos.paginas.quinto !== -1)
            td.innerHTML += "<a  class='enlace' data-href='" + datos.paginas.quinto + "'>" + (parseInt(datos.paginas.quinto) + 1) + "</a> ";
        td.innerHTML += "<a  class='enlace cursord-dedo' data-href='" + datos.paginas.siguiente + "'>&gt;</a> ";
        td.innerHTML += "<a  class='enlacecursord-dedo' data-href='" + datos.paginas.ultimo + "'>&gt;&gt;</a> ";
        tr.appendChild(td);
        tabla.appendChild(tr);


        var div = document.getElementById("divajax");
        div.appendChild(tabla);
        definirBorrar("enlace_borrar");
       // definirEditar("enlace_editar");
    }

    $("#lstbtnsectores").on("click", function () {
        cargarPagina(0);
    });
});

