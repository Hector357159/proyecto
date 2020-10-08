<?php 
if (empty($_REQUEST['id'])) {
	header( "location: ../indexAdmin.php");
}else{
 
 include('../conexion.php');

$id= $_REQUEST['id'];
$delete="DELETE  FROM user where id_usuario = $id " or die(mysql_error());
if (mysqli_query($conxi,$delete)) {
	echo "<script> alert('eliminacion realizada corecta mente'); </script>";
				header("location: ../indexAdmin.php");
}

}
 ?>