<?php 
    session_start();
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $password = md5($pass);
          
		$conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');
 
        $qry="SELECT * FROM ALL_USER WHERE EMAIL = '$email' AND PASSWORD = '$password' ";
        $stid=oci_parse($conn, $qry);
        oci_execute($stid);

        if($row = oci_fetch_assoc($stid)){
            if($row['VERIFY_STATUS']==0){
                header("Location: not_verified.php");
                exit;
            }
            else{
                $_SESSION['tradername'] = $row['FIRST_NAME'];
                $_SESSION['trader_id'] = $row['USER_ID'];
                header('Location: trader_dashboard.php');
                exit;
            }
        }
        else{
            echo "Invalid email or password";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Shop Sphere</title>
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
	
		<!-- Starting of body -->
		<div class="video-background">
			<div class="container">
				<form action="trader_login.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="email">Email</label>
						<input class="form-control" id="email" name="email" placeholder="Enter your Email-address" required>
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input class="form-control" id="password" name="password" type="password" placeholder="Enter your password" required>
					</div>
					<button type="submit" name="submit" class="btn btn-primary">Submit</button>
				</form>
				<div class="kipp">
					<label>Forgot Password?
						<button class="btn btn-primary" onclick="window.location.href='../forgot_password/email.php'">Click here</button>
					</label>
				</div>
				<div class="kipp2">
					<button class="btn btn-primary" onclick="window.location.href='trader_signup.php'">New Here? Sign Up Now</button>
				</div>
			</div>
		</div>

	<!-- Footer -->
	<?php 
		include('../HeadFoot/foot.php'); 
	?>
	</body>
</html>
