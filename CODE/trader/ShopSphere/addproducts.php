<?php 
	session_start();
	if (isset($_POST['add_product'])) {
		$name = trim($_POST["name"]);
		$description = trim($_POST["description"]);
		$price = trim($_POST["price"]);
		$stock = trim($_POST["stock"]);
		$minimum_order = trim($_POST["minimun_order"]);
		$maximum_order = trim($_POST["maximun_order"]);
		$expire_date = trim($_POST["expire_date"]);
		$manufacturing_date = trim($_POST["manufacturing_date"]);

		// Image upload handling
		$filename = $_FILES["uploadfile"]["name"];
		$tempname = $_FILES["uploadfile"]["tmp_name"];
		$folder = "image/" . $filename;
		move_uploaded_file($tempname, $folder);

		$conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');


		// Retrieve the user_id from session
		$user_id = $_SESSION['trader_id'];

		// Retrieve the shop_id for the trader
		$shop_id_query = "SELECT SHOP_ID FROM SHOP WHERE USER_ID = :user_id";
		$stid = oci_parse($conn, $shop_id_query);
		oci_bind_by_name($stid, ':user_id', $user_id);
		oci_execute($stid);
		
		$row = oci_fetch_array($stid, OCI_ASSOC);
		$shop_id = $row['SHOP_ID'];

		$_SESSION["shop_id"] = $row['SHOP_ID'];

		// Insert product details into the product table
		$qry = "INSERT INTO PRODUCT (NAME, DESCRIPTION, UNIT_PRICE, STOCK, MINIMUM_ORDER, MAX_ORDER, EXPIRE_DATE, MANUFACTURING_DATE, IMAGE, SHOP_ID)
				VALUES (:name, :description, :price, :stock, :minimum_order, :maximum_order, TO_DATE(:expire_date, 'YYYY-MM-DD'), TO_DATE(:manufacturing_date, 'YYYY-MM-DD'),  :folder, :shop_id)";
		
		$stid = oci_parse($conn, $qry);

		// Binding parameters
		oci_bind_by_name($stid, ':name', $name);
		oci_bind_by_name($stid, ':description', $description);
		oci_bind_by_name($stid, ':price', $price);
		oci_bind_by_name($stid, ':stock', $stock);
		oci_bind_by_name($stid, ':minimum_order', $minimum_order);
		oci_bind_by_name($stid, ':maximum_order', $maximum_order);
		oci_bind_by_name($stid, ':expire_date', $expire_date);
		oci_bind_by_name($stid, ':manufacturing_date', $manufacturing_date);
		oci_bind_by_name($stid, ':folder', $folder);
		oci_bind_by_name($stid, ':shop_id', $shop_id);

		// Executing the query
		$stid1 = oci_execute($stid);
		if($stid1){
			echo "<script>
                alert('Product added successfully.');
                </script>";
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
			include('head.php');
		?>
	</head>
	<body>
		<section>
			<form action="addproducts.php" method="post" enctype="multipart/form-data">
				<h3>Product Info</h3>
				<label>Product Name <span>*</span></label><br>
				<input type="text" name="name" placeholder="Product name" required ><br><br>

				<label>Product Details <span>*</span></label><br>
				<textarea name="description" placeholder="Add product details" required></textarea><br><br>

				<label>Product Price <span>*</span></label><br>
				<input type="number" name="price" placeholder="Product price" required><br><br>

				<label>Stock <span>*</span></label><br>
				<input type="number" name="stock" placeholder="Stock" required><br><br>

				<label>Minimum Order<span>*</span></label><br>
				<input type="number" name="minimun_order" placeholder="Minimum Order" required><br><br>

				<label>Image</label>
				<input class="btn btn-primary" type="file" name="uploadfile" required><br><br>

				<label>Expire Date</label>
				<input type="date" name="expire_date" placeholder="Expire Date"><br><br>

				<label>Maximum Order<span>*</span></label><br>
				<input type="number" name="maximun_order" placeholder="Maximum Order" required><br><br>
				
				<label>Manufactured Date</label>
				<input type="date" name="manufacturing_date" placeholder="Manufacturing Date"><br><br>

				<button type="submit" class="btn btn-primary" name="add_product" value="submit">Add Product</button>
				
			</form>
			<button class="btn btn-primary"><a href="../trader_dashboard.php">Return to dashboard</a></button>
		</section>

		<?php 
			include('foot.php');
		?>
	</body>
</html>