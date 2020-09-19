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
$name_process = mysqli_real_escape_string($connection, $_REQUEST['processname']);
$f_product = mysqli_real_escape_string($connection, $_REQUEST['procesos']);
$cost = mysqli_real_escape_string($connection, $_REQUEST['costo']);
$goal = mysqli_real_escape_string($connection, $_REQUEST['goal']);
$id_user = mysqli_real_escape_string($connection, $_REQUEST['usuario']);
$description = mysqli_real_escape_string($connection, $_REQUEST['description']);

$success = false;
 
// attempt insert query execution
$sql = "INSERT INTO process_product_customer (name_process, process_unit_cost, goal, f_product, process_description, createdby,updatedby) VALUES ('$name_process', $cost, $goal,$f_product,'$description',$id_user,$id_user);";
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
		header("Location: http://imagine-studio-solutions.com/production/app/msg/process-inserted.php");
   }else{
		//header("Location: http://imagine-studio-solutions.com/production/app/msg/process-error.php");
   }
?>