<?php
    session_start();
    include('header.php');
    if (isset($_GET['product_id'])) {
        $id = intval($_GET['product_id']);
    } else {
        echo "Product ID not provided!";
        exit;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {   
        $product_id = intval($_POST['product_id']);
        $rating = intval($_POST['rating']);
        $title = htmlspecialchars($_POST['title']); // This variable is declared but not used in the query
        $review = htmlspecialchars($_POST['review']);
        $user_id = $_SESSION['customer_id']; // Assuming user ID is stored in the session

        $conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');

        if (!$conn) {
            $e = oci_error();
            echo "Failed to connect to the database: " . $e['message'];
            exit;
        }

        $qry = "INSERT INTO REVIEW (REVIEW_TEXT, REVIEW_TITLE,RATE, FK_USER_ID, FK_PRODUCT_ID) VALUES (:review,:title, :rating, :user_id, :product_id)";
        $stid = oci_parse($conn, $qry);
        oci_bind_by_name($stid, ':title',$title);
        oci_bind_by_name($stid, ':review', $review);
        oci_bind_by_name($stid, ':rating', $rating);
        oci_bind_by_name($stid, ':user_id', $user_id);
        oci_bind_by_name($stid, ':product_id', $product_id);

        $review = oci_execute($stid);
        if ($review) {
            echo "<script>
                alert('Review submitted successfully');
                window.location.href='index.php';
                </script>";
        } else {
            $e = oci_error($stid);
            echo "Failed to submit the review: " . $e['message'];
        }
        oci_free_statement($stid);
        oci_close($conn);
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Detail</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container mt-5">
            <?php
        $conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');
        $qry = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :id";
                $stid = oci_parse($conn, $qry);
                oci_bind_by_name($stid, ':id', $id);
                oci_execute($stid);
                echo '<table class="table table-bordered">';
                echo '<thead class="thead-dark">';
                echo '<tr>';
                echo '<th>Name</th>';
                echo '<th>Product Description</th>';
                echo '<th>Unit price</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = oci_fetch_assoc($stid)) {
                    // Read the contents of OCILob fields as strings
                    $name = is_a($row['NAME'], 'OCILob') ? $row['NAME']->load() : $row['NAME'];
                    $description = is_a($row['DESCRIPTION'], 'OCILob') ? $row['DESCRIPTION']->load() : $row['DESCRIPTION'];
                    $unit_price = is_a($row['UNIT_PRICE'], 'OCILob') ? $row['UNIT_PRICE']->load() : $row['UNIT_PRICE'];
                
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($name) . '</td>';
                    echo '<td>' . htmlspecialchars($description) . '</td>';
                    echo '<td> $ ' . htmlspecialchars($unit_price) . '</td>';
                    echo '</tr>';
            }
                echo '</tbody>';
                echo '</table>';
                oci_free_statement($stid);
                oci_close($conn);
            ?>

            <h2>Rate and Review this Product</h2>
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="product_id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="rating">Rating:</label>
                    <select name="rating" id="rating" class="form-control" required>
                        <option value="">Select Rating</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="name">Review title:</label>
                    <input type="text" name="title" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="review">Write your review here:</label>
                    <textarea name="review" id="review" class="form-control" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
</html>