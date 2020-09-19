<?php
 // Reportamos Errores 
 
session_start();

header('Content-Type: text/html; charset=utf-8');
clearstatcache(); 
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

$opt = $_GET['opt'];

$QueryListProcess = "Select CONCAT(p.name_product,' ', ppc.name_process) as name_process,ppc.id_process_product_customer as id_process 
from process_product_customer as ppc, customers as c, product as p
where p.f_customer = c.id_customer and p.id_product = ppc.f_product and c.id_customer =$opt;";
$result_QueryListProcess = mysqli_query($connection, $QueryListProcess) or trigger_error("Query Failed! SQL: $QueryListProcess - Error: ". mysqli_error($connection), E_USER_ERROR);

while($res1 = mysqli_fetch_assoc($result_QueryListProcess)){
    echo '<option value='.$res1["id_process"].'>'.$res1["name_process"].'</option>';
}

mysqli_close($connection);
?>