<?php
session_start();
	if(!isset($_SESSION["Us3rN4mE"])){
		header('Location: login.php');
	}
	
	// VAMOS A TRAER LA INFORMACION DE CONFIG UNA SOLA VEZ 'require_once'
	if (file_exists('/home/irvincabezas/public_html/production/app/system/config.php')) {
		require_once('/home/irvincabezas/public_html/production/app/system/config.php');
	}else{
		header("Location: http://imagine-studio-solutions.com/production/app/500.html");
	}
	require_once(DIR_DATABASE . 'db.php');
	$connection = db_connect();
	//SOLICITAMOS TODOS LOS QUERYS DE LA PAGINA
	$QUERYuser = "SELECT CONCAT(user_name, ' ', user_last_name) as name,user_email FROM users WHERE user_email="."'".$_SESSION["Us3rN4mE"]."'".";";
	$QUERYGetCustomers = "SELECT id_customer,customer_name from customers;";
	$QUERYGetActiveUser = "SELECT CONCAT(user_name, ' ', user_last_name) as name FROM users WHERE user_email="."'".$_SESSION["Us3rN4mE"]."'".";";
	$QUERYGetFirstProcLoad = "SELECT id_product, product_code, name_product FROM product where f_customer = (select id_customer from customers limit 1);";
$QUERYGetUserID="SELECT id_user as id_user FROM users WHERE user_email="."'".$_SESSION["Us3rN4mE"]."'".";";
$QueryAllProcess = "SELECT  CONCAT(u.user_name, ' ', u.user_last_name) as reporter,c.customer_name, ppc.name_process, pt.name_product,ppc.goal,ppc.id_process_product_customer,ppc.process_unit_cost,pt.product_code,c.id_customer,pt.id_product
FROM process_product_customer AS ppc, customers AS c, product as pt,users as u
WHERE pt.f_customer = c.id_customer and ppc.f_product = pt.id_product and u.id_user = ppc.createdby;";
$QueryGetMessages = "SELECT m.id_message as messageid, m.f_user_sender as usersenderid, m.f_user_receiver,
(select CONCAT(u.user_name,' ',u.user_last_name) from users as u,messages as m2 where messageid =m2.id_message and u.id_user = usersenderid) as f_user_sender_name,m.message,DATE_FORMAT(date_sent, '%d de %M a las %h:%i %p') as date_sent 
FROM messages as m,users as u
WHERE u.id_user = m.f_user_receiver and m.f_user_receiver = ".$_SESSION["Us3r1D"].";";	

	//EJECUTAMOS TODOS LOS QUERY
	$resultUsername = mysqli_query($connection, $QUERYuser) or trigger_error("Query Failed! SQL: $QUERYuser- Error: ". mysqli_error($connection), E_USER_ERROR);
	$result1 = mysqli_query($connection, $QUERYGetCustomers) or trigger_error("Query Failed! SQL: $QUERYGetCustomers - Error: ". mysqli_error($connection), E_USER_ERROR);
    $result2 = mysqli_query($connection, $QUERYGetActiveUser) or trigger_error("Query Failed! SQL: $QUERYGetActiveUser - Error: ". mysqli_error($connection), E_USER_ERROR);
    $result3 = mysqli_query($connection, $QUERYGetFirstProcLoad) or trigger_error("Query Failed! SQL: $QUERYGetFirstProcLoad - Error: ". mysqli_error($connection), E_USER_ERROR);
    $result4 = mysqli_query($connection, $QUERYGetUserID) or trigger_error("Query Failed! SQL: $QUERYGetUserID - Error: ". mysqli_error($connection), E_USER_ERROR);
	$result_QueryAllProcess = mysqli_query($connection, $QueryAllProcess) or trigger_error("Query Failed! SQL: $QueryAllProcess - Error: ". mysqli_error($connection), E_USER_ERROR);
	$result_messages = mysqli_query($connection, $QueryGetMessages) or trigger_error("Query Failed! SQL: $QueryGetMessages - Error: ". mysqli_error($connection), E_USER_ERROR);
	
	$res1 = mysqli_fetch_assoc($resultUsername);
    $user = mysqli_fetch_assoc($result2);
    $user_id = mysqli_fetch_assoc($result4);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>Producciones Produses S.A. de C.V.</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
	 <!-- page CSS -->
    <link href="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />
    <link href="../plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="../plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="../plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="../plugins/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    
<![endif]-->
<script type="text/javascript">
   function update(str,type)
   {
      var xmlhttp;

      if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
      }
      else
      {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }	

      xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
	        if(type == "procesos"){ 
		        document.getElementById("procesos").innerHTML = xmlhttp.responseText;
				//$("#procesos").select2("val", ""); 
				//$("#procesos").select2('destroy').val("").select2();
				$("#procesos").val(0).trigger("change"); 
	        }
          
        }
      }
	  if(type == "procesos"){
	  //$("#procesos").val(null).trigger("change"); 
	    
      	xmlhttp.open("GET","list_products.php?opt="+str, true);
	  	xmlhttp.send();
	  }
  }
