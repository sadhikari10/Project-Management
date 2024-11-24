<?php
    session_start();
    $conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');
 
    $user_id = $_SESSION['trader_id'];
    $shop_id_query = "SELECT SHOP_ID FROM SHOP WHERE USER_ID = :user_id";
    $stid = oci_parse($conn, $shop_id_query);
    oci_bind_by_name($stid, ':user_id', $user_id);
    oci_execute($stid);
    while($row = oci_fetch_array($stid, OCI_ASSOC)){
        $shop_id = $row['SHOP_ID'];
        $_SESSION["shop_id"] = $row['SHOP_ID'];
    }
    if(!$conn) {
        $e = oci_error();
        echo htmlentities($e['message'], ENT_QUOTES);
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get form data
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $contactNumber = $_POST['contact_number'];
        $gender = $_POST['gender'];

        // Handle file upload
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            $target_dir = "../All Images/Trader Images/";
            $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
            move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
        }

        $traderId = $_SESSION['trader_id']; 
        $updateQuery = 'UPDATE ALL_USER SET FIRST_NAME = :firstName, LAST_NAME = :lastName, EMAIL = :email, PHONE_NO = :contactNumber, GENDER = :gender WHERE USER_ID = :traderId';
        $stid = oci_parse($conn, $updateQuery);
        oci_bind_by_name($stid, ':firstName', $firstName);
        oci_bind_by_name($stid, ':lastName', $lastName);
        oci_bind_by_name($stid, ':email', $email);
        oci_bind_by_name($stid, ':contactNumber', $contactNumber);
        oci_bind_by_name($stid, ':gender', $gender);
        oci_bind_by_name($stid, ':traderId', $traderId);
        $result = oci_execute($stid);
        if ($result) {
            echo "<script>
                alert('Profile updated successfully.');
                </script>";
        } else {
            $e = oci_error($stid);
            echo htmlentities($e['message'], ENT_QUOTES);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Trader Dashboard</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }

            .container {
                display: flex;
                height: 100vh;
            }

            .sidebar {
                width: 250px;
                background-color: #333;
                color: white;
                padding: 20px;
                box-sizing: border-box;
            }

            .sidebar h2 {
                text-align: center;
            }

            .sidebar img {
                display: block;
                margin: 0 auto;
                width: 100px;
                height: 100px;
                border-radius: 50%;
            }

            .sidebar button {
                display: block;
                width: 100%;
                padding: 10px;
                margin: 10px 0;
                background-color: #555;
                border: none;
                color: white;
                cursor: pointer;
                text-align: left;
            }

            .sidebar button:hover {
                background-color: #777;
            }

            .content {
                flex: 1;
                padding: 20px;
                box-sizing: border-box;
                position: relative;
            }

            .content h2 {
                margin-top: 0;
            }

            .form-group {
                margin-bottom: 15px;
            }

            label {
                display: block;
                margin-bottom: 5px;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #EFE1F0; /* Button color */
            }

            input[type="text"],
            input[type="email"],
            input[type="file"],
            select {
                width: 100%;
                max-width: 300px;
                padding: 10px;
                margin: 0;
                box-sizing: border-box;
            }

            .save-button {
                display: block;
                padding: 10px 20px;
                background-color: #4CAF50;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
                margin-top: 20px;
            }

            .save-button:hover {
                background-color: #45a049;
            }

            .signout-button {
                position: absolute;
                top: 20px;
                right: 20px;
                padding: 10px 20px;
                background-color: #e74c3c;
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 16px;
            }

            .signout-button:hover {
                background-color: #c0392b;
            }
            
            .header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 20px;
                background-color: #333;
                color: white;
            }

            .header img {
                width: 40px;
                height: 40px;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <img src="logo.jpg" alt="Logo">
            <div></div>
            <button class="signout-button"><a href="trader_logout.php">Sign Out</a></button>
        </div>
        <div class="container">
            <div class="sidebar">
                <h2>Trader Dashboard</h2>
                <?php 
                    $shop_id_query = "SELECT SHOP_ID FROM SHOP WHERE USER_ID = :user_id";
                    $stid = oci_parse($conn, $shop_id_query);
                    oci_bind_by_name($stid, ':user_id', $user_id);
                    oci_execute($stid);
                    while($row = oci_fetch_array($stid, OCI_ASSOC)){
                        $shop_id = $row['SHOP_ID'];
                        $_SESSION["shop_id"] = $row['SHOP_ID'];
                    }
                ?>
                <a href="ShopSphere/addproducts.php" class="button">Add Products</a><br>
                <a href="ShopSphere/viewproducts.php" class="button">View Products</a><br>
                <a href="ShopSphere/edit_delete.php" class="button">Edit/Delete</a><br>
                <a href="ShopSphere/new_shop.php" class="button">Add a Shop</a><br>
            </div>
            <div class="content">
                <h3>Your Information</h3>
                <?php 
                    $id = $_SESSION['trader_id'];  
                    $qry = "SELECT * FROM ALL_USER WHERE USER_ID = $id";
                    $stid = oci_parse($conn, $qry);
                    oci_execute($stid);
                    $row = oci_fetch_assoc($stid);
                        echo "<p> ID:  ".$row['USER_ID']."</p>";
                        echo "<p> First Name:  ".$row['FIRST_NAME']."</p>";
                        echo "<p> Last Name:   ".$row['LAST_NAME']."</p>";
                        echo "<p> Email: "  .$row['EMAIL']."</p>";
                        echo "<p> Phone No:  ".$row['PHONE_NO']."</p>";
                        echo "<p> Address:  ".$row['ADDRESS']."</p>";
                        echo "<p> Gender:  ".$row['GENDER']."</p>";

                ?>
                <form action="trader_dashboard.php" method="post" enctype="multipart/form-data">
                    <fieldset>
                        <legend><h3>Edit Details</h3></legend>
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" id="first_name" name="first_name" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" id="last_name" name="last_name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="contact_number">Contact Number</label>
                            <input type="text" id="contact_number" name="contact_number" required>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select id="gender" name="gender"  required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="profile_picture">Change your picture</label>
                            <input type="file" id="profile_picture" name="profile_picture"  required>
                        </div>
                        <input type="submit" name="submit" value="Make changes">
                    </fieldset>
                </form>
            </div>
        </div>
    </body>
</html>