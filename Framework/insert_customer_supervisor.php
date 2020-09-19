<?php
session_start();
if(!isset($_SESSION["Us3r1D"])){
		header('Location: login.php');
}
header('Content-Type: text/html; charset=utf-8');
$userid=$_SESSION["Us3r1D"];
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
$f_customer = mysqli_real_escape_string($connection, $_REQUEST['id_customer']);
$f_supervisor_user = mysqli_real_escape_string($connection, $_REQUEST['supervisor']);

$success = false;
// attempt insert query execution
$sql = "INSERT INTO supervisor_customer (f_customer, f_supervisor_user,f_assignedby) VALUES ('$f_customer', '$f_supervisor_user','$userid');";
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
		header("Location: http://imagine-studio-solutions.com/production/app/msg/supervisor-customer-inserted.php");
   }else{
		//header("Location: http://imagine-studio-solutions.com/production/app/msg/supervisor-customer-error.php");
   }
?>