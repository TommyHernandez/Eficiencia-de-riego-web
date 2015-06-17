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
    var ctx = document.getElementById("litros").getContext("2d");
    var param ="tabla=lecturas&litros=true";
  var data = {
    labels: ["January", "February", "March", "April", "May", "June", "July"],
    datasets: [
        {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.5)",
            strokeColor: "rgba(220,220,220,0.8)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81, 56, 55, 40]
        },
        {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,0.8)",
            highlightFill: "rgba(151,187,205,0.75)",
            highlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 86, 27, 90]
        }
    ]
};
    $.ajax({
        url: "ajaxselect.php?" + param,
        success: function (result) {
            
      
        },
        error: function () {
            tostada("Ha fallado ", 3);
        }
    });
    var options = {
        responsive:true
    };
    var myBarChart = new Chart(ctx).Bar(data,options);
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