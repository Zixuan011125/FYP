<?php include("includes/functions.php");

// $sql = "SELECT services, COUNT(*) as number FROM customers GROUP BY services";
$sql = "SELECT services FROM customers";
$result = mysqli_query($conn, $sql);

// Initialize an empty array to store all services (as now the services are combined, need to split)
$allServices = [];

// Fetch all services from customers
while ($row = mysqli_fetch_array($result)) {

    // Explode the concatenated services into an array
    $servicesArray = explode(', ', $row['services']);

    // Merge the services into the allServices array
    $allServices = array_merge($allServices, $servicesArray);
}

// Count the occurrence of each services
$serviceCounts = array_count_values($allServices);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Chart Library -->
    <script src="https://www.gstatic.com/charts/loader.js"></script>

    <!--  Now is using Google Charts API-->

    <!-- For Chart, can do sales based on the invoices, so maybe the invoices need to be stored in database
        ,then can track it at customer side (for the order details), and can display it also for sales 
        at administrator side
        next is check which services is most popular 
        then one more can put like line graph for the profit between month 
        main services and sub_services 
    1. I think can display all the services in the pie chart form that display data -->

    <script>
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Services');
            data.addColumn('number', 'Number');

            data.addRows([
                <?php
                foreach ($serviceCounts as $service => $count) {
                    echo "['" . $service . "', " . $count . "],";
                }
                ?>
            ]);

            var options = {
                title: 'Service Popularity',
                is3D: true,
                // Extra, pieHole: 0.4
                backgroundColor: 'transparent',
                chartArea: { width: '100%', height: '80%'}
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);

        }
    </script>

    <title>Reports</title>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <main class="main">
        <section id="content">
            <div id="piechart" style="max-width:700px; height:500px;"></div>
        </section>
    </main>

</body>

</html>