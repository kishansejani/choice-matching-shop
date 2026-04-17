$(function () {
    // Helper function to check if element exists
    function initChart(selector, callback) {
        var el = $(selector);
        if (el.length) {
            var ctx = el.get(0).getContext('2d');
            callback(ctx);
        }
    }

    // AREA CHART
    initChart('#areaChart', function(ctx) {
        var areaChartData = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            datasets: [
                {
                    label: 'Digital Goods',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    data: [28, 48, 40, 19, 86, 27, 90]
                },
                {
                    label: 'Electronics',
                    backgroundColor: 'rgba(210, 214, 222, 1)',
                    borderColor: 'rgba(210, 214, 222, 1)',
                    data: [65, 59, 80, 81, 56, 55, 40]
                }
            ]
        };
        new Chart(ctx, { type: 'line', data: areaChartData });
    });

    // Handle other charts similarly or leave them if not used
    // This cleans up scripts.php significantly
});
