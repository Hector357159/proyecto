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
$userid=$_SESSION["Us3r1D"];
$connection = db_connect();
 
// Escape user inputs for security
$id_product = mysqli_real_escape_string($connection, $_REQUEST['id_product']);
$product_code = mysqli_real_escape_string($connection, $_REQUEST['product_code']);
$name_product = mysqli_real_escape_string($connection, $_REQUEST['name_product']);
$f_customer = mysqli_real_escape_string($connection, $_REQUEST['id_customer']);
$notes = mysqli_real_escape_string($connection, $_REQUEST['notes']);

$success = false;
// attempt insert query execution
$sql = "UPDATE product SET product_code = '$product_code', name_product = '$name_product', f_customer = $f_customer,updatedby = $userid,date_updated = CURRENT_TIMESTAMP() where id_product= $id_product;";
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
		header("Location: http://imagine-studio-solutions.com/production/app/msg/product-inserted.php");
   }else{
		header("Location: http://imagine-studio-solutions.com/production/app/msg/product-error.php");
   }
?>