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
	mysqli_query($connection,"SET NAMES utf8");
	//SOLICITAMOS TODOS LOS QUERYS DE LA PAGINA
	$QUERYuser = 				"SELECT 	CONCAT(user_name, ' ', user_last_name) as name,user_email 
						 	 	 FROM 		users 
						 	 	 WHERE 		user_email="."'".$_SESSION["Us3rN4mE"]."'".";";
	$QueryTodayEarnings = 		"SELECT 	TRUNCATE(SUM(PP.process_unit_cost*P.production_count),0) as earnings
							 	 FROM 		process_product_customer as PP, productions as P
							 	 WHERE 		P.f_process = PP.id_process_product_customer and 
							 	 			P.production_date>=CURDATE() and P.production_date <CURDATE()+1;";
	$QueryGetUsers = 			"SELECT 	u.id_user as id_user, u.user_name as user_name, u.user_last_name 
								 			as user_last_name, u.user_email as user_email,u.user_password 
								 			as password,ut.users_type_name as users_type_name, 
								 			date_format(u.date_added, '%Y-%m-%d') AS date_added
							 	 FROM 		users as u, users_type as ut
							 	 WHERE 		u.f_User_Type = ut.id_users_type;"; 
	$QueryTodayProductions = 	"SELECT  	CONCAT(u.user_name, ' ', u.user_last_name) as reporter,c.customer_name, 
								 			ppc.name_process, pt.name_product, ppc.process_unit_cost, 
								 			p.production_count,ppc.goal,p.production_time
								 FROM 		process_product_customer AS ppc, customers AS c, productions AS p, product as pt,users as u
								 WHERE 		ppc.id_process_product_customer = p.f_process and 
								 			pt.f_customer = c.id_customer and 
								 			ppc.f_product = pt.id_product and 
								 			u.id_user = p.f_user AND 
								 			p.production_date>=CURDATE() AND 
								 			p.production_date <CURDATE()+1";
	$QueryGetCustomersCount = 	"SELECT 	Count(id_customer) as customers from customers;";
	$QueryGetMessages = 		"SELECT 	m.id_message as messageid, m.f_user_sender as usersenderid, m.f_user_receiver,
								 			(select CONCAT(u.user_name,' ',u.user_last_name) 
								 			FROM 		users as u,messages as m2 
								 			WHERE 		messageid =m2.id_message and 
								 						u.id_user = usersenderid) as 
								 			f_user_sender_name,m.message,DATE_FORMAT(date_sent, '%d de %M a las %h:%i %p') as date_sent 
								 FROM 		messages as m,users as u
								 WHERE 		u.id_user = m.f_user_receiver and m.f_user_receiver = ".$_SESSION["Us3r1D"].";";	
	$QueryGetUserTypes = 		"SELECT 	id_users_type,users_type_name 
								 FROM 		users_type;";
	$QueryGetSupervisors = 		"SELECT 	u.id_user as id_user, u.user_name as user_name, u.user_last_name as user_last_name, 
											u.user_email as user_email,date_format(u.date_added, '%Y-%m-%d') AS date_added
								 FROM 		users as u, users_type as ut
								 WHERE 		u.f_User_Type = ut.id_users_type and 
								 			ut.id_users_type = 2;"; 
	$QueryGetCustomers = 		"SELECT 	c.id_customer,c.customer_name, c.customer_address,c.customer_number,c.date_added,
											co.nicename as country 
								 FROM 		customers as c,country as co where co.id_country = c.f_country;";
	$QueryGetSupervisorsH =		"SELECT 	CONCAT(u.user_name, ' ', u.user_last_name) as user_name, c.customer_name,sc.f_assignedby as f_assignedby, 
								 			(SELECT CONCAT(u2.user_name, ' ', u2.user_last_name) 
								 			FROM 		users as u2 where u2.id_user = f_assignedby) as 
								 			assignedby,DATE_FORMAT(sc.date_assigned, '%d de %M a las %h:%i %p') as date_assigned
								 FROM 		supervisor_customer as sc, users as u,customers as c
								 WHERE 		sc.f_customer = c.id_customer and u.id_user = sc.f_supervisor_user
								 ORDER BY 	c.customer_name asc,date_assigned desc;";

	
	
	//EJECUTAMOS TODOS LOS QUERY
	$result1 = mysqli_query($connection, $QUERYuser) or trigger_error("Query Failed! SQL: $QUERYuser- Error: ". mysqli_error($connection), E_USER_ERROR);
    $result2 = mysqli_query($connection, $QueryTodayEarnings) or trigger_error("Query Failed! SQL: $QueryTodayEarnings - Error: ". mysqli_error($connection), E_USER_ERROR);
    $result_QueryGetSupervisors = mysqli_query($connection, $QueryGetSupervisors) or trigger_error("Query Failed! SQL: $QueryGetSupervisors - Error: ". mysqli_error($connection), E_USER_ERROR);
    $result_QueryTodayProductions = mysqli_query($connection, $QueryTodayProductions) or trigger_error("Query Failed! SQL: $QueryTodayProductions - Error: ". mysqli_error($connection), E_USER_ERROR);
    $result_customers = mysqli_query($connection, $QueryGetCustomersCount) or trigger_error("Query Failed! SQL: $QueryGetCustomersCount - Error: ". mysqli_error($connection), E_USER_ERROR);
    $result_messages = mysqli_query($connection, $QueryGetMessages) or trigger_error("Query Failed! SQL: $QueryGetMessages - Error: ". mysqli_error($connection), E_USER_ERROR);
	$result_user_type = mysqli_query($connection, $QueryGetUserTypes) or trigger_error("Query Failed! SQL: $QueryGetUserTypes - Error: ". mysqli_error($connection), E_USER_ERROR);
	$result_QueryGetCustomers = mysqli_query($connection, $QueryGetCustomers) or trigger_error("Query Failed! SQL: $QueryGetUserTypes - Error: ". mysqli_error($connection), E_USER_ERROR);
	$result_QueryGetSupervisorsH = mysqli_query($connection, $QueryGetSupervisorsH) or trigger_error("Query Failed! SQL: $QueryGetSupervisorsH - Error: ". mysqli_error($connection), E_USER_ERROR);
    
	$res1 = mysqli_fetch_assoc($result1);
    $res2 = mysqli_fetch_assoc($result2);
    $res3 = mysqli_fetch_assoc($result_customers);

	$numCustomers = $res3["customers"];
    
    if(empty($res2["earnings"])){
        $earnings_print = 0;
    }else{
        $earnings_print = $res2["earnings"];
    }

	//mysqli_close($connection);
	function get_customer_x_supervisor($opt){
	
	$connection2 = db_connect();
	mysqli_query($connection2,"SET NAMES utf8");
	$query = "SELECT sc.id_supervisor_customer, u.id_user as id_user, u.user_name as user_name, u.user_last_name as user_last_name, 
u.user_email as user_email,date_format(sc.date_assigned, '%Y-%m-%d') AS date_assigned,sc.f_customer
FROM users as u, users_type as ut,supervisor_customer as sc
WHERE u.f_User_Type = ut.id_users_type and sc.f_supervisor_user = u.id_user and ut.id_users_type = 2 and f_customer = $opt
ORDER BY sc.date_assigned DESC
LIMIT 1";
$result_query = mysqli_query($connection2, $query) or trigger_error("Query Failed! SQL: $query - Error: ". mysqli_error($connection2), E_USER_ERROR);

	$res1 = mysqli_fetch_assoc($result_query);
	
	return $res1;
}  
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
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
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
	<!-- Include Menu -->
	<script src="https://www.w3schools.com/lib/w3.js"></script>
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
                        <h4 class="page-title">Asignacion de Supervisores a Clientes</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        
                        <ol class="breadcrumb">
                            <li><a href="#">Configuracion</a></li>
                            <li class="active">Asignacion de Supervisores</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- .row -->
                <div class="row">
				
				<?php 
					$customer_supervisor_assigned=0;
					while($row_c= mysqli_fetch_assoc($result_QueryGetCustomers)){
					$current_supervisor="";
					$date_assigned="";
				echo '  <div class="col-sm-12">
							<div class="white-box">
								<h3 class="box-title m-b-0">'.$row_c["customer_name"].'</h3>
								<h5 class="text m-b-30">Seleccione el supervisor para el <code>'.htmlentities(strftime('%A %d %B %Y'), ENT_COMPAT,'ISO-8859-1', true).'</code></h5>
								<form data-toggle="validator" action="insert_customer_supervisor.go" method="POST">
									<h5 class="m-t-30">Seleccione:</h5>
									<div class="form-group">
										<select class="form-control select2" name="supervisor" id="supervisor">';?>
										<?php
											$rowf = get_customer_x_supervisor($row_c["id_customer"]);
											$customer_supervisor_assigned = $rowf["id_user"];
											echo '<optgroup label="Supervisores Disponibles">';
											while($row= mysqli_fetch_assoc($result_QueryGetSupervisors)){
												if($customer_supervisor_assigned==$row["id_user"]){
													echo '<option selected="selected" value='.$row["id_user"].'>'.$row["user_name"].' '.$row["user_last_name"].'</option>';  
													$current_supervisor=$row["user_name"].' '.$row["user_last_name"];
													$date_assigned=$rowf["date_assigned"];
												}else{
													echo '<option value='.$row["id_user"].'>'.$row["user_name"].' '.$row["user_last_name"].'</option>'; 	
												}                       
											}
											echo '</optgroup>';
										echo '
										</select>															
									</div>';
									if($current_supervisor==""){?>
										<div class="form-group">
											<h5 class="m-t-30">El Cliente no posee un supervisor asignado.</h5>
										</div>
									<?}else{?>
										<div class="form-group">
											<h5 class="m-t-30">El Cliente posee a <b><?php echo $current_supervisor; ?></b> como supervisor asignado desde <code><?php echo utf8_encode($date_assigned); ?></code>.</h5>
										</div>
									<?}
									echo'
									<input type="hidden" name="id_customer" value="'.$row_c["id_customer"].'">
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Asignar Supervisor</button>';?>
										<button type="button" title="Crear" onClick="confirmCreateGroup('group-productions.php?id=<?php echo $row_c["id_customer"];?>&cname=<?php echo $row_c["customer_name"];?>')" class="btn btn-primary">Crear Grupo de Trabajo</i></button>
									<?	echo '
									</div>
								</form>
								
                        
							</div>
						</div>';
				mysqli_data_seek($result_QueryGetSupervisors, 0);  //se reinicia a los supervisores para que se puedan cargar en el siguiente componente.
				}?>
				<!--./col-->
				
                <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Historial de Asignacion de Supervisores</h3>
                            <p class="text-muted m-b-30">Exporte o Copie la informacion en CSV, Excel, PDF & Print</p>
                            <div class="table-responsive">
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Supervisor</th>
											<th>Asignado por</th>
                                            <th>Fecha Asignacion</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Supervisor</th>
											<th>Asignado por</th>
                                            <th>Fecha Asignacion</th>
                                        </tr>
                                    </tfoot>
                                    <tbody> 
                                    <?php 
                                            while($row = mysqli_fetch_assoc($result_QueryGetSupervisorsH)){
                                                echo '<tr>';
                                                echo '<th>'.$row["customer_name"].'</th>';
                                                echo '<th>'.$row["user_name"].'</th>'; 
                                                echo '<th>'.$row["assignedby"].'</th>'; 
                                                echo '<th>'.$row["date_assigned"].'</th>';
                                                echo '</tr>';
                                                
                                            } 
                                    ?> 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <!--.col-->
                </div>
               
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
		<!-- Calendar JavaScript -->
		<script src="../plugins/bower_components/moment/moment.js"></script>
		<script src='../plugins/bower_components/calendar/dist/fullcalendar.min.js'></script>
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
        <script src="../plugins/bower_components/switchery/dist/switchery.min.js"></script>
        <script src="../plugins/bower_components/custom-select/custom-select.min.js" type="text/javascript"></script>
        <script src="../plugins/bower_components/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="../plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script src="../plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="../plugins/bower_components/multiselect/js/jquery.multi-select.js"></script>
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
		<script>
			w3.includeHTML();
		</script>

        <!--Style Switcher -->
		<script>    
		function confirmCreateGroup(url) {
			if (confirm("Esta seguro que desea crear grupos?")) {
				location.href = url;
			} else {
				false;
			}       
		}
	</script>
        <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>