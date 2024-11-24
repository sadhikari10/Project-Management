<?php
    session_start();
    if(isset($_SESSION['customer_id']) && $_SESSION['customer_id'] != null ){
        header("Location:../final cart/index.php");
    }
    else{
    }
?>

<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Shop Sphere</title>
		<link rel="stylesheet" href="../Css Files/style.css">
		<link rel="stylesheet" href="../Css Files/adminoperations.css">
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
		<?php
			include('../Connection/connect.php');
			$qry="SELECT * FROM PRODUCT";
			$stid=oci_parse($conn, $qry);
			oci_execute($stid);
			echo "<div class = 'firstcontainer container'>";
			while($row=oci_fetch_assoc($stid)){
				echo ' <div class="card product">';
				echo ' <div class="productInfo">';
				echo '<p>';
				echo '<img src=" ../trader/ShopSphere/' . $row['IMAGE'] . '" alt="image" style="width:200px;height:200px;">';
				echo '<p>'.$row['NAME'].'</p>';
				echo '<p> $'.$row['UNIT_PRICE'].'</p>';
				echo '</div>';
				echo '</div>';
			}
			echo '</div>';
			oci_close($conn);
		?>
	</body>

	<!-- Footer -->
	<?php	
		include('../HeadFoot/foot.php');
	?>
</html>

