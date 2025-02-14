google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
function drawChart() {
var Assests = google.visualization.arrayToDataTable([
    ['Type', 'Amount'],
    ['Cash', 4392],
    ['Bank', 7382.48],
    ['Stock', 12000],
    ['Creditors', 5433]
]);

var AssestsOptions = {
    // title: 'Assests',
    backgroundColor: { fill:'transparent' },
    pieHole: 0.4,
};

var profit = google.visualization.arrayToDataTable([
    ['Month', 'Expense', 'Income', 'Gross Profit'],
    ['January', 30000, 40000, 10000],
    ['February', 35000, 45000, 10000],
    ['March', 40000, 50000, 10000],
    ['April', 45000, 55000, 10000],
    ['May', 50000, 60000, 10000],
    ['June', 55000, 65000, 10000],
    ['July', 60000, 70000, 10000],
    ['August', 40324, 71359, 31035],
    ['September', 50000, 85000, 35000],
    ['October', 45000, 70000, 25000],
    ['November', 60000, 95000, 35000],
    ['December', 55000, 80000, 25000]
])

var profitOp = {
    // title: 'Monthly Income, Expences, and Profit',
    backgroundColor: { fill:'transparent' },
    width: '70%',
}

var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
var curve_chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
chart.draw(Assests, AssestsOptions);
curve_chart.draw(profit, profitOp);
}