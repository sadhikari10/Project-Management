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

		<!-- header  -->	
		<?php 
			include('../HeadFoot/head.php');
		?>
	</head>
	<body style="background: radial-gradient(#fff,#F5F5DC)">
		<div class="row">
			<div class="col-2">
				<h1>Come Shop with us</h1>
				<p>We have the best products to sell in our Ecommerce mart.</p>
				<a href="" class="btn">Explore Now &#8594;</a>
			</div>
			<div class="col-2">
				<img src="../All Images/images/background-image.jpg">
			</div>
		</div>

		<!-- Contact-Us -->
		<section class="contact">
			<div class="contact-content">
				<h2>Contact Us</h2>
				<p> Welcome to ShopSphere, your ultimate destination for all things shopping! At ShopSphere, we believe in creating a seamless and enjoyable shopping experience for our customers. Founded on the principles of quality, variety, and customer satisfaction, our mission is to provide a diverse range of products that cater to every need and preference.
					Our carefully curated collection spans fashion, electronics, home decor, beauty, and much more, ensuring that you find exactly what you're looking for. We pride ourselves on offering exceptional value and top-notch customer service, making your shopping journey as smooth and delightful as possible.
					At ShopSphere, we are more than just a marketplace – we are a community of passionate individuals dedicated to bringing you the best products and the latest trends. Our team works tirelessly to ensure that every item meets our high standards of quality and excellence.
					Thank you for choosing ShopSphere. We are excited to have you with us and look forward to serving you with the best shopping experience.
				</p>
			</div>
			<div class="contact-container">
				<div class="contactInfo">
					<div class="contact-box">
						<div class="contact-icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
							<div class="contact-text">
								<h3>Address</h3>
								<p>Thapathali,Kathmandu</p>
							</div>
						</div>
						<div class="contact-box">
						<div class="contact-icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
							<div class="contact-text">
								<h3>Phone</h3>
								<p>9840032900</p>
							</div>
						</div>
						<div class="contact-box">
						<div class="contact-icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
							<div class="contact-text">
								<h3>Email</h3>
								<p>shopsphere99@gmail.com</p>
						</div>
				</div>
			</div>
			<div class="contactform">
				<form action="">
					<h2>Send Message</h2>
					<div class="inputbox">
						<input type="text" name="" required>
						<span>Full Name</span>
					</div>
					<div class="inputbox">
						<input type="text" name="" required>
						<span>Email</span>
					</div>
					<div class="inputbox">
						<textarea required></textarea>
						<span>Type your Message....</span>
					</div>
					<div class="inputbox">
						<input type="submit" name="" value="Send">
					</div>
				</form>
			</div>
		</section>

		<!-- footer -->
		<?php 
			include('../HeadFoot/foot.php');
		?>
	</body>
</html>

