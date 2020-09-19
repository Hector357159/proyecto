<?php 
include'../conexion.php';
	session_start();
    $Dsalida = $_POST['Dsalida'];
	$Dentrada = $_POST['Dentrada'];
	$Psalida = $_POST['Psalida'];
	$Pentrada = $_POST['Pentrada'];
	$Hsalida = $_POST['Hsalida'];
	$Hentrada = $_POST['Hentrada'];
	$Ttotal = $_POST['Ttotal'];
	$presio = $_POST['presio'];
	$aerolinea = $_POST['aerolinea'];
	$Nvoleto = $_POST['Nvoleto'];
	$escala1 = $_POST['escala1'];
	//escala 1
	$Dsalida1 = $_POST['Dsalida1'];
	$Dentrada1 = $_POST['Dentrada1'];
	$Psalida1 = $_POST['Psalida1'];
	$Pentrada1 = $_POST['Pentrada1'];
	$Hsalida1 = $_POST['Hsalida1'];
	$Hentrada1 = $_POST['Hentrada1'];
	$Ttotal1 = $_POST['Ttotal1'];

	$aerolinea1 = $_POST['aerolinea1'];
	$Nvoleto1 = $_POST['Nvoleto1'];
	
 

    /*Rcar;php;DetallesCatalogoCliente.php
	$queryPago = "SELECT tbusuarios.ID_Usuario, tbusuarios.Nombre, tbusuarios.Apellido, tbusuarios.numeroIdentidad, tbusuarios.licencia, tbusuarios.Tlicencia, tbusuarios.Telefono, tbusuarios.email, tbusuarios.direccion, tbusuarios.ID_Departamento, tbusuarios.ID_Municipio, tbusuarios.FechaNac, tbusuarios.DateNewRow, tbdatospago.Tarjeta, tbdatospago.FechaVencimiento, tbdatospago.CVV, tbdatospago.NoCuenta FROM `tbusuarios` INNER JOIN `tbvehiculo` ON tbusuarios.ID_Usuario = tbvehiculo.ID_Usuario INNER JOIN tbdatospago ON tbdatospago.ID_Usuario = tbusuarios.ID_Usuario WHERE tbvehiculo.ID_Vehiculo = '{$_SESSION['id']}'";
                                        $resultPago = mysqli_query($cn, $queryPago);*/                  
		
	if ($escala1 == "escala_11"	) {
	
	$sqlTboleto = "INSERT into tbboleto (DsalidaV,DllegadaV ,Psalida,Pentrada,Hsalida,Hentrada,Tiempo,Presio,Aerolinia,Nvuelo,reserva)
	VALUES('$Dsalida','$Dentrada','$Psalida ','$Pentrada','$Hsalida','$Hentrada','$Ttotal','$presio','$aerolinea','$Nvoleto','NO')"or die(mysql_error());//inserta los valores  a la vase de datos
	
	$comprobar= mysqli_query($conxi,$sqlTboleto);//comprueba la informacion anterior mente enviada 

	if ($comprobar == 1) {//si el valor es 1 o true puede sergir insertando la informacion
	 $iD="SELECT MAX(ID_boleto) FROM tbboleto";
	
	$sqlTescala1 = "INSERT into tbescala (DsalidaV,DllegadaV,Lsalida,Lentrada,Hsalida,Hentrada,Tiempo,precio,Aerolinia,Nbuelo,reserva,TBESCALA)
	VALUES ('$Dsalida1','$Dentrada1','$Psalida1 ','$Pentrada1','$Hsalida1','$Hentrada1','$Ttotal1','$presio','$aerolinea1','$Nvoleto1','NO','$iD')"or die(mysql_error());
	echo $sqlTescala1;
	 
	 if (mysqli_query($conxi,$sqlTescala1)) {
	    	header(	"Location: ../ingresar_vuelo.php");
	    }   

	}
}else{
	$sqlTboleto = "INSERT into tbboleto (DsalidaV,DllegadaV ,Psalida,Pentrada,Hsalida,Hentrada,Tiempo,Presio,Aerolinia,Nvuelo,reserva)
	VALUES('$Dsalida','$Dentrada','$Psalida ','$Pentrada','$Hsalida','$Hentrada','$Ttotal','$presio','$aerolinea','$Nvoleto', 'NO')"or die(mysql_error());
	
	if ($comprobar= mysqli_query($conxi,$sqlTboleto)) {
		header(	"Location: ../ingresar_vuelo.php");
	}
}
	
	if ($escala1 == "escala_22") {
		header(	"Location: ../reservas.php");

	}
	if ($escala1 == "escala_33") {
		header("location: logoat.php");
	}




//$query = "INSERT INTO tbvehiculo (`ID_Usuario`, Matricula, Marca, Modelo, rkm, rmi, Tcombustible, Tmotor, Tvehiculo, Poliza, Tlimite, CostoDia, year, puerta, descripcion, aire, Estado) VALUES('{$id_user}','{$matricula}', '{$marca}', '{$modelo}', '{$rendimientoKm}', '{$rendimientoMi}', '{$combustible}', '{$marcha}', '{$tipoVehiculo}', '{$poliza}', '{$tiempoLimite}', '{$costoVehiculo}', '{$year}', '{$puerta}', '{$descripcion}', '{$aire}', '{$estado}')";

	//if(mysqli_query($cn, $query)){

		//		header("location: ../registrV.php");

	//}
	
	