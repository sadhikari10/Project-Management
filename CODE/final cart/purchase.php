<?php
session_start();

include("header.php");
include("db_connect.php");

// Fetch cart items and calculate total
$cart_items = [];
$total_amount = 0;

if (isset($_SESSION['customer_id'])) {
    $user_id = $_SESSION['customer_id'];
    $query = "SELECT c.CART_ID, p.NAME AS ITEM_NAME, c.PRICE, c.QUANTITY 
              FROM CART c 
              JOIN PRODUCT p ON c.PRODUCT_ID = p.PRODUCT_ID 
              WHERE c.USER_ID = :user_id";
    $stmt = oci_parse($conn, $query);
    oci_bind_by_name($stmt, ":user_id", $user_id);
    oci_execute($stmt);

    
    while ($row = oci_fetch_assoc($stmt)) {
        $cart_items[] = $row;
        $total_amount += ($row['PRICE'] * $row['QUANTITY']);
    }

    oci_free_statement($stmt);
} else {
    header("Location: customer_login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Make Purchase</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center border rounded bg-light my-5">
            <h1>Invoice</h1>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <!-- Display customer information -->
            <!-- You can customize this section to display customer details -->
            <h3>Customer Information</h3>
            <?php 
                $id = $_SESSION['customer_id'];
                $qry="SELECT * from ALL_USER WHERE USER_ID = '$id'";
                $stid=oci_parse($conn, $qry);
                oci_execute($stid);
                while($row=oci_fetch_assoc($stid))
                {   echo "From: SHOPSPHERE <br><br>";
                    echo "To:".$row['FIRST_NAME']."<br><br>";
                    echo "Email:".$row['EMAIL']."<br><br>";
                    echo "Customer ID:".$row['USER_ID']."<br><br>";
                    echo "Contact no:".$row['PHONE_NO']."<br><br>";
                    echo "Customer Address:".$row['ADDRESS']."<br><br>";
                    echo "ShopSphere Address: TBC<br><br>";    
                }
            ?>
            <!-- Add more customer details as needed -->
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <table class="table">
                <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Item Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($cart_items as $key => $item): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo htmlspecialchars($item['ITEM_NAME']); ?></td>
                        <td>$ <?php echo htmlspecialchars($item['PRICE']); ?></td>
                        <td><?php echo htmlspecialchars($item['QUANTITY']); ?></td>
                        <td><?php echo ($item['PRICE'] * $item['QUANTITY']); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6 offset-md-6">
            <h4>Total Amount: $ <?php echo $total_amount;
                $_SESSION['amount'] = $total_amount;
            ?></h4>
            <!-- PayPal payment button -->
            <div id="paypal-button-container"></div>
        </div>
    </div>

 

</div>

<!-- Include the PayPal JavaScript SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=AbWUiXswnFrR2LyZbk58qBUci7r-WDDlAchTo7hNfiieR-TbjG8szGa_uYfT3GakP0MXtjsZQBrPYcs-"></script>

<script>
    // Render PayPal button
    paypal.Buttons({
        createOrder: function(data, actions) {
            // Set up the transaction
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $total_amount; ?>' // Total amount to be paid
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            // Capture the funds from the transaction
            return actions.order.capture().then(function(details) {
                // Redirect to a success page or display a success message
                
                window.location.href = 'payment_success.php';
            });
        }

    }).render('#paypal-button-container');
</script>
    </body>
    </html>
    