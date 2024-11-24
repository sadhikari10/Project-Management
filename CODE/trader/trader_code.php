<?php 
    if (isset($_POST['submit'])) {
        $firstname = trim($_POST["firstname"]);
        $lastname = trim($_POST["lastname"]);
        $password = md5(trim($_POST["password"]));
        $email = trim($_POST["email"]);
        $contact_no = trim($_POST["contact_number"]);
        
        $address = trim($_POST["address"]);
        $gender = $_POST["gender"];
        $role = "trader";
        $token = rand(10000,99999);
        $verify_status = "0";
        
        //image
        $filename =  $_FILES["uploadfile"]["name"];
        $tempname =  $_FILES["uploadfile"]["tmp_name"];
        $folder="images/".$filename;
        move_uploaded_file($tempname,$folder);

        $conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');

        if (!preg_match('/^[a-zA-Z]+$/', $firstname)) {
            echo "First name is invalid";
        }
        elseif (!preg_match('/^[a-zA-Z]+$/', $lastname)) {
            echo "Last name is invalid";
        }
        else{

        $qry = "INSERT INTO ALL_USER (FIRST_NAME,LAST_NAME,EMAIL,PASSWORD,PHONE_NO,ADDRESS,GENDER,IMAGE,VERIFICATION_CODE,ROLE,VERIFY_STATUS)
        VALUES(:firstname,:lastname,:email,:password,:contact_no,:address,:gender,:folder,:token,:role,:verify_status)";
        //var_dump($qry);
        $stid = oci_parse($conn,$qry);
        
        //binding all input parameters for insert query
        //binding prevents sql injection(database engine ensures that
        //that the parameters values are data and not pary of the sql
        //commands)
        oci_bind_by_name($stid, ':firstname', $firstname);
        oci_bind_by_name($stid, ':lastname', $lastname);
        oci_bind_by_name($stid, ':email', $email);
        oci_bind_by_name($stid, ':password', $password);
        oci_bind_by_name($stid, ':contact_no', $contact_no);
        oci_bind_by_name($stid, ':address', $address);
        oci_bind_by_name($stid, ':gender', $gender); 
        oci_bind_by_name($stid, ':folder', $folder);
        oci_bind_by_name($stid, ':token', $token);
        oci_bind_by_name($stid, ':role', $role);
        oci_bind_by_name($stid, ':verify_status', $verify_status);
        // executing the query
        $stid1 = oci_execute($stid);
        if($stid1) {
            header("Location:trader_login.php");
            exit();
        }
        else {
            echo "database issue";
        }
    }
}
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <button><a href="trader_signup.php">Return To signin page</a></button>
    
</body>
</html>