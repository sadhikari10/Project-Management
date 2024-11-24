<?php 
    session_start();
    if(isset($_POST['submit'])){
        $name = $_POST['shop_name'];
        $category = $_POST['category'];
        $user_id = $_SESSION['trader_id'];
        $shop_status = 0;

        $conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');
 
        $qry="INSERT INTO SHOP(SHOP_NAME, USER_ID, SHOP_STATUS, SHOP_CATEGORY) VALUES ('$name', '$user_id', '$shop_status', '$category')";
        $stid=oci_parse($conn, $qry);
        $stid1 = oci_execute($stid);

        if($stid1){
            echo "<script>
                alert('Shop Registered successfully.');
				window.location.href='../trader_dashboard.php';
                </script>";
        }
        else{
            echo "Something went wrong.";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add a new shop</title>
        <link rel="stylesheet" href="style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		
        <!-- Header -->
        <?php 
            include('head.php');
        ?>
    </head>
    <body>
        <form action= "new_shop.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend><h2>Register a new Shop</h2></legend>
                <label>Name</label><br>
                <input type="text" name="shop_name" placeholder="Enter your shop name" required><br><br>
                <label>Shop Category</label><br>
                <input type="text" name="category" placeholder="Enter your shop Category" required><br><br>
                <input type="submit" value="Register Shop" name="submit">
            </fieldset>
        </form>
    </body>

    <!-- Footer -->
    <?php
        include('foot.php');
    ?>
</html>