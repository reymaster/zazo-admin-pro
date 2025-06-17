"use strict";

// Função de inicialização quando o DOM estiver pronto
const CAP_Admin = function() {

    // Gráfico de categorias
    const initCategoriesChart = function() {
        const element = document.getElementById('cap_categories_chart');
        if (!element || typeof ApexCharts === 'undefined' || typeof capChartData === 'undefined') {
            return;
        }

        const options = {
            series: capChartData.categories.series,
            chart: {
                type: 'bar',
                height: 350,
                toolbar: { show: false }
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    horizontal: true,
                    distributed: true,
                    barHeight: 23
                }
            },
            dataLabels: { enabled: false },
            xaxis: {
                categories: capChartData.categories.categories,
            },
            colors: function({ value, seriesIndex }) {
                const colors = capChartData.categories.colors;
                return colors[seriesIndex] || '#008FFB'; // Retorna a cor padrão se não houver correspondência
            }
        };

        const chart = new ApexCharts(element, options);
        chart.render();
    }

    // Mapa mundial
    const initWorldMap = function() {
        const element = document.getElementById('cap_world_map');
        if (!element || typeof $ === 'undefined' ||!$.fn.vectorMap || typeof capChartData === 'undefined') {
            return;
        }

        const mapData = capChartData.worldSales;

        $(element).vectorMap({
            map: 'world_mill_en',
            backgroundColor: 'transparent',
            regionStyle: {
                initial: {
                    fill: '#E4E6EF'
                }
            },
            series: {
                regions: [{
                    values: mapData,
                    scale: ['#E4E6EF', '#008FFB'],
                    normalizeFunction: 'polynomial'
                }]
            },
            onRegionTipShow: function(e, el, code) {
                if (typeof mapData[code]!== 'undefined') {
                    el.html(el.html() + ': ' + mapData[code] + ' sales');
                }
            }
        });
    }

    // Ponto de entrada público
    return {
        init: function() {
            initCategoriesChart();
            initWorldMap();
        }
    };
}();

// Inicializa na carga do DOM
document.addEventListener("DOMContentLoaded", function() {
    CAP_Admin.init();
});
