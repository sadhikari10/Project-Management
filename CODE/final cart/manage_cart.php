<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['customer_id'];

    // Define the cart limit
   

    if (isset($_POST['Add_To_Cart'])) {

        $cart_limit = 20;

        // Count the number of items in the cart
        $count_query = "SELECT COUNT(*) AS ITEM_COUNT FROM CART WHERE USER_ID = :user_id";
        $count_stmt = oci_parse($conn, $count_query);
        oci_bind_by_name($count_stmt, ":user_id", $user_id);
        oci_execute($count_stmt);
        $count_result = oci_fetch_assoc($count_stmt);
        oci_free_statement($count_stmt);
    
        if ($count_result['ITEM_COUNT'] >= $cart_limit) {
            echo "<script>
                    alert('The cart has reached its limit');
                    window.location.href='index.php';
                  </script>";
            exit;
        }
        
        $product_id = $_POST['Product_ID'];
        $price = $_POST['Price'];
        
        // Default status value
        $status = 1;
    
        // Check if the item is already in the cart
        $query = "SELECT * FROM CART WHERE PRODUCT_ID = :product_id AND USER_ID = :user_id";
        $stmt = oci_parse($conn, $query);
        oci_bind_by_name($stmt, ":product_id", $product_id);
        oci_bind_by_name($stmt, ":user_id", $user_id);
        oci_execute($stmt);
    
        if (oci_fetch_assoc($stmt)) {
            // Update quantity if already in cart
            $query = "UPDATE CART SET QUANTITY = QUANTITY + 1 WHERE PRODUCT_ID = :product_id AND USER_ID = :user_id";
        } else {
            // Insert new item into cart
            $query = "INSERT INTO CART (USER_ID, PRODUCT_ID, QUANTITY, PRICE, STATUS) VALUES (:user_id, :product_id, 1, :price, :status)";
        }
    
        oci_free_statement($stmt);
    
        $stmt = oci_parse($conn, $query);
        oci_bind_by_name($stmt, ":user_id", $user_id);
        oci_bind_by_name($stmt, ":product_id", $product_id);
        oci_bind_by_name($stmt, ":price", $price); // Check if $price is numeric
        oci_bind_by_name($stmt, ":status", $status);
        $result = oci_execute($stmt);
    
        if (!$result) {
            $error = oci_error($stmt);
            die("Query execution failed: " . htmlentities($error['message']));
        }
    
        oci_free_statement($stmt);
    
        echo "<script>
                alert('Item added to cart');
                window.location.href='index.php';
              </script>";
    }
    
    

    if (isset($_POST['Remove_Item'])) {
        $cart_id = $_POST['Cart_ID'];

        $query = "DELETE FROM CART WHERE CART_ID = :cart_id AND USER_ID = :user_id";
        $stmt = oci_parse($conn, $query);
        oci_bind_by_name($stmt, ":cart_id", $cart_id);
        oci_bind_by_name($stmt, ":user_id", $user_id);

        $result = oci_execute($stmt);

        if (!$result) {
            $error = oci_error($stmt);
            die("Query execution failed: " . htmlentities($error['message']));
        }

        oci_free_statement($stmt);

        echo "<script>
                alert('Item removed from cart');
                window.location.href='mycart.php';
              </script>";
    }

    if (isset($_POST['Update_Quantity'])) {
        $cart_id = $_POST['Cart_ID'];
        $quantity = $_POST['Quantity'];

        $query = "UPDATE CART SET QUANTITY = :quantity WHERE CART_ID = :cart_id AND USER_ID = :user_id";
        $stmt = oci_parse($conn, $query);
        oci_bind_by_name($stmt, ":quantity", $quantity);
        oci_bind_by_name($stmt, ":cart_id", $cart_id);
        oci_bind_by_name($stmt, ":user_id", $user_id);

        $result = oci_execute($stmt);

        if (!$result) {
            $error = oci_error($stmt);
            die("Query execution failed: " . htmlentities($error['message']));
        }

        oci_free_statement($stmt);

        echo "<script>
                alert('Quantity updated');
                window.location.href='mycart.php';
              </script>";
    }
}
?>
