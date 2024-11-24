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

	<!-- slider -->
	<div>
		<h1 style="text-align:center;">About Us</h1>
	</div>

	<section class="container-slider">
		<div class="slider-wrapper">
			<div class="slider">
				<img id="slide-1" src="../All Images/About us/fruit1.jpg" alt="Shopping items">
				<img id="slide-2" src="../All Images/About us/fruit2.jpg" alt="Shopping items">
				<img id="slide-3" src="../All Images/About us/fruit3.jpg" alt="Shopping items">
				<img id="slide-4" src="../All Images/About us/fruit4.jpg" alt="Shopping items">
			</div>
			<div class="slider-nav">
				<a href="#slide-1"></a>
				<a href="#slide-2"></a>
				<a href="#slide-3"></a>
				<a href="#slide-4"></a>
			</div>
		</div>
		<div class="about-description">
			<p>
				Welcome to ShopSphere, your ultimate destination for all things shopping! At ShopSphere, we believe in creating a seamless and enjoyable shopping experience for our customers. Founded on the principles of quality, variety, and customer satisfaction, our mission is to provide a diverse range of products that cater to every need and preference.
				Our carefully curated collection spans fashion, electronics, home decor, beauty, and much more, ensuring that you find exactly what you're looking for. We pride ourselves on offering exceptional value and top-notch customer service, making your shopping journey as smooth and delightful as possible.
				At ShopSphere, we are more than just a marketplace – we are a community of passionate individuals dedicated to bringing you the best products and the latest trends. Our team works tirelessly to ensure that every item meets our high standards of quality and excellence.
				Thank you for choosing ShopSphere. We are excited to have you with us and look forward to serving you with the best shopping experience.
			</p>
		</div>
	</section>

	<!-- Footer -->
	<?php 
		include('../HeadFoot/foot.php');
	?>


	<script>
	const slider = document.querySelector('.slider');
	let index = 0;

	function autoSlide() {
		index++;
		if (index >= slider.children.length) {
			index = 0;
		}
		slider.scrollTo({
			left: slider.clientWidth * index,
			behavior: 'smooth'
		});
	}
	setInterval(autoSlide, 4000);  // Slide every 4 seconds
	</script>
	</body>
</html>