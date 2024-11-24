<?php
session_start();
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cart_id']) && isset($_POST['quantity']) && isset($_SESSION['customer_id'])) {
        $cart_id = $_POST['cart_id'];
        $quantity = $_POST['quantity'];
        $user_id = $_SESSION['customer_id'];

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
    }
}
?>
