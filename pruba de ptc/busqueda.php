  <?php 

     $clase1 = $_POST['clase'];
     $origen1 = $_POST['origen'];
     $destino1 = $_POST['destino'];
     $origen2 = $_POST['origen1'];
     $destino2 = $_POST['destino1'];



        //Incluir la conexion para consultar la base de datos

        include('Conexion.php');
        



        //Inicio de session

        session_start();



        //Validacion para que solo se pueda iniciar session por el login y no por url

        if(isset($_SESSION['user'])){



        }else{

            header("location: /login.php");

        }
        




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
    
	<div id="page-wrapper">
             <div class="container-fluid">
                 
                    <?php 
 $boleto="SELECT tbboleto.ID_boleto,tbboleto.DsalidaV,tbboleto.DllegadaV,tbboleto.Psalida,tbboleto.Pentrada,tbboleto.Hsalida,tbboleto.Hentrada,tbboleto.Tiempo,tbboleto.Presio,tbboleto.Aerolinia,tbboleto.Nvuelo,tbboleto.reserva,tbescala.ID_boleto,tbescala.DsalidaV,tbescala.DllegadaV,tbescala.Lsalida,tbescala.Lentrada,tbescala.Hsalida,tbescala.Hentrada,tbescala.Tiempo,tbescala.precio,tbescala.Aerolinia,tbescala.Nbuelo,tbescala.reserva FROM tbboleto INNER JOIN tbescala on tbboleto.ID_boleto = tbescala.ID_boleto WHERE tbboleto.Psalida = '$origen1' AND tbboleto.Pentrada = '$destino1' OR tbescala.Lentrada = '$destino1' " or die(mysql_error());//consulta a mysql los datos que se riquieren
                                              $resultadoboleto = mysqli_query($conxi,$boleto);//consulta a la vase de datos si funciona 
                        for($k = 0; $k < 5; $k++){//es el siclo for

                                ?>

                                <div class="row el-element-overlay">

                                <?php

                                for($i=0; $i < 4; $i++) {//es el siclo for

                                    if($row = mysqli_fetch_array($resultadoboleto)){///conviete los datos de la base de datos a  en booleano(comiensa con 0 despues el 1,2,3) para que se mas facil imprimir la informacion
                                       if ($row[11] == "NO") {
                                          if ( $row['4'] == $destino1) {

                            ?>

                            <div class="col-lg-3 col-md-6">
                                <div class="white-box">
                                    <div class="el-card-item">
                                        
                                        <script type="text/javascript">
                                            
                                            function id_vehiculo(id){

                                                $.ajax({
                                                    type: "POST",
                                                    url: "PHP/Idboleto.php",
                                                    data: {id: id}
                                                }).done(function(){
                                                    window.location="resevar.php";
                                                });

                                            }

                                        </script>
                                        <p> <div class="el-card-content">
                                            <div class="row">
                                                <div class="el-card-avatar el-overlay-1"> 
                                            <img src="img/voletos.png" width="100" height="100" alt="user" />
                                            <div class="el-overlay">
                                                <ul class="el-info">
                                                
                        
                                            </div>
                                        </div>
                                                <div class="col-md-8">
                                                    <h4 class="mb-0"><?php echo $row[3]." ".$row[4]; ?></h4>
                                                    <span class="text-muted"><?php echo $row[8]." ".$row[9]." ".$row[10]; ?></span>
                                                </div>
                                                <div class="col-md-4">
                                                   <a onclick="id_vehiculo('<?php echo $row[0]; ?>')"> <button type="button" class="btn btn-success btn-circle btn-lg"><?php echo $row[8]; ?></button></a>
                                                </div>
                                            </div>
                                        </p></div>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }else{
                        
                        ?>
                        <div class="col-lg-3 col-md-6">
                                <div class="white-box">
                                    <div class="el-card-item">
                                        
                                        <script type="text/javascript">
                                            
                                            function id_vehiculo(id){

                                                $.ajax({
                                                    type: "POST",
                                                    url: "PHP/Idboleto.php",
                                                    data: {id: id}
                                                }).done(function(){
                                                    window.location="resevar.php";
                                                });

                                            }

                                        </script>
                                        <p> <div class="el-card-content">
                                            <div class="row">
                                                <div class="el-card-avatar el-overlay-1"> 
                                            <img src="img/voletos.png" width="100" height="100" alt="user" />
                                            <div class="el-overlay">
                                                <ul class="el-info">
                                                
                        
                                            </div>
                                        </div>
                                                <div class="col-md-8">
                                                    <h4 class="mb-0"><?php echo $row[3]." ".$row[16]; ?></h4>
                                                    <span class="text-muted"><?php echo $row[8]." ".$row[21]." ".$row[22]; ?></span>
                                                </div>
                                                <div class="col-md-4">
                                                   <a onclick="id_vehiculo('<?php echo $row[0]; ?>')"> <button type="button" class="btn btn-success btn-circle btn-lg"><?php echo $row[20]; ?></button></a>
                                                </div>
                                            </div>
                                        </p></div>
                                    </div>
                                </div>
                            </div>


                        <?php  
                        }

                        }
                            }
                        }

                     ?>
                </div>
                <?php } ?>

             </div>
         </div>
    </div>
                  <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="../plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
            $(document).ready(function () {
                var table = $('#example').DataTable({
                    "columnDefs": [
                        {
                            "visible": false
                            , "targets": 2
                        }
          ]
                    , "order": [[2, 'asc']]
                    , "displayLength": 25
                    , "drawCallback": function (settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function (group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                last = group;
                            }
                        });
                    }
                });
                // Order by the grouping
                $('#example tbody').on('click', 'tr.group', function () {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                        table.order([2, 'desc']).draw();
                    }
                    else {
                        table.order([2, 'asc']).draw();
                    }
                });
            });
        });
        $('#example23').DataTable({
            dom: 'Bfrtip'
            , buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        });
    </script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
	
