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
    include "menu/menuadmin.php"; 
     ?>
</head>
<body>
	<div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Row grouping </h3>
                            <p class="text-muted m-b-30">Data table example</p>
                            <div class="table-responsive">
                                <table id="example" class="table display">
                                    <thead>
                                        <tr>
                                            <th><?php echo $diasalida;  ?></th>
                                            <th><?php echo $diaentrada;  ?></th>
                                            <th><?php echo $Pais_salida; ?></th>
                                            <th><?php echo $Pais_entrada; ?></th>
                                            <th><?php echo $Nvoleto; ?></th>
                                            <th><?php echo $presio; ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                         <tr>
                                            <th><?php echo $diasalida;  ?></th>
                                            <th><?php echo $diaentrada;  ?></th>
                                            <th><?php echo $Pais_salida; ?></th>
                                            <th><?php echo $Pais_entrada; ?></th>
                                            <th><?php echo $Nvoleto; ?></th>
                                            <th><?php echo $presio; ?></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                          
                                          
                                                <?php 
                                    $query=mysqli_query($conxi,"SELECT * FROM id_reserva ");
                                    while($array=mysqli_fetch_array($query)){
                                 ?>
                                <tr>
                                    <td><?php echo $array[3]; ?></td>
                                    <td><?php echo $array[4] ;?></td>
                                    <td><?php echo $array[5]; ?></td>
                                    <td><?php echo $array[6] ;?></td>
                                    <td><?php echo $array[7]; ?></td>
                                    <td><?php echo $array[8] ;?></td>
                                   
                                    <td><a href="PHP/deleteuser.php?id=<?php echo $array[0];?>"><button class="btn btn-block btn-danger" id="btnDelete"><?php echo $CANCEL; ?></button></td></a>
                                </tr>
                                <?php 
                                    }
                                 ?>
                                           
                                
                                       
                                    </tbody>
                                </table>
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