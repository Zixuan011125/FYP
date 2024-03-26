<?php 
include("includes/functions.php");

// Check if the customer ID is provided
if (isset($_GET['customer_id'])) {
    $customerId = $_GET['customer_id'];

    // Fetch customer details from the database
    $sql = "SELECT * FROM customers WHERE id='$customerId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $services = $row['services'];
            $date = $row['date'];

            // Retrieve the selected services from the services column of the customers table, 
            // Split them into an array, and then display each service in the invoice.
            // Need split as the price for each service are not same

            // Fetch selected services
            $selectedServices = $row['services'];

            // Split the selected services into an array
            $selectedServicesArray = explode(', ', $selectedServices);
        }
    } else {
        // Handling the customer not found
        echo "Customer not found";
    }
} else {
    echo "Customer ID not provided";
}

// Function to generate a random invoice number
function generateRandomInvoiceNumber()
{
    return mt_rand(100000, 999999);
}

// Insert the invoice into the database
if (isset($_GET['customer_id'])) {
    $invoiceNumber = generateRandomInvoiceNumber();
    $customerId = $_GET['customer_id'];
    $totalCost = 0;

    // Calculate total cost
    foreach ($selectedServicesArray as $service) {
        $sql = "SELECT cost FROM sub_services WHERE name='$service'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $totalCost += $row['cost'];
        }
    }

    // Insert invoice into invoices table
    $insertSql = "INSERT INTO invoices (invoices_number, customer_id, services, total_cost, date) VALUES ('$invoiceNumber', '$customerId', '$services', '$totalCost', NOW())";
    $insertResult = mysqli_query($conn, $insertSql);

    if (!$insertResult) {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/invoices.css">
    <title>FOREVER18 Hair Salon</title>
</head>

<body>
    <div class="invoice-wrapper">
        <div class="invoice">
            <div class="invoice-container">
                <div class="invoice-head">
                    <div class="invoice-head-top">
                        <div class="invoice-head-top-left text-start">
                            <img src="images/logo.jpg" alt="">
                        </div>
                        <div class="invoices-head-top-right text-end">
                            <h3>Invoice</h3>
                        </div>
                    </div>

                    <div class="hr"></div>
                    <div class="invoice-head-middle">
                        <div class="invoice-head-middle-left text-start">
                            <p><span class="text-bold">Date & Time</span>:
                                <?php echo $date; ?>
                            </p>
                        </div>
                        <div class="invoice-head-middle-right text-end">
                            <p><span class="text-bold">Invoice No:
                                    <?php echo $invoiceNumber; ?>
                                </span></p>
                        </div>
                    </div>
                    <div class="hr"></div>
                    <div class="invoice-head-bottom">
                        <div class="invoice-head-bottom-left">
                            <ul>
                                <li class="text-bold">Invoiced To: </li>
                                <li>
                                    <?php echo $name; ?>
                                </li>
                                <li>
                                    <?php echo $email ?>
                                </li>
                                <li>
                                    <?php echo $phone ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- End of Invoices Head -->

                <div class="overflow-view">
                    <div class="invoice-body">
                        <table>
                            <thead>
                                <tr>
                                    <td class="text-bold">No</td>
                                    <td class="text-bold">Services</td>
                                    <td class="text-bold">Cost</td>
                                    <td class="text-bold"></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                // Initialize total cost variable
                                $totalCost = 0;
                                // Counter for the service number
                                $counter = 1;

                                // Iterate through each selected services
                                foreach ($selectedServicesArray as $service) {
                                    // Fetch the name and cost of the services from the database
                                    $sql = "SELECT name, cost FROM sub_services WHERE name='$service'";
                                    $result = mysqli_query($conn, $sql);

                                    if ($result) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $name = $row['name'];
                                            $cost = $row['cost'];
                                            $totalCost += $cost;

                                            // Display the service name and cost in the invoice table
                                            echo '<tr>';
                                            echo '<td>' . $counter++ . '</td>';
                                            echo '<td>' . $name . '</td>';
                                            echo '<td class="text-end">RM ' . $cost . '</td>';
                                            echo '</tr>';
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                        <div class="invoice-body-bottom">
                            <div class="invoice-body-info-item border-bottom">
                                <div class="info-item-td text-end text-bold">Sub Total: </div>
                                <div class="info-item-td text-end">RM <?php echo $totalCost; ?></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Invoices Footer -->

                <div class="invoice-foot text-center">
                    <p><span class="text-bold text-center">NOTE:&nbsp;</span>Generated By FOREVER18 Hair Salon</p>

                    <div class="invoice-btns">
                        <button type="button" class="invoice-btn" onclick="printInvoice()">
                            <span><i class="fa-solid fa-print"></i></span>
                            <span>Print</span>
                        </button>

                        <!--<button type="button" class="invoice-btn">
                            <span><i class="fa-solid fa-download"></i></span>
                            <span>Download</span>
                        </button>-->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/invoices.js"></script>
</body>

</html>
