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
		<form action="email.php" method="post" enctype="multipart/form-data">
			<legend><h2>Reset Password</h2></legend>
			<label for="exampleInputEmail1">Email</label>
			<input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter your Email-address" name="email">
			<input class="btn btn-primary" type="submit" value="submit" name="submit">
		</form>

		<?php 
			session_start();
			use PHPMailer\PHPMailer\PHPMailer;
			use PHPMailer\PHPMailer\SMTP;
			use PHPMailer\PHPMailer\Exception;
			require '../vendor/autoload.php';
			function sendemail($name,$email,$token){
				$mail = new PHPMailer(true);
				// try{
					// $mail-> SMTPDebug = SMTP::DEBUG_SERVER;
				$mail -> isSMTP(); 
				$mail -> SMTPAuth = true;

				$mail -> Host = "smtp.gmail.com";
				$mail -> Username = "sushantadhikari70@gmail.com";
				$mail -> Password = "ptsp vnot tvfq qcnr";
				$mail -> SMTPSecure = "tls";
				$mail -> Port = 587;

				$mail -> setFrom("sushantadhkari70@gmail.com",$name);
				$mail -> addAddress($email);
				
				$mail -> isHTML(true);
				$mail ->Subject = "Chnage your password in Shopsphere";

				$email_template = "
				<h2>Reset your Shopshere password.</h2>
				<h5>Reset your password with the given token.</h5>
				<p>$token</p>
				<br><br>
				
				";
				$mail -> Body=$email_template;
				$mail-> send();
				//echo "Message has ben sent";
				// }catch(Exception $e){
				//     echo "Message could not be sent. Maile Error: {$mail -> ErrorInfo}";

				// }
			}

			if(isset($_POST['submit'])){
				$email = $_POST['email']; 
				$token = rand(10000,99999);
				$conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');

				$qry = "SELECT VERIFICATION_CODE FROM ALL_USER WHERE EMAIL = '$email'";
				$stid = oci_parse($conn,$qry);
				$stid1 = oci_execute($stid);
				$row=oci_fetch_assoc($stid);

				if($row>0){
					$sql_update_token = "UPDATE ALL_USER SET TOKEN = '$token' WHERE EMAIL = '$email'";
					$qry_update = oci_parse($conn,$sql_update_token);
					$run_qry = oci_execute($qry_update);
					$_SESSION['reset_email'] = $email;
					sendemail("$name","$email","$token");
					$_SESSION['token'] = $token;
					header("Location: enter_token.php");
				}
				else{
					echo "Email does not exist";
				}
			}
		?>
		
		<?php
			include('../HeadFoot/foot.php');
		?>
	</body>

</html>