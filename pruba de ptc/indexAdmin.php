<?php 
 //Incluir la conexion para consultar la base de datos

        include('Conexion.php');
        



        //Inicio de session

        session_start();



        //Validacion para que solo se pueda iniciar session por el login y no por url

        if(isset($_SESSION['user'])){



        }else{

            header("location: login.php");

        }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<?php
	 include 'menu/menuadmin.php'; 

	 ?>
     
</head>
<body background="img/descarga.jpg">

        
                   
                            
                                <div class="table-responsive manage-table">
                                        <table class="table" cellspacing="14">
                                            <thead>
                                                <tr>
                                    <th><?php echo $datosdeuser; ?></th>
                                    <th><?php echo $gmail; ?></th>
                                    <th></th>
                                    
                                    <th></th> 
                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                    $query=mysqli_query($conxi,"SELECT * FROM user WHERE Type='1'");
                                    while($array=mysqli_fetch_array($query)){
                                 ?>
                                <tr>
                                    <td><?php echo $array[1]; ?></td>
                                    <td><?php echo $array[4] ;?></td>
                                   
                                    <td><a href="PHP/deleteuser.php?id=<?php echo $array[0];?>"><button class="btn btn-block btn-danger" id="btnDelete"><?php echo $eliminar; ?></button></td></a>
                                </tr>
                                <?php 
                                    }
                                 ?>
                                            </tbody>
                                        </table>
                                </div>
                         
     
    
	
</body>
</html>