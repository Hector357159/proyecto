
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

$QueryListProducts = "SELECT id_product, product_code, name_product FROM product where f_customer = $opt;";
$result_QueryListProcess = mysqli_query($connection, $QueryListProducts) or trigger_error("Query Failed! SQL: $QueryListProducts - Error: ". mysqli_error($connection), E_USER_ERROR);

echo '<optgroup label="Productos">';
while($res1 = mysqli_fetch_assoc($result_QueryListProcess)){
	
    echo '<option value='.$res1["id_product"].'>'.$res1["product_code"].'  '.$res1["name_product"].'</option>'; 
	
}
echo '</optgroup>';

mysqli_close($connection);
?>