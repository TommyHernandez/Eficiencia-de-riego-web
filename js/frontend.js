/*
 * JavaScript para el FrontPage
 * 
 */
$('document').ready(function () {
 
  //barras();
   // tarta();
   // barrasLaterales();
});
function barras() {
    

}

function tarta() {
    
}
function barrasLaterales() {
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