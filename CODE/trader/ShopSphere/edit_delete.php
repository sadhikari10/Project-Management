<?php 
	session_start();
	$conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');


	if (!$conn) {
		$e = oci_error();
		echo htmlentities($e['message']);
		exit;
	}

	if (isset($_GET['deleteid'])) {
		$id = $_GET['deleteid'];
		$qry = "DELETE FROM PRODUCT WHERE PRODUCT_ID = :product_id";
		$stid = oci_parse($conn, $qry);
		oci_bind_by_name($stid, ':product_id', $id);
		oci_execute($stid);
		if ($stid) {
			echo "<script>
                alert('Product deleted successfully.');
                </script>";
			//exit();
		} else {
			$e = oci_error($stid);
			echo htmlentities($e['message']);
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
		<?php 
			include('head.php');
		?>
	</head>
	<body>
		<section>
			<?php
			if(isset($_SESSION['shop_id'])){
				$shop_id = $_SESSION['shop_id']; 
				$qry = "SELECT p.* FROM PRODUCT p JOIN SHOP s ON p.SHOP_ID = s.SHOP_ID WHERE s.SHOP_ID = :shop_id";
				$stid = oci_parse($conn, $qry);
				oci_bind_by_name($stid, ':shop_id', $shop_id);
				oci_execute($stid);
				echo '<table border=1>';
				echo '<th>Name </th>';
				echo '<th>Stock </th>';
				echo '<th>Unit_Price </th>';
				echo '<th>EDIT Delete </th>';
				while ($row = oci_fetch_assoc($stid)) {
					echo '<tr>';
					echo '<td>' . $row['NAME'] . '</td>';
					echo '<td>' . $row['STOCK'] . '</td>';
					echo '<td>' . $row['UNIT_PRICE'] . '</td>';
					echo '<td>';
					echo "<button><a href='updatedata.php?updateid=" . $row['PRODUCT_ID'] . "'>Update</a></button>";
					echo "<button><a href='?deleteid=" . $row['PRODUCT_ID'] . "'>Delete</a></button>";
					echo '<td>';
					echo '</tr>';
				}
				echo '</table>';
			}
			?>
		<button class="btn btn-primary"><a href="../trader_dashboard.php">Return to dashboard</a></button>
		<button class="btn btn-primary"><a href="viewproducts.php"> View Products</a></button>
		<button class="btn btn-primary"><a href="addproducts.php">Add products</a></button>
		</section>

	<?php 
		include('foot.php');
	?>
	</body>
</html>
