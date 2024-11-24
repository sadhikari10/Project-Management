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
		
		<!-- Header -->
		<?php 
			include('../HeadFoot/head.php');
		?>
	</head>
	<body>
		<form action="registercode.php" method="post" enctype="multipart/form-data">
			<legend><h2>Token</h2></legend>
			<label>Token code</label>
			<input type="text" name="token" placeholder="Enter your token" required><br><br>
			<input class="btn btn-primary" type="submit" value="submit" name="submit">
		</form>
	</body>

	<!-- Footer -->
	<?php 
		include('../HeadFoot/foot.php');
	?>
</html>

<?php 
    if(isset($_POST['submit'])){
        $token = $_POST['token'];

        $conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe');

        if (!$conn) {
            $e = oci_error();
            echo "Connection error: " . htmlentities($e['message']);
            exit();
        }

        $qry = "SELECT VERIFICATION_CODE FROM ALL_USER WHERE VERIFICATION_CODE = :token";
        $stid = oci_parse($conn, $qry);

        if (!$stid) {
            $e = oci_error($conn);
            echo "SQL parse error: " . htmlentities($e['message']);
            exit();
        }

        oci_bind_by_name($stid, ':token', $token);

        if (!oci_execute($stid)) {
            $e = oci_error($stid);
            echo "SQL execution error: " . htmlentities($e['message']);
            exit();
        }

        $row = oci_fetch_assoc($stid);

        if ($row) {
            $store_verification_code = $row['VERIFICATION_CODE'];

            if ($store_verification_code == $token) {
                $update_query = "UPDATE ALL_USER SET VERIFY_STATUS='1' WHERE VERIFICATION_CODE = :token";
                $qry_run = oci_parse($conn, $update_query);

                if (!$qry_run) {
                    $e = oci_error($conn);
                    echo "SQL parse error: " . htmlentities($e['message']);
                    exit();
                }

                oci_bind_by_name($qry_run, ':token', $token);

                if (oci_execute($qry_run)) {
                    header("Location: customer_login.php");
                } else {
                    $e = oci_error($qry_run);
                    echo "SQL execution error: " . htmlentities($e['message']);
                }
            } else {
				echo "<script>alert('Token does not match');
					window.location.href = 'registercode.php';
					</script>";
            }
        } else {
            echo "Token not found";
        }
        oci_free_statement($stid);
       // oci_free_statement($qry_run);
        oci_close($conn);
    }
?>
