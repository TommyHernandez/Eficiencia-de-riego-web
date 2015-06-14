/*
 * JavaScript para el FrontPage
 * 
 */
$('document').ready(function () {
    $("#filtro-olivos").on("click", function (evento) {
        evento.preventDefault(); //prevenimos la accion por defecto

        if ($("#filtroolivo").val() == "zona") {

            barras("tabla=sectores");
        } else {
            barras();
        }
    });
    $("#showModalSobre").on("click", function(){
        $("#modalSobre").modal("show");
        
    });
    barras();
    barrasLaterales();
    epochbarras();
});

function barras(param) {
    if (!param) {
        param = "tabla=sectores&sectores=true"
    }
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    datos = [
        ['Sector', 'Olivos', {role: 'style'}]];
    $.ajax({
        url: "ajaxselect.php?" + param,
        success: function (result) {

            for (var prop in result) {
                var a = "'" + prop + "'";
                var b = parseFloat(result[prop]);

                datos.push([a, b, '#aabbcc']);
            }

            drawChart(datos);
        },
        error: function () {
            tostada("Ha fallado ", 3);
        }
    });
}
/* == Funcion para dibujar gráficas == */
function drawChart(datos) {
    var data = google.visualization.arrayToDataTable(datos);
    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
        {calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation"},
        2]);
    var options = {
        title: "Olivos Por Sector",
        bar: {groupWidth: "95%"},
        legend: {position: "none"},
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("olv-sec"));
    chart.draw(view, options);
}
function dibujarBarrasLaterales(datos) {
    var data = google.visualization.arrayToDataTable(datos);
    var view = new google.visualization.DataView(data);
    view.setColumns([0, 1,
        {calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation"},
        2]);

    var options = {
        title: "Eficiencia",
        bar: {groupWidth: "95%"},
        legend: {position: "none"},
    };
    var chart = new google.visualization.BarChart(document.getElementById("tarta"));
    chart.draw(view, options);
}
/* == Fin dibujo de graficas ==*/

function barrasLaterales(param) {
    if (!param) {
        param = "tabla=lecturas"
    }
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    var datos = [["sector", "Eficiancia", {role: "style"}]];
    $.ajax({
        url: "ajaxselect.php?" + param,
        success: function (result) {
            
            for (var prop in result) {
                var a = "'" + prop + "'";
                var b = parseFloat(result[prop]);

                datos.push([a, b, 'gold']);
            }

            dibujarBarrasLaterales(datos);
        },
        error: function () {
            tostada("Ha fallado ", 3);
        }
    });


}
function epochbarras() {
    var param ="tabla=lecturas&litros=true";
    var datos = [];
    $.ajax({
        url: "ajaxselect.php?" + param,
        success: function (result) {
            
            for (var prop in result) {
                var a = "'" + prop + "'";
                var b = parseFloat(result[prop]);

                datos.push( { x: a, y: b });
            }
            $('#litros').epoch({
                type: 'bar',
                data: datos
            });
        },
        error: function () {
            tostada("Ha fallado ", 3);
        }
    });
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