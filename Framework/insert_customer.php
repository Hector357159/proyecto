<?php
session_start();

header('Content-Type: text/html; charset=utf-8');

// Verificamos la version de PHP del servidor
if (version_compare(phpversion(), '5.1.0', '<') == true) {
	exit('PHP5.1+ Required');
} 
	
// VAMOS A TRAER LA INFORMACION DE CONFIG UNA SOLA VEZ 'require_once'
if (file_exists('/home/irvincabezas/public_html/production/app/system/config.php')) {
	require_once('/home/irvincabezas/public_html/production/app/system/config.php');
}else{
	header("Location: http://imagine-studio-solutions.com/production/app/500.html");
}


// COMENZAMOS EL SISTEMA
require_once(DIR_DATABASE . 'db.php');

$connection = db_connect();
 
// Escape user inputs for security
$customer_name = mysqli_real_escape_string($connection, $_REQUEST['customer_name']);
$customer_address = mysqli_real_escape_string($connection, $_REQUEST['customer_address']);
$customer_number = mysqli_real_escape_string($connection, $_REQUEST['customer_number']);
$f_country = mysqli_real_escape_string($connection, $_REQUEST['country']);
$notes = mysqli_real_escape_string($connection, $_REQUEST['notes']);
$success = false;
// attempt insert query execution
$sql = "INSERT INTO customers (customer_name, customer_address, customer_number, f_country, notes) VALUES ('$customer_name', '$customer_address', '$customer_number',$f_country,'$notes');";
if(mysqli_query($connection, $sql)){
    echo "Records added successfully.";
	$success =true;
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
	$success =false;
}
 
// close connection
mysqli_close($connection);

if($success){
		header("Location: http://imagine-studio-solutions.com/production/app/msg/customer-inserted.php");
   }else{
		header("Location: http://imagine-studio-solutions.com/production/app/msg/customer-error.php");
   }
?>