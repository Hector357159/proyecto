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
$id=mysqli_real_escape_string($connection, $_REQUEST['id_user']);
$user_name = mysqli_real_escape_string($connection, $_REQUEST['first_name']);
$user_last_name = mysqli_real_escape_string($connection, $_REQUEST['last_name']);
$user_email = mysqli_real_escape_string($connection, $_REQUEST['user_email']);
$f_User_type = mysqli_real_escape_string($connection, $_REQUEST['users_typebox']);
$notes = mysqli_real_escape_string($connection, $_REQUEST['notes']);
$user_password = mysqli_real_escape_string($connection, $_REQUEST['upassword']);
$user_gender = mysqli_real_escape_string($connection, $_REQUEST['gender']);
$f_created_by = $_SESSION["Us3r1D"];
$success = false;
// attempt insert query execution
$sql = "UPDATE users SET user_name='$user_name', user_last_name='$user_last_name', user_email='$user_email', f_User_type=$f_User_type, notes='$notes', user_password='$user_password', user_gender='$user_gender' WHERE id_user=$id;";
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
		header("Location: http://imagine-studio-solutions.com/production/app/msg/usr-updated.php");
   }else{
		header("Location: http://imagine-studio-solutions.com/production/app/msg/usr-update-error.php");
   }
?>