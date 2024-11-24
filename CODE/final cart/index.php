<?php
    session_start();
    include('../Connection/connect.php');
    include ('header.php');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Index</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <?php
                    $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';
                    $category = isset($_GET['category']) ? $_GET['category'] : '';
                    if (!empty($search_query)) {
                        $sql = "SELECT * FROM PRODUCT WHERE NAME LIKE '%' || :search_query || '%' OR DESCRIPTION LIKE '%' || :search_query || '%'";
                        $result = oci_parse($conn, $sql);
                        oci_bind_by_name($result, ':search_query', $search_query);
                    } elseif (!empty($category)) {
                        $sql = "SELECT p.* FROM PRODUCT p JOIN SHOP s ON p.SHOP_ID = s.SHOP_ID WHERE s.SHOP_CATEGORY = :category";
                        $result = oci_parse($conn, $sql);
                        oci_bind_by_name($result, ':category', $category);
                    } else {
                        $sql = "SELECT * FROM PRODUCT";
                        $result = oci_parse($conn, $sql);

                        
                    }

                    if (!$result) {
                        die("Query preparation failed: " . oci_error($conn));
                    }

                    if (!oci_execute($result)) {
                        die("Query execution failed: " . oci_error($result));
                    }

                    while ($row = oci_fetch_assoc($result)) {
                        $image_path = htmlspecialchars($row['IMAGE']);
                        $product_name = htmlspecialchars($row['NAME']);
                        $product_price = htmlspecialchars($row['UNIT_PRICE']);
                        $product_id = htmlspecialchars($row['PRODUCT_ID']);

                        echo "<div class='col-lg-3'>";
                        echo "<form action='manage_cart.php' method='post' enctype='multipart/form-data'>";
                        echo "<div class='card'>";
                        echo '<a href="productdetail.php?product_id=' . $product_id . '">';
                        echo '<img src="' . $image_path . '" alt="' . $product_name . '" style="width:200px;height:200px;display:block;margin-left:auto;margin-right:auto;">';
                        echo '</a>';
                        echo "<div class='card-body text-center'>";
                        echo "<h5 class='card-title'>$product_name</h5>";
                        echo "<p class='card-text'>Price: $$product_price</p>";
                        echo "<button type='submit' name='Add_To_Cart' class='btn btn-info'>Add To Cart</button> &nbsp";
                        echo "<input type='hidden' name='Product_ID' value='$product_id'>";
                        echo "<input type='hidden' name='Price' value='$product_price'>";
                        echo "</div></div></form></div>";
                    }

                    oci_free_statement($result);
                ?>
            </div>
        </div>
    </body>
    <button><a href="logout.php">logout</a></button>
    <button><a href="editprofile.php">Edit profile</a></button>
</html>