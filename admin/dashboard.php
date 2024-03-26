<?php include("includes/functions.php");?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Dashboard</title>
</head>

<body>
    <?php include("sidebar.php"); ?>
    <main class="main">
        <section id="content">
            <!-- Main -->
            <main>
                <div class="head-title">
                    <div class="left">
                        <h1>Dashboard</h1>
                    </div>
                    <a href="#" class="btn-download">
                        <i class='bx bxs-cloud-download'></i>
                        <span class="text">Download PDF</span>
                    </a>
                </div>

                <ul class="box-info">
                    <li>
                        <?php
                        $sql = "SELECT COUNT(*) AS total_appointments FROM appointments";
                        $result = mysqli_query($conn, $sql);

                        if($result){
                            // Fetch the total number of appointments
                            $row = mysqli_fetch_assoc($result);
                            $total_appointments = $row['total_appointments'];
                        }
                        ?>

                        <i class='bx bxs-calendar-check'></i>
                        <span class="text">
                            <h3><?php echo $total_appointments ?></h3>
                            <p>Total Appointments</p>
                        </span>
                    </li>
                    <li>
                        <?php 
                        $sql = "SELECT COUNT(*) AS total_customers FROM customers";
                        $result = mysqli_query($conn, $sql);

                        if($result){
                            $row = mysqli_fetch_assoc($result);
                            $total_customers = $row['total_customers'];
                        }
                        ?>
                        <i class='bx bxs-group'></i>
                        <span class="text">
                            <h3><?php echo $total_customers ?></h3>
                            <p>Total Customers</p>
                        </span>
                    </li>
                    <li>
                        <?php
                        $sql = "SELECT SUM(total_cost) AS total_benefits FROM invoices";
                        $result = mysqli_query($conn, $sql);

                        if($result){
                            $row = mysqli_fetch_assoc($result);
                            $total_benefits = $row['total_benefits'];
                        }
                        ?>
                        <i class='bx bxs-dollar-circle'></i>
                        <span class="text">
                            <h3>RM <?php echo $total_benefits ?></h3>
                            <p>Total Benefits</p>
                        </span>
                    </li>
                </ul>
            </main>
            <!-- End of Main -->
        </section>
        <!-- End of Content -->
    </main>

</body>

</html>