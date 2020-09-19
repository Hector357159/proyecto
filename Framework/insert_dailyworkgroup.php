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

$f_supervisor_user = mysqli_real_escape_string($connection, $_REQUEST['f_supervisor_user']);
$workgroup_name = mysqli_real_escape_string($connection, $_REQUEST['group_name']);

$success_p1 = false;
$success_p2 = false;

$id_daily_workgroup = 0;

// attempt insert query execution
$sql = "INSERT INTO daily_workgroup (workgroup_name, f_user_owner) VALUES ('$workgroup_name', '$f_supervisor_user');";
$query_IDDailyGroup = "select id_daily_workgroup from daily_workgroup where workgroup_name = '$workgroup_name' and f_user_owner=$f_supervisor_user order by date_created DESC limit 1;"; //check this security issue
if(mysqli_query($connection, $sql)){
    echo "Records added successfully.";
	$success_p1 =true;
	$resultIDDailyGroup = mysqli_query($connection, $query_IDDailyGroup) or trigger_error("Query Failed! SQL: $query_IDDailyGroup- Error: ". mysqli_error($connection), E_USER_ERROR);
	$res1 = mysqli_fetch_assoc($resultIDDailyGroup);
	$id_daily_workgroup = $res1["id_daily_workgroup"];
	foreach ($_REQUEST['id_operarios'] as $selected_operator) {
		$sql2 = "INSERT INTO operator_x_workgroup (f_group, f_operator_user) VALUES($id_daily_workgroup,$selected_operator);"; 
		if(mysqli_query($connection, $sql2)){
			echo "Records added successfully.";
			$success_p2 =true;
		} else{
			echo "ERROR: Could not able to execute $sql2. " . mysqli_error($connection);
			$success_p2 =false;
			//delete the group
			//rollback first commit
		}
	}
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connection);
	$success_p1 =false;
	$success_p2 = false;
	
}
	
 
// close connection
mysqli_close($connection);

if($success_p1 && $success_p2){
		header("Location: http://imagine-studio-solutions.com/production/app/msg/supervisor-customer-inserted.php");
   }else{
		header("Location: http://imagine-studio-solutions.com/production/app/msg/supervisor-customer-error.php");
   }
?>