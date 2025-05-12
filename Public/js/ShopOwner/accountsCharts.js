google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {


var profit = google.visualization.arrayToDataTable(chartData)

var profitOp = {
    // title: 'Monthly Income, Expences, and Profit',
    backgroundColor: { fill:'transparent' },
    width: '70%',
}

// var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
var curve_chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
// chart.draw(Assests, AssestsOptions);
curve_chart.draw(profit, profitOp);
}