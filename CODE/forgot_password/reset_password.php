<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="style.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		
        <!-- Header -->
        <?php 
            include('../HeadFoot/head.php'); 
        ?>
    </head>
    <body style="background: radial-gradient(#fff,#F5F5DC)">
        <form action="reset_password.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend><h2>Reset Password</h2></legend>
                <label>Password</label>
                <input type="password" name="password" placeholder="Enter your password" required><br><br>
                <label>Re-enter your password</label>
                <input type="password" name="re_password" placeholder="Re enter your password" required><br><br>
                <input type="submit" value="Change Password" name="submit">
            </fieldset>
        </form>

        <?php 
            session_start();
            $email = $_SESSION['reset_email'];
            if(isset($_POST['submit'])){
                $password = $_POST['password'];
                $_re_password = $_POST['re_password'];
                if($password != $_re_password){
                    echo "Password does not match with each other. Check your spelling";
                }
                else{
                    $conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');
 
                    $password = md5($password); 
                    $qry = "UPDATE ALL_USER SET PASSWORD = '$password' WHERE EMAIL = '$email'";
                    $stid = oci_parse($conn,$qry);
                    $stid1 = oci_execute($stid);
                    if($stid1){
                        echo "<script>
                        alert('Your password has been reset successfully.');
                        window.location.href='../customer/customer_login.php';
                        </script>";  
                    }
                    else{
                        echo "password could not be reset";
                    }
                }
            }
        ?>
    </body>
    <?php 
        include('../HeadFoot/foot.php');
    ?>
</html>