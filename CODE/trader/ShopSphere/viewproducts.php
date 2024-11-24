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

		<!-- Header  -->
		<?php
			session_start(); 
			include('head.php');
		?>
	</head>
	<body>
		<?php 
		// Check if shop_id is set in session
			if (isset($_SESSION["shop_id"])) {
				$shop_id = $_SESSION["shop_id"];
				$conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');
 
				if (!$conn) {
					$e = oci_error();
					echo "Sorry, could not connect to database.";
					exit;
				}

				// Fetch products for the given shop_id
				$qry = "SELECT NAME, IMAGE, UNIT_PRICE, STOCK FROM PRODUCT WHERE SHOP_ID = :shop_id";
				$stid = oci_parse($conn, $qry);
				oci_bind_by_name($stid, ':shop_id', $shop_id);
				oci_execute($stid);
				echo '<table border="1">';
				echo '<tr><th>NAME</th><th>IMAGE</th><th>PRICE</th><th>STOCK</th></tr>';
				while ($row = oci_fetch_assoc($stid)) {
					echo '<tr>';
					echo '<td>' . htmlspecialchars($row['NAME']) . '</td>';
					
					// Display the image
					$image_path = htmlspecialchars($row['IMAGE']);
					echo '<td><img src="' . $image_path . '" alt="' . htmlspecialchars($row['NAME']) . '" style="width:100px;height:100px;"></td>';
					echo '<td>$' . htmlspecialchars($row['UNIT_PRICE']) . '</td>';
					echo '<td>' . htmlspecialchars($row['STOCK']) . '</td>';
					echo '</tr>';
				}
				echo '</table>';
				oci_free_statement($stid);
				oci_close($conn);
			} else {
				echo "Shop ID not found in session.";
			}
		?>
		<button class="btn btn-primary"><a href="../trader_dashboard.php">Return to dashboard</a></button>
		<button class="btn btn-primary"><a href="addproducts.php"> addproducts</a></button>
		<button class="btn btn-primary"><a href="edit_delete.php">Edit or Delete</a></button>

		<!-- Footer -->
		<?php
			include('foot.php');
		?>
	</body>
</html>