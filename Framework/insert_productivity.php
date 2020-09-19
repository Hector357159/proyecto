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
$id_customer = mysqli_real_escape_string($connection, $_REQUEST['customerbox']);
$id_process = mysqli_real_escape_string($connection, $_REQUEST['procesos']);
$production_count = mysqli_real_escape_string($connection, $_REQUEST['produccion']);
$production_time = mysqli_real_escape_string($connection, $_REQUEST['tiempo']);
$id_user = mysqli_real_escape_string($connection, $_REQUEST['usuario']);
$operational_staff_assigned = mysqli_real_escape_string($connection, $_REQUEST['operarios']);
$comments = mysqli_real_escape_string($connection, $_REQUEST['comments']);

echo $id_customer, ' ', $id_process;

 
// attempt insert query execution
$sql = "INSERT INTO productions (production_time, production_count, operational_staff_assigned, comments, f_process, f_user) VALUES ('$production_time', $production_count, $operational_staff_assigned,'$comments',$id_process,$id_user);";
if(mysqli_query($connection, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
}
 
// close connection
mysqli_close($connection);

header("Location: http://imagine-studio-solutions.com/production/app/report-productivity.php");
?>