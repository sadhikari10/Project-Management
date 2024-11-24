<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Get form data
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $contactNumber = $_POST['contact_number'];
        $gender = $_POST['gender'];

        // Handle file upload
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
            $target_dir = "../customer/images/";
            $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
            move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);
        }


        $Id = $_SESSION['customer_id']; 
        $conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');
 

        $updateQuery = 'UPDATE ALL_USER SET FIRST_NAME = :firstName, LAST_NAME = :lastName, EMAIL = :email, PHONE_NO = :contactNumber, GENDER = :gender, IMAGE = :folder WHERE USER_ID = :id';
        $stid = oci_parse($conn, $updateQuery);

        oci_bind_by_name($stid, ':firstName', $firstName);
        oci_bind_by_name($stid, ':lastName', $lastName);
        oci_bind_by_name($stid, ':email', $email);
        oci_bind_by_name($stid, ':contactNumber', $contactNumber);
        oci_bind_by_name($stid, ':gender', $gender);
        oci_bind_by_name($stid,':folder', $target_file);
        oci_bind_by_name($stid, ':id', $Id);

        $result = oci_execute($stid);
        if ($result) {
            echo "Profile updated successfully!";
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
    <title>Edit Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            color: #333;
            margin-top: 0;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="file"] {
            width: calc(100% - 100px);
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        button {
            background-color: #008CBA;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        button a {
            color: white;
            text-decoration: none;
        }
        button:hover {
            background-color: #005f6b;
        }
    </style>
</head>

<body>

    <?php 
        $id = $_SESSION['customer_id'];  
        $conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');

        $qry = "SELECT * FROM ALL_USER WHERE USER_ID = $id";
        
        $stid = oci_parse($conn, $qry);
        oci_execute($stid);
        $row = oci_fetch_assoc($stid);

        $image_path = htmlspecialchars($row['IMAGE']);
        
        echo '<img src="../customer/' . $image_path . '" style="width:200px;height:200px"<br>';
        echo "<p> First Name:  ".$row['FIRST_NAME']."</p>";
        echo "<p> Last Name:   ".$row['LAST_NAME']."</p>";
        echo "<p> Email:"  .$row['EMAIL']."</p>";
        echo "<p> Phone No:  ".$row['PHONE_NO']."</p>";
        echo "<p> Address:  ".$row['ADDRESS']."</p>";
        echo "<p> Gender:  ".$row['GENDER']."</p>";

    ?>
        




    <div class="container">
        <form action="editprofile.php" method="post" enctype="multipart/form-data">
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
                    <select id="gender" name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="profile_picture">Change your picture</label>
                    <input type="file" id="profile_picture" name="profile_picture" required>
                </div>
                <input type="submit" name="submit" value="Make changes">
            </fieldset>
        </form>
        <button><a href="index.php">Return to homepage</a></button>
    </div>
</body>
</html>
