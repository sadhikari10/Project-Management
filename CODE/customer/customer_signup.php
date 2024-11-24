<!DOCTYPE html>
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

		<!-- Header  -->
		<?php 
			include('../HeadFoot/head.php');
		?>
	</head>
	<body style="background: radial-gradient(#fff,#F5F5DC)">
		<div class="video-background">
			<div class="container">
				<form action="customer_code.php" method="post" enctype="multipart/form-data">
					<legend><h1>Welcome</h1></legend>
					<div class="form-group">
						<div class="nested-div">
							<label><i class="fa fa-user icon"></i>Firstname</label>
							<input type="text" name="firstname" placeholder="Enter your first name" required>
						</div><br>
						<div class="nested-div">
							<label><i class="fa fa-user icon"></i>Lastname</label>
							<input type="text" name="lastname" placeholder="Enter your last name" required>
						</div><br>
					</div>
					<div class="box-container">
						<div class="form-group">
							<label><i class="fa fa-lock icon"></i>Password</label>
							<input type="password" name="password" placeholder="Enter your password" required>
						</div><br>
						<div class="form-group">
							<label><i class="fa fa-envelope icon"></i>Email</label>
							<input type="email" name="email" placeholder="Enter your email" required>
						</div><br>
						<div class="form-group">
							<label><i class="fa fa-phone icon"></i>Phone_no</label>
							<input type="tel" name="contact_number" placeholder="Enter your contact number" required>
						</div><br>
						<div class="form-group">
							<label><i class=""></i>Address</label>
							<input type="tel" name="address" placeholder="Enter your address" required>
						</div><br>
					</div>
					<div class="sam">
						<label for="gender-button"><h4><i class="fa fa-venus-mars"></i> Gender</h4></label>
						<div class="dropdown">
							<button id="gender-button" type="button">Select Gender</button>
							<div class="dropdown-content" id="gender-dropdown">
								<label><input type="radio" id="male" name="gender" value="male"> Male</label>
								<label><input type="radio" id="female" name="gender" value="female"> Female</label>
								<label><input type="radio" id="other" name="gender" value="other"> Other</label>
							</div>
						</div>
					</div><br>
					<div class="form-group">
						<label><i class="fa fa-image icon"></i>Upload Your Picture</label>
						<input type="file" name="uploadfile" required>
					</div><br>
					<div class="terms-container">
						<input type="checkbox" id="terms" name="terms" required>
						<label for="terms"><a href="#" id="terms-link">Terms and Conditions</a></label>
					</div><br>
					<div class="register-container">
						<input class="btn btn-primary" type="submit" value="Register" name="submit">
					</div><br>
				</form>
				<div class="kipp">
					<label>Already have an account?
					<button class="btn btn-primary" onclick="window.location.href='customer_login.php'"> Sign In </button></label>
				</div>
			</div> 
			<!-- Terms and Conditions Modal -->
			<div id="termsModal" class="modal">
				<div class="modal-content">
					<span class="close">&times;</span>
					<h2>Terms and Conditions</h2>
					<p>By clicking on Terms and Conditions you agree to share your personal information
						with ShopSphere website. Your data will be held and be modified by you and admin panel only.
					</p>
				</div>
			</div>
		</div>

		<script>
			document.getElementById('gender-button').onclick = function() {
				var dropdown = document.getElementById('gender-dropdown');
				if (dropdown.style.display === "block") {
					dropdown.style.display = "none";
				} else {
					dropdown.style.display = "block";
				}
			}

			document.getElementById('terms-link').onclick = function(event) {
				event.preventDefault();
				document.getElementById('termsModal').style.display = 'block';
			}

			document.getElementsByClassName('close')[0].onclick = function() {
				document.getElementById('termsModal').style.display = 'none';
			}

			window.onclick = function(event) {
				if (event.target == document.getElementById('termsModal')) {
					document.getElementById('termsModal').style.display = 'none';
				}
			}
		</script>
	</body>
	<?php 
		include('../HeadFoot/foot.php');
	?>
</html>