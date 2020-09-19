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
$id = mysqli_real_escape_string($connection, $_REQUEST['id']);

   $sql = "DELETE FROM operator_x_workgroup WHERE id_operator_x_workgroup = $id";
   $success = false;
   if (mysqli_query($connection, $sql)) {
      echo "Record deleted successfully";
	   $success = true;
   } else {
      echo "Error deleting record: " . mysqli_error($connection);
	   $success = false;
   }
   mysqli_close($connection);
   if($success){
		header("Location: http://imagine-studio-solutions.com/production/app/msg/deleted-user-from-group.php");
   }else{
		header("Location: http://imagine-studio-solutions.com/production/app/msg/deleted-user-from-group-error.php");
   }
   
?>
