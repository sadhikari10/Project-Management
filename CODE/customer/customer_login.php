<?php
    session_start();
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $password = md5($pass);
		include('../Connection/connect.php');
        $qry="SELECT * FROM ALL_USER WHERE EMAIL = '$email' AND PASSWORD = '$password' ";
        $stid=oci_parse($conn, $qry);
        oci_execute($stid);

        if($row = oci_fetch_assoc($stid)){
            $_SESSION['username'] = $row['FIRST_NAME'];
            $_SESSION['customer_id'] = $row['USER_ID'];
            header("Location: ../final cart/index.php");
            exit;
        }
        else{
            echo "Invalid username or password";
        }
    }
?>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Shop Sphere</title>
		<link rel="stylesheet" href="../Css Files/style.css">
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
		<div class="video-background">
			<div class="container">
				<form action="customer_login.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputEmail1">Login</label>
						<input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your Email-address" name="email"><br><br>
						<input type = "password"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your password" name="password">	
					</div>
					<button type="submit" class="btn btn-primary" name="submit">Submit</button><br>
				</form>
				<div class="kipp">
					<label>Forgot Password?
						<button class="btn btn-primary" onclick="window.location.href='../forgot_password/email.php'">Click here</button>
					</label>
				</div>
				<div class="kipp2">
					<button class="btn btn-primary" onclick="window.location.href='customer_signup.php'">New Here? Sign Up Now</button>
				</div>
			</div>
		</div>
		
		<!-- Footer -->
		<?php 
			include('../HeadFoot/foot.php');
		?>
	</body>
</html>