</body>
</html>
<?php 
/*
 <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Row grouping </h3>
                            <p class="text-muted m-b-30">Data table example</p>
                            <div class="table-responsive">
                                <table id="example" class="table display">

                                    <thead>
                                        <tr>
                                            <th><?php echo $Pais_salida; ?></th>
                                            <th><?php echo $Pais_entrada; ?></th>
                                            <th><?php echo $hora_salida;; ?></th>
                                            <th><?php echo $hora_entrada;; ?></th>
                                            <th><?php echo $presio; ?></th>
                                            <th><?php echo $total_time; ?></th>
                                            <th><?php echo $reservar; ?></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <?php 
                                         $boleto="SELECT tbboleto.ID_boleto,tbboleto.DsalidaV,tbboleto.DllegadaV,tbboleto.Psalida,tbboleto.Pentrada,tbboleto.Hsalida,tbboleto.Hentrada,tbboleto.Tiempo,tbboleto.Presio,tbboleto.Aerolinia,tbboleto.Nvuelo,tbboleto.reserva,tbescala.ID_boleto,tbescala.DsalidaV,tbescala.DllegadaV,tbescala.Lsalida,tbescala.Lentrada,tbescala.Hsalida,tbescala.Hentrada,tbescala.Tiempo,tbescala.precio,tbescala.Aerolinia,tbescala.Nbuelo,tbescala.reserva FROM tbboleto INNER JOIN tbescala on tbboleto.ID_boleto = tbescala.ID_boleto WHERE tbboleto.DsalidaV = '$origen1' AND tbboleto.DllegadaV = '$destino1' OR tbescala.Lentrada = '$destino1' " or die(mysql_error());
                                              $resultadoboleto = mysqli_query($conxi,$boleto);

                                                //if ($rowP= mysqli_fetch_array($resultadoboleto)) {
                                        while($rowP = mysqli_fetch_array($resultadoboleto)){

                                            

                                            if ($rowP['11'] == "NO") {
                                            if ( $rowP['4'] == $destino1) {
                                                # code...
                                            
                                          
                                             
                                       echo "<tr>"
                                            ."<th>".$rowP['3']."</th>"
                                            ."<th>".$rowP['4']."</th>"
                                            ."<th>".$rowP['5']."</th>"
                                            ."<th>".$rowP['6']."</th>"
                                            ."<th>".$rowP['9']."</th>"
                                            ."<th>".$rowP['7']."</th>"
                                            ."<th></th>"
                                           ."</tr>";
                                           }else{
                                             echo "<tr>"
                                            ."<th>".$rowP['3']."</th>"
                                            ."<th>".$rowP['16']."</th>"
                                            ."<th>".$rowP['5']."</th>"
                                            ."<th>".$rowP['6']."</th>"
                                            ."<th>".$rowP['9']."</th>"
                                            ."<th>".$rowP['7']."</th>"
                                            ."<th></th>"
                                           ."</tr>";

                                           }
                                          } 
                                         }

                                         ?>
                                    </tfoot>

                                </table>
                            </div>
                        </div>
                    </div>




<div id="page-wrapper">
             <div class="container-fluid">
                 <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4>RCAR</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <ol class="breadcrumb">
                            <li>
                                Inicio
                            </li>
                            <li>
                                Vehiculo Liviano
                            </li>
                            <li class="active">
                                Catalogo
                            </li>
                        </ol>
                    </div>
                </div>
                <h1>Catalogo Liviano Propietario</h1>
                    <?php 

                            $queryCatalogo = "SELECT * FROM `tbvehiculo` WHERE Tvehiculo = 'Sedan'";
                            $result = mysqli_query($cn, $queryCatalogo);

                        for($k = 0; $k < 5; $k++){

                                ?>

                                <div class="row el-element-overlay">

                                <?php

                                for($i=0; $i < 4; $i++) {

                                    if($row = mysqli_fetch_array($result)){

                            ?>

                            <div class="col-lg-3 col-md-6">
                                <div class="white-box">
                                    <div class="el-card-item">
                                        <div class="el-card-avatar el-overlay-1"> 
                                            <img src="img/kiaSpectra.webp" alt="user" />
                                            <div class="el-overlay">
                                                <ul class="el-info">
                                                    <li>
                                                        <a class="btn default btn-outline image-popup-vertical-fit" href="img/kiaSpectra.webp">
                                                            <i class="icon-magnifier"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="btn default btn-outline" onclick="id_vehiculo('<?php echo $row[0]; ?>')">
                                                            <i class="icon-diamond"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            
                                            function id_vehiculo(id){

                                                $.ajax({
                                                    type: "POST",
                                                    url: "PHP/idVehiculo.php",
                                                    data: {id: id}
                                                }).done(function(){
                                                    window.location="DetalleCatalogoCliente.php";
                                                });

                                            }

                                        </script>
                                        <div class="el-card-content">
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <h4 class="mb-0"><?php echo $row[3]." ".$row[4]; ?></h4>
                                                    <span class="text-muted"><?php echo $row[8]." ".$row[9]." ".$row[10]; ?></span>
                                                </div>
                                                <div class="col-md-4">
                                                    <button type="button" class="btn btn-success btn-circle btn-lg"><?php echo "$".$row[13]; ?></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            }
                        }

                     ?>
                </div>
                <?php } ?>

             </div>
         </div>
    </div>
*/
 ?>