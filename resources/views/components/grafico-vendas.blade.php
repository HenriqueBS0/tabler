<div class="card">
    <div class="card-header">
        <h3 class="card-title">Histórico de Vendas</h3>
    </div>
    <div class="card-body">
        <div id="chart-wrapper" style="height: 16rem"></div>
    </div>
</div>
<script>
    require(['c3', 'jquery'], function(c3, $) {
        $(document).ready(function() {
            var chart = c3.generate({
                bindto: '#chart-wrapper', // id of chart wrapper
                data: {
                    columns: [
                        // each columns data
                        ['vendas', ...@json($valores)],
                    ],
                    labels: true,
                    type: 'line', // default type of chart
                    colors: {
                        'vendas': tabler.colors["green"]
                    },
                    names: {
                        'vendas': 'Vendas'
                    }
                },
                axis: {
                    x: {
                        type: 'category',
                        categories: @json($meses)
                    },
                },
                legend: {
                    show: false, //hide legend
                },
                padding: {
                    bottom: 0,
                    top: 0
                },
            });
        });
    });
</script>
