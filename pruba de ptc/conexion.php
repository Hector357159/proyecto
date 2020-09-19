<?php
//servidor
$ser="localhost";
//usuario de base de datos
$user="root";
//contraseña del usuario
$pas="";
//base de datos
$bd="fryline1";
	$conxi=new mysqli($ser,$user,$pas,$bd); 
	
	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}
?>