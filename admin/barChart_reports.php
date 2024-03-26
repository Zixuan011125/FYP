<?php include("includes/functions.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Google Chart Library -->
    <script src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        google.charts.load('current', { 'packages': ['corechart'] });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Total Cost');

            <?php
            // Fetch total cost data from invoices table
            $sql = "SELECT DATE_FORMAT(date, '%Y-%m') AS month, SUM(total_cost) AS total FROM invoices GROUP BY DATE_FORMAT(date, '%Y-%m')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "data.addRow(['" . $row['month'] . "', " . $row['total'] . "]);";
                }
            }
            ?>

            var options = {
                title: 'Total Benefit (RM)',
                legend: { position: 'none' },
                vAxis: {
                    // y-axis display integer values only
                    format: '0'
                },
                backgroundColor: 'transparent',
                chartArea: {
                    width: '50%', // Adjust the width of the chart area
                    height: '70%' // Adjust the height of the chart area
                }
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('barchart'));
            chart.draw(data, options);
        }
    </script>

    <title>Reports</title>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <main class="main">
        <section id="content">
            <div id="barchart" style="max-width:700px; height:500px"></div>
        </section>
    </main>

</body>

</html>