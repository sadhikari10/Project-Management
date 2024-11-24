<?php $conn = oci_connect('Project_Management', 'Sumit#123', '//localhost/xe'); 
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit; }
   
   // oci_close($conn);
   ?>