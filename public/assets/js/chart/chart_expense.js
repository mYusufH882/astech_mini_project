$(document).ready(function () {
    const ctx2 = $('#chartExpense');
    const labels = [];
    const datas = [];

    function getRandomColor() {
        const r = Math.floor(Math.random() * 256);
        const g = Math.floor(Math.random() * 256);
        const b = Math.floor(Math.random() * 256);

        return `rgb(${r}, ${g}, ${b})`;
    }

    let colorCharts = JSON.parse(localStorage.getItem('chartColors')) || [];

    function updateChart() {
        const data = {
            labels: labels,
            datasets: [{
                label: 'Total',
                data: datas,
                backgroundColor: colorCharts,
                hoverOffset: 4
            }]
        };

        new Chart(ctx2, {
            type: 'doughnut',
            data: data,
        });
    }

    function fetchData() {
        $.ajax({
            url: '/dashboard',
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                labels.length = 0;
                datas.length = 0;

                data.chartEx.forEach(item => {
                    var category = item.category_item;

                    labels.push(category.category_name);
                    datas.push(item.amount);
                    colorCharts.push(getRandomColor());
                });

                localStorage.setItem('colorCharts', JSON.stringify(colorCharts));
                updateChart();
            }
        });
    }

    fetchData();
});