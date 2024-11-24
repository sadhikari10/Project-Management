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
        <form action="enter_token.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <legend><h2>Enter token</h2></legend>
                <label>Token</label>
                <input type="text" name="token" placeholder="token" required><br><br>
                <input type="submit" value="submit" name="submit">
            </fieldset>
        </form>

        <?php 
            session_start();
            if(isset($_POST['submit'])){
                if(isset($_SESSION['reset_email'])){
                    $email = $_SESSION['reset_email'];
                    $token = $_POST['token'];
                    $stored_token = $_SESSION['token'];
                    $conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');
 
                    if($stored_token == $token){
                        $qry = "UPDATE ALL_USER SET VERIFICATION_CODE = '$token' WHERE EMAIL = '$email'";
                        $stid = oci_parse($conn,$qry);
                        $stid1 = oci_execute($stid);
                        if($qry){
                            unset($_SESSION['token']);
                            header("Location:reset_password.php");
                            exit();
                        }
                        else{
                            echo "Failed to update token";
                        }
                    }
                    else{
                        echo "Verification code does not match";
                    }
                
                }
            }
        ?>
    </body>
    <?php 
        include('../HeadFoot/foot.php');
    ?>
</html>