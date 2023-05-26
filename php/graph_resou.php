<?php  require "monnit_server.php"  ?>
<!DOCTYPE html>
<html><head>
    

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
     <style>
         .alert {
    display: none;
    margin: 0px;
    height: auto;
    color: white;
    font-family: sans-serif;
    border: 1px solid transparent;
    border-radius: 25.25rem;
    background-color: red;
    padding: 5px;
    width:250px; 
    font-size: 13px;

    animation-iteration-count: infinite;
    animation-name: example;
    animation-duration: 1.5s;
    animation-direction: alternate;
    animation-delay: 0s; 
}

@keyframes example {
    0% {
        background-color: red;
    }

    100% {
        background-color: red;
        left: 100px;
        top: 0px;
    }
}</style>
    
    </head>
<body>
<div class="alert" id="ram_alert">
                            <strong><i class="material-icons" style="font-size:24px;"></i>Warning! </strong>Memory OverUsed. <a href="#" class="alert-link" style="text-decoration: none; color: black;">Know More..</a>
                        </div>

<canvas id="ramusage" style="width:100%;max-width:600px"></canvas>
     <div class="alert" id="disk_storage_alert">
                            <strong><i class="material-icons" style="font-size:24px;"></i>Warning! </strong> Storage Almost Full. <a href="#" class="alert-link" style="text-decoration: none; color: black;">Know More..</a>
                        </div>
<canvas id="diskStorage" style="width:100%;max-width:600px"></canvas>
    <div class="alert" id="cpu_utilization_alert">
                            <strong><i class="material-icons" style="font-size:24px;"></i>Warning!</strong>Very High CPU Utilization. <a href="#" class="alert-link" style="text-decoration: none; color: black;">Know More..</a>
                        </div>
    <canvas id="cpuUtilization" style="width:100%;max-width:600px"></canvas>
     <div class="alert" id="data_packet_loss_alert">
                        <strong><i class="material-icons" style="font-size:24px;"></i>Warning! </strong>More No. of Data Packets are Getting Lost. <a href="#" class="alert-link" style="text-decoration: none; color: black;">Know More..</a>
                    </div>
    <canvas id="packet_send_received" style="width:100%;max-width:600px"></canvas>
    <div class="alert" id="min_max_latency_time_alert">
                        <strong><i class="material-icons" style="font-size:24px;"></i>Warning! </strong>High Latency Time.<a href="#" class="alert-link" style="text-decoration: none; color: black;"> Know More..</a>
                    </div>
    <canvas id="latency_time_min_max_average" style="width:100%;max-width:600px"></canvas>
         <div class="alert" id="overall_latency_time_alert">
                        <strong><i class="material-icons" style="font-size:24px;"></i>Warning! </strong>High Average Latency Time. <a href="#" class="alert-link" style="text-decoration: none; color: black;">Know More..</a>
                    </div>
                    <canvas id="latency_time_overall" style="width:100%;max-width:600px"></canvas>
    
<script>
    //ram usage
var xValues = ["Used space","Available Space"];
var yValues = [<?=$use_ram?>,<?=$ava_ram?>];
var barColors = [
  "#b91d47",
  "#00aba9",
  "#2b5797",
  "#e8c3b9",
  "#1e7145"
];
  var elem = document.getElementById('ram_alert');
      

        if (<?= $use_ram ?> > 0.5 * <?= $total_ram ?>) {
            elem.style.display = "block";
        } else {
            elem.style.display = 'none';
        }
new Chart("ramusage", {
  type: "pie",
  data: {
    labels: xValues,
    datasets: [{
      backgroundColor: barColors,
      data: yValues
    }]
  },
  options: {
    title: {
      display: true,
      text: "Storage Statitics"
    }
  }
});
     // Disk Storage Pie Chart
        var xValues = ["Used Storage (In GB)", "Available Storage (In GB)"];
        var yValues = [<?= $use_store ?>, <?= $ava_store ?>];
        var barColors = ["#b91d47", "#00aba9"];

         var elem = document.getElementById('disk_storage_alert');
    

        if (<?= $use_store ?> > 0.1 * <?= $total_store ?>) {
            elem.style.display = "block";
        } else {
            elem.style.display = 'none';
        }
        new Chart("diskStorage", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: false,
                }
            }
        });
    
    // CPU Utilization - Current Data
        var xValues = <?= json_encode(array_values($t)); ?>;
        var cpuavg="";
           for(let x of xValues) {
               cpuavg=Number(cpuavg)+Number(x)/5;
               
           }
       var elem = document.getElementById('cpu_utilization_alert');

         if (cpuavg > 1) { 
            elem.style.display = "block";
        } else {
            elem.style.display = "none";
        }


        new Chart("cpuUtilization", {
            type: "line",
            data: {
                labels: xValues,
                datasets: [{
                    data:<?= json_encode(array_values($CpuUtilization)); ?>,
                    borderColor: "red",
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: false
                }
            },
            scales: {
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: 'Data'

                    }
                }]
            }
        });
      var aValues = ["Sent Packets", "Received Packets", "Loss Packets"];
            var bValues = [<?= $sent ?>, <?= $received ?>, <?= $loss ?>];
            var barColors = [
                "#0e1bab",
                "#04bf04",
                "#bf1704"
            ];
 var elem = document.getElementById('data_packet_loss_alert');

            if (<?= $loss ?> > <?= $received ?>) {
                elem.style.display = "block";
            } else {
                elem.style.display = 'none';
            }
           
            new Chart("packet_send_received", {
                type: "doughnut",
                data: {
                    labels: aValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: bValues
                    }]
                },
                options: {
                    title: {
                        display: false,
                    }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'value'
                        }
                    }
                }
            });
       var xValues = ["Minimum", "Maximum", "Average"];
            var yValues = [<?= $minimum ?>, <?= $maximum ?>, <?= $average ?>];
            var barColors = ["green", "red", "blue"];
            var zvalues = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10"];

           var elem = document.getElementById('min_max_latency_time_alert');

            if (<?= $maximum ?> > 90) {
                elem.style.display = "block";
            } else {
                elem.style.display = 'none';
            }


            new Chart("latency_time_min_max_average", {
                type: "bar",
                data: {
                    labels: xValues,
                    datasets: [{
                        backgroundColor: barColors,
                        data: yValues
                    }]
                },
                options: {

                    beginAtZero: true,


                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                    }
                },

                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'value'
                        }
                    }
                }
            });
   // Latency Chart Overall

            var elem = document.getElementById('overall_latency_time_alert');
            var avg_latency_time = ( <?= $val1 ?> + <?= $val2 ?> + <?= $val3 ?> + <?= $val4 ?> + <?= $val5 ?> + <?= $val6 ?> + <?= $val7 ?> + <?= $val8 ?> + <?= $val9 ?> + <?= $val10 ?> ) / 10;

            if (avg_latency_time > 75) {
                elem.style.display = "block";
            } else {
                elem.style.display = 'none';
            }
            new Chart("latency_time_overall", {
                type: "line",
                data: {
                    labels: zvalues,
                    datasets: [{
                        data: [ <?= $val1 ?>, <?= $val2 ?>, <?= $val3 ?>, <?= $val4 ?>, <?= $val5 ?>, <?= $val6 ?>, <?= $val7 ?>, <?= $val8 ?>, <?= $val9 ?> ,<?= $val10 ?>],
                        borderColor: "green",
                        fill: false
                    }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    title: {
                        display: false,
                    }
                }
            });

    
</script>
</body>
</html>
