<?php include("includes/functions.php");

// Check if the invoice_id is provided in the URL
if (isset($_GET['invoice_id'])) {
    $invoiceId = $_GET['invoice_id'];

    // Fetch invoice details from the database
    $sql = "SELECT * FROM invoices WHERE id='$invoiceId'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $customerId = $row['customer_id'];
            $invoiceNumber = $row['invoices_number'];
            $date = $row['date'];
            $totalCost = $row['total_cost'];
        }
    } else {
        echo "Invoice not found";
        exit(); // Stop further execution if invoice not found
    }

    // Fetch customer details from the database using the customer_id
    $customerSql = "SELECT * FROM customers WHERE id='$customerId'";
    $customerResult = mysqli_query($conn, $customerSql);

    if ($customerResult && mysqli_num_rows($customerResult) > 0) {
        while ($row = mysqli_fetch_assoc($customerResult)) {
            $name = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $services = $row['services'];
            // Split the services string into an array
            $selectedServicesArray = explode(', ', $services);
        }
    } else {
        echo "Customer not found";
        exit(); // Stop further execution if customer not found
    }
} else {
    echo "Invoice ID not provided";
    exit(); // Stop further execution if invoice ID not provided
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                                <div class="info-item-td text-end">RM
                                    <?php echo $totalCost; ?>
                                </div>
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