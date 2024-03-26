<?php include("includes/functions.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="includes/sidebar.css">
    <title>Side Bar</title>
</head>

<body>
    <nav class="sidebar">
        <a href="#" class="logo">FOREVER18 Hair Salon</a>

        <div class="menu-content">
            <ul class="menu-items">
                <!--<div class="menu-title">Your menu title</div>-->

                <li class="item">
                    <a href="dashboard.php">Dashboard</a>
                </li>

                <li class="item">
                    <div class="submenu-item">
                        <span>Services</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <ul class="menu-items submenu">
                        <div class="menu-title">
                            <i class="fa-solid fa-chevron-left"></i>
                            Back
                        </div>

                        <li class="item">
                            <a href="services.php">Services List</a>
                        </li>

                        <li class="item">
                            <a href="display_services.php">Sub Services List</a>
                        </li>
                    </ul>
                </li>

                <li class="item">
                    <a href="appointments.php">Appointments</a>
                </li>

                <li class="item">
                    <a href="customers.php">Customers</a>
                </li>

                <li class="item">
                    <a href="view_invoices.php">Invoices</a>
                </li>

                <li class="item">
                    <div class="submenu-item">
                        <span>Reports</span>
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>

                    <ul class="menu-items submenu">
                        <div class="menu-title">
                            <i class="fa-solid fa-chevron-left"></i>
                            Back
                        </div>

                        <li class="item">
                            <a href="pieChart_reports.php">Service Popularity Report</a>
                        </li>

                        <li class="item">
                            <a href="barChart_reports.php">Total Benefit Report</a>
                        </li>
                    </ul>
                </li>

                <li class="item">
                    <a href="employees.php">Employees</a>
                </li>

                <li class="item">
                    <a href="administrator_reviews.php">Reviews</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Side Bar Button -->
    <nav class="navbar">
        <i class="fa-solid fa-bars" id="sidebar-close"></i>
    </nav>

    <!--<main class="main">
        
    </main>-->

    <script src="includes/sidebar.js"></script>
</body>

</html>