 <?php
session_start();
if (isset($_GET['productId']) && isset($_GET['quantity'])) {
    $productId = $_GET['productId'];
    $quantity = $_GET['quantity'];

    foreach ($_SESSION['cart'] as &$item) {
        if ($item['Product_ID'] == $productId) {
            $item['Quantity'] = $quantity;
            break;
        }
    }
}
header('Location: mycart.php');
exit();
?>
