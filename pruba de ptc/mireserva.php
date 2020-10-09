<?php 



        //Incluir la conexion para consultar la base de datos

        include('Conexion.php');
        



        //Inicio de session

        session_start();
        
         //resireccionar si no es admin a indexAdmin

         if ($_SESSION['tipo_session'] != 1 ) {
            
        header("location: indexAdmin.php");

        }



        //Validacion para que solo se pueda iniciar session por el login y no por url

        if(isset($_SESSION['user'])){



        }else{

            header("location: login.php");

        }
//background="img/descarga.jpg"

$id=$_SESSION['user'];

     ?>
     <!DOCTYPE html>
     <html lang="en">
     <head>
         <meta charset="UTF-8">
         <title>Document</title>
         <?php
     include 'menu/menu.php'; 

     ?>
     </head>
     <body>
       
                  
                            
                                <div class="table-responsive manage-table">
                                        <table class="table" cellspacing="14">
                                            <thead>
                                                <tr>
                                    <th><?php echo $diasalida; ?></th>
                                    <th><?php echo $diaentrada; ?></th>
                                    <th><?php echo $Pais_salida; ?></th>
                                    <th><?php echo $Pais_entrada; ?></th>
                                    <th><?php echo $Nvoleto; ?></th>
                                    <th><?php echo $presio; ?></th>
                                    <th></th>
                                    
                                    <th></th> 
                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                    $query=mysqli_query($conxi,"SELECT * FROM id_reserva WHERE id_reserva.id_usuario='$id'");
                                    while($array=mysqli_fetch_array($query)){
                                 ?>
                                <tr>
                                    <td><?php echo $array[3]; ?></td>
                                    <td><?php echo $array[4] ;?></td>
                                    <td><?php echo $array[5]; ?></td>
                                    <td><?php echo $array[6] ;?></td>
                                    <td><?php echo $array[7]; ?></td>
                                    <td><?php echo $array[8] ;?></td>
                                   
                                    <td><a href="PHP/concelarB.php?id=<?php echo $array[0];?>"><button class="btn btn-block btn-danger" id="btnDelete"><?php echo $CANCEL; ?></button></td></a>
                                </tr>
                                <?php 
                                    }
                                 ?>
                                            </tbody>
                                        </table>
                                </div>
         
     </body>
     </html>