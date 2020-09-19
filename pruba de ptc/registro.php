<?php
require('conexion.php'); 
if (!$conxi) {
 die('No se ha podido conectar a la base de datos');
}
$nombre = utf8_decode($_POST['txtuser']);

$pasword = utf8_decode($_POST['pasword']);
$pasword2 = utf8_decode($_POST['pasword1']);
$gmail = utf8_decode($_POST['gmail']);
if ($nombre== '' || $pasword== '')
 {
	echo "<script> alert('llenar los espacios en blanco'); </script>";
	header("location: registro2.php");
}elseif ($pasword == $pasword2) {
	



 
//$resultado=mysql_query("SELECT * FROM .$db_table_name." WHERE Email = '".$subs_email."'", $db_connection");
 
/*if (mysql_num_rows($resultado)>0)
{
 
header('Location: Fail.html');
 }*/
 $pasword=hash('sha512', $pasword);

 $query=mysqli_query($conxi,"SELECT * FROM user WHERE gmail= '$gmail'");
 if ( $query == $gmail ) {
 	 
	echo "<script> alert('Gmail ya ocupado'); </script>";
	header("location: registro2.php");
 }else{
 	 $inser_sql= "INSERT INTO user (user , password , type,gmail) VALUES ('$nombre', '$pasword','1','$gmail')";
 if(mysqli_query($conxi, $inser_sql)){

					echo "Insert Exitoso";
					header("location: Login.php");


				}
 
/*if (mysqli_query($conxi, $inser_sql)) {
      echo "New record created successfully";
      header('location: Login.php');
} else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conxi);
}
mysqli_close($conxi);*/
}
}else{
	header("location: registro2.php");
}

?>