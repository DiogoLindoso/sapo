<div class="content">
    <div class="container-fluid">
        <div class="section">
            
            
            <div class="col-md-12 row-md-2">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">Estatísticas</h4>
                        <p class="card-category">Tempo de espera</p>
                    </div>
                    <div class="card-body">   
                        <canvas id="myChart" width="800" height="200"></canvas>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i class="fa fa-clock-o"></i> Verificado 05/03/2019 às 08:35.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  Chartist Plugin  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<script type="text/javascript">
    var pre = <?php echo $_POST['media-pre'] ? $_POST['media-pre'] : 0 ?>;
    var pos = <?php echo $_POST['media-pos'] ? $_POST['media-pos'] : 0 ?>;
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ["Antes de 01/09/18", "Depois de 01/09/18"],
        datasets: [{
            label: 'Média Tempo de espera (dias)',
            data: [pre, pos],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>