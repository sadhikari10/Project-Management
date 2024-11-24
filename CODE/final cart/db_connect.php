<?php
$username = 'Project_Management';
$password = 'Sumit#123';
$connectionString = '//localhost/xe';

$conn = oci_connect($username, $password, $connectionString);

if (!$conn) {
    $error = oci_error();
    die("Connection failed: " . $error['message']);
}
?>