</script>
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                 <?php include 'views/general/header.php';  ?>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                <?php include 'views/general/menu.php';  ?>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">MANTENIMIENTO DE PROCESOS</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                       
                        <ol class="breadcrumb">
                            <li class="active"><a href="process.php">Procesos</a></li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!--.row-->
                    
                <!--./row-->
                <!--.row-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-info">
                            <div class="panel-heading">Procesos</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form data-toggle="validator" action="insert_process.go" method="POST">
                                        <div class="form-body">
                                            <h3 class="box-title">Ingrese la informacion solicitada para crear un proceso y asignarlo a un cliente.</h3>
                                            <hr>
                                            <div class="row">                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Nombre de Proceso</label>
                                                        <input type="text" class="form-control" required="" placeholder="Nombre con el que identifica al proceso" id="processname" name="processname" data-toggle="validator" data-error="Indique el nombre del proceso." required><div class="help-block with-errors"></div>
													</div>
                                                </div>
                                                <!--/span-->
                                               <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Costo de Proceso</label>
                                                        <input type="number" step="any" min="0" class="form-control" required="" placeholder="0.00 Ingrese sin el signo de dolar" id="costo" name="costo" data-toggle="validator" data-error="Por favor ingresar el costo utilizando dos decimales." required><div class="help-block with-errors"></div> 
													</div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
											<div class="row">                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Cliente</label>
                                                        <select class="form-control" name="customerbox" id="customerbox" onchange="update(this.value,'procesos')">
                                                            <?php
                                                            while($res1 = mysqli_fetch_assoc($result1)){                                                
                                                                echo '<option value='.$res1["id_customer"].'>'.$res1["customer_name"].'</option>';
                                                               
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Producto</label>
                                                       
														<select class="form-control select2" name="procesos" id="procesos" data-placeholder="Choose" data-toggle="validator" data-error="Por favor seleccione que esta de acuerdo con el registro que creara." required><div class="help-block with-errors"></div>
														<?php
															echo '<optgroup label="Productos">';
															while($first_load_proc= mysqli_fetch_assoc($result3)){
																 echo '<option value='.$first_load_proc["id_product"].'>'.$first_load_proc["product_code"].'  '.$first_load_proc["name_product"].'</option>';                             
															}
															echo '</optgroup>';
														?>
														
														</select>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
											<div class="row">                                                
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Creado por</label>
                                                        <input type="text" class="form-control" value="<?php echo $user["name"]; ?>" readonly> 
                                                        <input type="hidden" value="<?php echo $user_id["id_user"];?>" name="usuario" id="usuario">
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                 <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Meta</label>
                                                        <input type="number" id="goal" name="goal" min="1" max="100000" class="form-control" required="" placeholder="Indique en las unidades de su preferencia (El valor debe ser un numero entero)." data-toggle="validator" data-error="Indique la meta para el proceso." required><div class="help-block with-errors"></div>
													</div>
                                                </div>
                                                <!--/span-->
                                            </div>
                                            <!--/row-->
                                            <div class="row">
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label>Descripcion del proceso</label>
                                                        <textarea class="form-control" rows="4" cols="50" id="description" placeholder="Breve Descripcion del Proceso" name="description"></textarea>
                                                    </div>
                                                        
                                                </div>
                                                <!--/span-->
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                        <button type="submit" class="btn-danger btn-lg">Crear Proceso</button>
                                        <input type="button" class="btn btn-default btn-lg" name="cancel" value="Cancelar" onClick="window.location='process.php';" />
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--./row-->
				<div class="row">
                <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">LISTADO DE PROCESOS</h3>
                            <p class="text-muted m-b-30">Exporte o Copie la informacion en CSV, Excel, PDF & Print</p>
                            <div class="table-responsive">
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Codigo Producto</th>
                                            <th>Cliente</th>
                                            <th>Proceso</th>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Meta</th>
                                            <th>Creado Por</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Codigo Producto</th>
                                            <th>Cliente</th>
                                            <th>Proceso</th>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Meta</th>
                                            <th>Creado Por</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </tfoot>
                                    <tbody> 
                                    <?php 
                                            while($row = mysqli_fetch_assoc($result_QueryAllProcess)){
                                                echo '<tr>';
												echo '<th>'.$row["product_code"].'</th>';
                                                echo '<th>'.$row["customer_name"].'</th>';
                                                echo '<th>'.$row["name_process"].'</th>'; 
                                                echo '<th>'.$row["name_product"].'</th>'; 
                                                echo '<th>'.'$'.$row["process_unit_cost"].'</th>';
                                                echo '<th>'.$row["goal"].'</th>';
                                                echo '<th>'.$row["reporter"].'</th>';?>
                                                <td>
													<center>
														<button type="button" title="Editar" onClick="confirmEditProcess('process-update.php?id=<?php echo $row["id_process_product_customer"];?>&id_cust=<?php echo $row["id_customer"];?>&prod=<?php echo $row["id_product"];?>')" class="btn btn-info btn-circle"><i class="fa fa-pencil"></i></button>
														<button type="button" title="Eliminar" onClick="confirmDeleteProcess('delete_process.php?id=<?php echo $row["id_process_product_customer"];?>')" class="btn btn-danger btn-circle"><i class="fa fa-times"></i></button>
													</center>

												</td>
                                    <?          echo '</tr>';
                                                
                                            } 
                                    ?> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--.row-->
               
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" theme="gray" class="yellow-theme">3</a></li>
                                <li><a href="javascript:void(0)" theme="blue" class="blue-theme">4</a></li>
                                <li><a href="javascript:void(0)" theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" theme="megna" class="megna-theme">6</a></li>
                                <li><b>With Dark sidebar</b></li>
                                <br/>
                                <li><a href="javascript:void(0)" theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" theme="gray-dark" class="yellow-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" theme="blue-dark" class="blue-dark-theme working">10</a></li>
                                <li><a href="javascript:void(0)" theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" theme="megna-dark" class="megna-dark-theme">12</a></li>
                            </ul>
                            <ul class="m-t-20 all-demos">
                                <li><b>Choose other demos</b></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/varun.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/genu.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/ritesh.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/arijit.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/govinda.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/hritik.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/john.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/pawandeep.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Imagine Studio Solutions </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Counter js -->
    <script src="../plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="../plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!--Morris JavaScript -->
    <script src="../plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="../plugins/bower_components/morrisjs/morris.js"></script>
    <!-- chartist chart -->
    <script src="../plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="../plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!-- Calendar JavaScript -->
    <script src="../plugins/bower_components/moment/moment.js"></script>
    <script src="../plugins/bower_components/calendar/dist/fullcalendar.min.js"></script>
    <script src="../plugins/bower_components/calendar/dist/cal-init.js"></script>
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
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="js/dashboard1.js"></script>
	<script src="js/validator.js"></script>
    <!-- Custom tab JavaScript -->
    <script src="js/cbpFWTabs.js"></script>
    <script type="text/javascript">
        (function () {
                [].slice.call(document.querySelectorAll('.sttabs')).forEach(function (el) {
                new CBPFWTabs(el);
            });
        })();
    </script>
    <script src="../plugins/bower_components/toast-master/js/jquery.toast.js"></script>
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
	 <!-- Custom Theme JavaScript -->
        <script src="js/custom.min.js"></script>
        <script src="../plugins/bower_components/switchery/dist/switchery.min.js"></script>
        <script src="../plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
        <script src="../plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="../plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script src="../plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../plugins/bower_components/multiselect/js/jquery.multi-select.js"></script>
        <script>
            jQuery(document).ready(function () {
                // Switchery
                var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                $('.js-switch').each(function () {
                    new Switchery($(this)[0], $(this).data());
                });
                // For select 2
                $(".select2").select2();
                $('.selectpicker').selectpicker();
                //Bootstrap-TouchSpin
                $(".vertical-spin").TouchSpin({
                    verticalbuttons: true
                    , verticalupclass: 'ti-plus'
                    , verticaldownclass: 'ti-minus'
                });
                var vspinTrue = $(".vertical-spin").TouchSpin({
                    verticalbuttons: true
                });
                if (vspinTrue) {
                    $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
                }
                $("input[name='tch1']").TouchSpin({
                    min: 0
                    , max: 100
                    , step: 0.1
                    , decimals: 2
                    , boostat: 5
                    , maxboostedstep: 10
                    , postfix: '%'
                });
                $("input[name='tch2']").TouchSpin({
                    min: -1000000000
                    , max: 1000000000
                    , stepinterval: 50
                    , maxboostedstep: 10000000
                    , prefix: '$'
                });
                $("input[name='tch3']").TouchSpin();
                $("input[name='tch3_22']").TouchSpin({
                    initval: 40
                });
                $("input[name='tch5']").TouchSpin({
                    prefix: "pre"
                    , postfix: "post"
                });
                // For multiselect
                $('#pre-selected-options').multiSelect();
                $('#optgroup').multiSelect({
                    selectableOptgroup: true
                });
                $('#public-methods').multiSelect();
                $('#select-all').click(function () {
                    $('#public-methods').multiSelect('select_all');
                    return false;
                });
                $('#deselect-all').click(function () {
                    $('#public-methods').multiSelect('deselect_all');
                    return false;
                });
                $('#refresh').on('click', function () {
                    $('#public-methods').multiSelect('refresh');
                    return false;
                });
                $('#add-option').on('click', function () {
                    $('#public-methods').multiSelect('addOption', {
                        value: 42
                        , text: 'test 42'
                        , index: 0
                    });
                    return false;
                });
            });
        </script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
	<script>    
		function confirmEditProcess(url) {
			if (confirm("¿Esta seguro que desea editar el registro?")) {
				location.href = url;
			} else {
				false;
			}       
		}
	</script>
	<script>    
		function confirmDeleteProcess(url) {
			if (confirm("¿Esta seguro que desea borrar el registro? Notese que solo lo podra borrar si el proceso no esta ligado en una produccion.")) {
				location.href = url;
			} else {
				false;
			}       
		}
	</script>

    
</body>

</html>