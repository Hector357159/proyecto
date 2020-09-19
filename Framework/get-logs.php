<?php
session_start();

	if(!isset($_SESSION["Us3rN4mE"])){
		header('Location: login.php');
	}
	if($_SESSION["Us3r_Typ3"]!='Administrador'){
		header('Location: insert_productivity.php');
	}
	// VAMOS A TRAER LA INFORMACION DE CONFIG UNA SOLA VEZ 'require_once'
	if (file_exists('/home/irvincabezas/public_html/production/app/system/config.php')) {
		require_once('/home/irvincabezas/public_html/production/app/system/config.php');
	}else{
		header("Location: http://imagine-studio-solutions.com/production/app/500.html");
	}
	require_once(DIR_DATABASE . 'db.php');
	require_once(DIR_FUNCTIONS . 'functions.php');
	$connection = db_connect();
	//SOLICITAMOS TODOS LOS QUERYS DE LA PAGINA
	$QUERYuser = "SELECT CONCAT(user_name, ' ', user_last_name) as name,user_email FROM users WHERE user_email="."'".$_SESSION["Us3rN4mE"]."'".";";
	$QueryTodayEarnings = "SELECT TRUNCATE(SUM(PP.process_unit_cost*P.production_count),0) as earnings
FROM process_product_customer as PP, productions as P
WHERE P.f_process = PP.id_process_product_customer
and P.production_date>=CURDATE() and P.production_date <CURDATE()+1;";
$QueryGetUsers = "SELECT u.id_user as id_user, u.user_name as user_name, u.user_last_name as user_last_name, u.user_email as user_email,u.user_password as password,
ut.users_type_name as users_type_name,(SELECT CONCAT(u2.user_name, ' ', u2.user_last_name) from users as u2 where u2.id_user=u.f_createdby) as created_by, 
date_format(u.date_added, '%Y-%m-%d') AS date_added
FROM users as u, users_type as ut
WHERE u.f_User_Type = ut.id_users_type;"; 
$QueryTodayProductions = "SELECT  CONCAT(u.user_name, ' ', u.user_last_name) as reporter,c.customer_name, ppc.name_process, pt.name_product, ppc.process_unit_cost, p.production_count,ppc.goal,p.production_time
FROM process_product_customer AS ppc, customers AS c, productions AS p, product as pt,users as u
WHERE ppc.id_process_product_customer = p.f_process and pt.f_customer = c.id_customer and ppc.f_product = pt.id_product and u.id_user = p.f_user
AND p.production_date>=CURDATE() AND p.production_date <CURDATE()+1";
$QueryGetCustomersCount = "Select Count(id_customer) as customers from customers;";
$QueryGetMessages = "SELECT m.id_message as messageid, m.f_user_sender as usersenderid, m.f_user_receiver,
(select CONCAT(u.user_name,' ',u.user_last_name) from users as u,messages as m2 where messageid =m2.id_message and u.id_user = usersenderid) as f_user_sender_name,m.message,DATE_FORMAT(date_sent, '%d de %M a las %h:%i %p') as date_sent 
FROM messages as m,users as u
WHERE u.id_user = m.f_user_receiver and m.f_user_receiver = ".$_SESSION["Us3r1D"].";";	
$QueryGetUserTypes = "SELECT id_users_type,users_type_name from users_type;";
	
	
	//EJECUTAMOS TODOS LOS QUERY
	$result1 = mysqli_query($connection, $QUERYuser) or trigger_error("Query Failed! SQL: $QUERYuser- Error: ". mysqli_error($connection), E_USER_ERROR);
    $result2 = mysqli_query($connection, $QueryTodayEarnings) or trigger_error("Query Failed! SQL: $QueryTodayEarnings - Error: ". mysqli_error($connection), E_USER_ERROR);
    $result_QueryGetUsers = mysqli_query($connection, $QueryGetUsers) or trigger_error("Query Failed! SQL: $QueryGetUsers - Error: ". mysqli_error($connection), E_USER_ERROR);
    $result_QueryTodayProductions = mysqli_query($connection, $QueryTodayProductions) or trigger_error("Query Failed! SQL: $QueryTodayProductions - Error: ". mysqli_error($connection), E_USER_ERROR);
    $result_customers = mysqli_query($connection, $QueryGetCustomersCount) or trigger_error("Query Failed! SQL: $QueryGetCustomersCount - Error: ". mysqli_error($connection), E_USER_ERROR);
    $result_messages = mysqli_query($connection, $QueryGetMessages) or trigger_error("Query Failed! SQL: $QueryGetMessages - Error: ". mysqli_error($connection), E_USER_ERROR);
	$result_user_type = mysqli_query($connection, $QueryGetUserTypes) or trigger_error("Query Failed! SQL: $QueryGetUserTypes - Error: ". mysqli_error($connection), E_USER_ERROR);
    
	$res1 = mysqli_fetch_assoc($result1);
    $res2 = mysqli_fetch_assoc($result2);
    $res3 = mysqli_fetch_assoc($result_customers);
    
    if(empty($res2["earnings"])){
        $earnings_print = 0;
    }else{
        $earnings_print = $res2["earnings"];
    }

	mysqli_close($connection);
	  
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
    <title>Ample Admin Template - The Ultimate Multipurpose admin template</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
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
                        <h4 class="page-title">LOGGING</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        
                        <ol class="breadcrumb">
                            <li><a href="#">Panel de Control</a></li>
                            <li class="active">Usuarios</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">LOGS</h3>
                            <p class="text-muted m-b-30">Mensajes de advertencia, errores e informacion por Apache Server.</p>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Tipo</th>
                                            <th>Mensaje</th>
                                            <th>Ruta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php 
							

										
										$file = new SplFileObject("error_log");

										// Loop until we reach the end of the file.
										while (!$file->eof()) {
										    // Echo one line from the file.
										    $fila_l =  $file->fgets();
										    if(!empty(trim(strstr(strstr($fila_l, '['), ']', true), '[]'))){
											    $rest = '['. strcut($fila_l, ':', 3);
	                                            $error_m = trim(strstr(strstr($rest, '['), '/', true), '[/');
											    echo '<tr class="advance-table-row">';
	                                            echo '<td>'. trim(strstr(strstr($fila_l, '['), ']', true), '[]') . '</td>';
	                                            $error_type = trim(strstr(strstr($fila_l, 'PHP'), ':', true));
	                                            switch($error_type){
		                                            case 'PHP Fatal error': echo '<td><code>'. $error_type .'</code></td>';
		                                            						break;
		                                            case 'PHP Warning': echo '<td><mark>'. $error_type .'</mark></td>';
		                                            						break;
		                                            default: echo '<td>'. $error_type .'</code>';
	                                            }
												if(empty($error_m)){
													echo '<td><code>'. strcut($fila_l, ':', 3).'</code></td>';
													
												}else{
													if($error_type=='PHP Warning'){
														echo '<td><mark>'. $error_m .'</mark></td>';
													}else{
														echo '<td>'. $error_m .'</td>';
													}
												}
	                                            $route =  strcut($fila_l, '/', 2);
	                                            echo '<td>'. '/'.$route .'</td>';
	                                            echo '</tr>';
	                                        }
										}

										// Unset the file to call __destruct(), closing the file handle.
										$file = null;              
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    
					
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
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
            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
        </div>
        <!-- /#page-wrapper -->
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
	<script src="js/validator.js"></script>
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
	<script>    
		function confirmDelete(url) {
			if (confirm("¿Esta seguro que desea borrar el registro? Notese que solo lo podra borrar si no existe ninguna actividad del usuario en el sistema.")) {
				location.href = url;
			} else {
				false;
			}       
		}
	</script>
	<script>    
		function confirmEdit(url) {
			if (confirm("¿Esta seguro que desea editar el usuario?")) {
				location.href = url;
			} else {
				false;
			}       
		}
	</script>
</body>

</html>