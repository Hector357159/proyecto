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
//background="img/descarga.jpg"



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
     <body>
        <div id="page-wrapper">
                <div class="container-fluid">
                    
                    <div class="row bg-title">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                            <h4>RCAR</h4>
                        </div>
                        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                            <ol class="breadcrumb">
                                <li class="active">
                                    Inicio
                                </li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="w3-container">
                            <h2>Administrador de Vehículos</h2>
                            <p>Es la tabla siguiente se muestran los datos del usuario.</p>
                            <table class="w3-table-all w3-large">
                                <tr>
                                    <th>ID Usuario</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Dui</th>
                                    <th>Licencia</th>
                                    <th>Tipo Licencia</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th></th> 
                                </tr>
                                <?php 
                        
                                    while($array=mysqli_fetch_array($query)){
                                 ?>
                                <tr>
                                    <td><?php echo $array[1] ?></td>
                                    <td><?php echo $array[4] ?></td>
                                   
                                    <td><a href="PHP/deleteUser.php"><button class="btn btn-block btn-danger" id="btnDelete">Eliminar</button></td></a>
                                </tr>
                                <?php 
                                    }
                                 ?>
                            </table>
                        </div>
                    </div>
         
     </body>
     </html>