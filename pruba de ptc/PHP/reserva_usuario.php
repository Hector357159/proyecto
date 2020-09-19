<?php 	
if (empty($_REQUEST['is'])) {
	header( "location: ../reservasuser.php");
}else{
 
 include('../conexion.php');
 session_start();
$iduser = $_SESSION['user'];

$id= $_REQUEST['is'];


$boleto="SELECT tbboleto.ID_boleto,tbboleto.DsalidaV,tbboleto.DllegadaV,tbboleto.Psalida,tbboleto.Pentrada,tbboleto.Hsalida,tbboleto.Hentrada,tbboleto.Tiempo,tbboleto.Presio,tbboleto.Aerolinia,tbboleto.Nvuelo,tbboleto.reserva,tbescala.ID_boleto,tbescala.DsalidaV,tbescala.DllegadaV,tbescala.Lsalida,tbescala.Lentrada,tbescala.Hsalida,tbescala.Hentrada,tbescala.Tiempo,tbescala.precio,tbescala.Aerolinia,tbescala.Nbuelo,tbescala.reserva FROM tbboleto INNER JOIN tbescala on tbboleto.ID_boleto = tbescala.ID_boleto WHERE tbboleto.ID_boleto = '$id'" or die(mysql_error());//consulta a mysql los datos que se riquieren
                                              $resultadoboleto = mysqli_query($conxi,$boleto); //consulta a la vase de datos si funciona 
                                              if($row = mysqli_fetch_array($resultadoboleto)){
                                              
                                              	$user="SELECT * FROM user where id_usuario = '$iduser'";
                                              	$resultadouser = mysqli_query($conxi,$user);
                                              	$rowp = mysqli_fetch_array($resultadouser);
                                              	
                                              	
                                              	$INSERTAR = "INSERT into id_reserva (ID_boleto,id_usuario,DsalidaV,DllegadaV,Psalida,Pentrada,Nvuelo,Presio)VALUES('$row[0]','$rowp[0]','$row[1]','$row[2]','$row[15] ','$row[16]','$row[10]','$row[8]')"or die(mysql_error());
                                              	
                                              	if ($modificar=mysqli_query($conxi,$INSERTAR)); {
                                              		$actualisarV="UPDATE tbboleto set reserva = 'SI'  WHERE ID_boleto='$id'"  or die(mysql_error());
                                              		
                                              		

                                              		if ($modificasio=mysqli_query($conxi,$actualisarV)) {
                                              			$actualisarE="UPDATE tbescala set reserva = 'SI'  WHERE ID_boleto='$id'"  or die(mysql_error());
                                              			if ($modificasioE=mysqli_query($conxi,$actualisarE)) {
                                              				header( "location: ../mireserva.php");
                                              			}
                                              		}
                                              		
                                              	}
                                              	

                                              }
                                              
}



 ?>