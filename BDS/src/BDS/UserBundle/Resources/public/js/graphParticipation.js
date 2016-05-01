/**
 * 
 */
var ctx = $("[class=myDoughnutChart]");
var myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: [oui, non, peutEtre],
    labels: [
             "Red",
             "Green",
             "Yellow"
         ],
         datasets: [
             {
                 data: [300, 50, 100],
                 backgroundColor: [
                     "#FF6384",
                     "#36A2EB",
                     "#FFCE56"
                 ],
                 hoverBackgroundColor: [
                     "#FF6384",
                     "#36A2EB",
                     "#FFCE56"
                 ]
             }]
});