<?php
session_start();
include("header.php");
include("db_connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Cart</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center border rounded bg-light my-5">
            <h1>MY CART</h1>
        </div>
        <div class="col-lg-9">
            <table class="table">
                <thead class="text-center">
                <tr>
                    <th scope="col">Serial No.</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Item Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody class="text-center">
                <?php
                if (isset($_SESSION['customer_id'])) {
                    $user_id = $_SESSION['customer_id'];
                    $query = "SELECT c.CART_ID, p.NAME AS ITEM_NAME, c.PRICE, c.QUANTITY 
                              FROM CART c 
                              JOIN PRODUCT p ON c.PRODUCT_ID = p.PRODUCT_ID 
                              WHERE c.USER_ID = :user_id";
                    $stmt = oci_parse($conn, $query);
                    oci_bind_by_name($stmt, ":user_id", $user_id);
                    oci_execute($stmt);
                    $sr = 0;
                    while ($row = oci_fetch_assoc($stmt)) {
                        $sr++;
                        echo "
                        <tr>
                          <td>$sr</td>
                          <td>" . htmlspecialchars($row['ITEM_NAME']) . "</td>
                          <td>$ " . htmlspecialchars($row['PRICE']) . "<input type='hidden' class='iprice' value='" . htmlspecialchars($row['PRICE']) . "'></td>
                          <td><input class='text-center iquantity' onchange='updateQuantity(this, " . htmlspecialchars($row['CART_ID']) . ")' type='number' value='" . htmlspecialchars($row['QUANTITY']) . "' min='1' max='99'></td>
                          <td class='itotal'></td>
                          <td>
                            <form action='manage_cart.php' method='post'>
                                <button name='Remove_Item' class='btn btn-sm btn-outline-danger'>REMOVE</button>
                                <input type='hidden' name='Cart_ID' value='" . htmlspecialchars($row['CART_ID']) . "'>
                            </form>
                          </td>
                        </tr>
                        ";
                    }
                    oci_free_statement($stmt);
                } else {
                    echo "<script>
                            alert('You must be logged in to view your cart.');
                            window.location.href='customer_login.php';
                          </script>";
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-3">
            <div class="border bg-light rounded p-4">
                <h4>Total:</h4>
                <h5 class="text-right" id="gtotal"></h5>
                <br>
                <?php
                if (isset($_SESSION['customer_id'])) {
                    echo '<form action="purchase.php" method="post">
                        <button class="btn btn-primary btn-block" name="purchase">Make Purchase</button>
                    </form>';
                } else {
                    echo '<button class="btn btn-primary btn-block" onclick="window.location.href=\'customer_login.php\'">Login to Purchase</button>';
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    var gt = 0;
    var iprice = document.getElementsByClassName('iprice');
    var iquantity = document.getElementsByClassName('iquantity');
    var itotal = document.getElementsByClassName('itotal');
    var gtotal = document.getElementById('gtotal');

    function updateQuantity(quantityInput, cartId) {
        var quantity = quantityInput.value;

        var xhr = new XMLHttpRequest();
        xhr.open("POST", "update_quantity.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
            if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
                calculateTotal();
            }
        };
        xhr.send("cart_id=" + cartId + "&quantity=" + quantity);
    }

    function calculateTotal() {
        gt = 0;
        for (i = 0; i < iprice.length; i++) {
            itotal[i].innerText = (iprice[i].value) * (iquantity[i].value);
            gt = gt + (iprice[i].value) * (iquantity[i].value);
        }
        gtotal.innerText =gt;
    }

    window.onload = calculateTotal;
</script>
</body>
</html>
