/*
 * JavaScript para el FrontPage
 * 
 */
$('document').ready(function () {
    $("#filtro-olivos").on("click", function (evento) {
        evento.preventDefault(); //prevenimos la accion por defecto
        alert($("#filtroolivo").val());
        if ($("#filtroolivo").val() == "zona") {

            barras("tabla=sectores");
        } else {
            barras();
        }
    });
    barras();
    // tarta();
    // barrasLaterales();
});

function barras(param) {
    if (!param) {
        param = "tabla=sectores&sectores=true"
    }
    alert(param);
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    datos = [
        ['Sector', 'Olivos', {role: 'style'}]];
    $.ajax({
        url: "ajaxselect.php?" + param,
        success: function (result) {
            alert(result);
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
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: {position: "none"},
    };
    var chart = new google.visualization.ColumnChart(document.getElementById("olv-sec"));
    chart.draw(view, options);
}

function tarta(param) {
    if (!param) {
        param = "tabla=sectores"
    }
    google.load('visualization', '1.0', {'packages': ['corechart']});

    // Set a callback to run when the Google Visualization API is loaded.
    google.setOnLoadCallback(drawChart);

    // Callback that creates and populates a data table,
    // instantiates the pie chart, passes in the data and
    // draws it.
    function drawChart() {
        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
            ['S1', 10],
            ['S2', 15],
            ['S3', 15],
            ['S4', 40],
            ['S5', 20]
        ]);

        // Set chart options
        var options = {'title': 'Eficiencia por sector',
            'width': 600,
            'height': 400};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('tarta'));
        chart.draw(data, options);
    }

}
function barrasLaterales(param) {
    if (!param) {
        param = "tabla=sectores"
    }
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Zona", "olivos", {role: "style"}],
            ["Solana", 60000, "#b87333"],
            ["Llano", 60000, "silver"],
            ["viññas", 12000, "color: #e5e4e2"]
        ]);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"},
            2]);

        var options = {
            title: "Density of Precious Metals, in g/cm^3",
            width: 600,
            height: 400,
            bar: {groupWidth: "95%"},
            legend: {position: "none"},
        };
        var chart = new google.visualization.BarChart(document.getElementById("barras"));
        chart.draw(view, options);
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