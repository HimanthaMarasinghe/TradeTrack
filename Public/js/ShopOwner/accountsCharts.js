google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
// var Assests = google.visualization.arrayToDataTable([
//     ['Type', 'Amount'],
//     ['Cash', 4392],
//     ['Bank', 7382.48],
//     ['Stock', 12000],
//     ['Creditors', 5433]
// ]);

// var AssestsOptions = {
//     // title: 'Assests',
//     backgroundColor: { fill:'transparent' },
//     pieHole: 0.4,
// };

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