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
	//if (empty($_GET)) {
    //	header('Location:' . HTTP_SERVER );
	//}
	//$id_customer = $_REQUEST['id'];
	require_once(DIR_DATABASE . 'db.php');
	$connection = db_connect();
	//SOLICITAMOS TODOS LOS QUERYS DE LA PAGINA
	$QUERYuser = "SELECT CONCAT(user_name, ' ', user_last_name) as name,user_email FROM users WHERE user_email="."'".$_SESSION["Us3rN4mE"]."'".";";
	$QUERYGetCustomers = "SELECT id_customer,customer_name from customers;";
	$QUERYGetActiveUser = "SELECT CONCAT(user_name, ' ', user_last_name) as name FROM users WHERE user_email="."'".$_SESSION["Us3rN4mE"]."'".";";
	$QUERYGetFirstProcLoad = "SELECT CONCAT(p.name_product,' ', ppc.name_process) as name_process,ppc.id_process_product_customer as id_process
FROM customers as c,process_product_customer as ppc, product as p
WHERE (Select id_customer from customers order by id_customer limit 1) = c.id_customer 
and p.f_customer = c.id_customer and p.id_product = ppc.f_product;";
$QUERYGetUserID="SELECT id_user as id_user FROM users WHERE user_email="."'".$_SESSION["Us3rN4mE"]."'".";";
$QueryTodayProductions = "SELECT  CONCAT(u.user_name, ' ', u.user_last_name) as reporter,c.customer_name, ppc.name_process, pt.name_product, p.operational_staff_assigned as staff, p.production_count,ppc.goal,p.production_time
FROM process_product_customer AS ppc, customers AS c, productions AS p, product as pt,users as u
WHERE ppc.id_process_product_customer = p.f_process and pt.f_customer = c.id_customer and ppc.f_product = pt.id_product and u.id_user = p.f_user
AND p.production_date>=CURDATE() AND p.production_date <CURDATE()+1";
$QueryGetMessages = "SELECT m.id_message as messageid, m.f_user_sender as usersenderid, m.f_user_receiver,
(select CONCAT(u.user_name,' ',u.user_last_name) from users as u,messages as m2 where messageid =m2.id_message and u.id_user = usersenderid) as f_user_sender_name,m.message,DATE_FORMAT(date_sent, '%d de %M a las %h:%i %p') as date_sent 
FROM messages as m,users as u
WHERE u.id_user = m.f_user_receiver and m.f_user_receiver = ".$_SESSION["Us3r1D"].";";
/*$QueryGetWorkGroups = "SELECT distinct(dw.id_daily_workgroup) AS id_daily_workgroup, dw.workgroup_name
FROM operator_x_workgroup ow, daily_workgroup dw
WHERE ow.f_group = dw.id_daily_workgroup AND
      DAY(dw.date_created) = DAY(NOW()) AND
      MONTH(dw.date_created) = MONTH(NOW()) AND
      YEAR(dw.date_created) = YEAR(NOW()) AND 
      dw.f_user_owner = (SELECT sc.f_supervisor_user 
  from supervisor_customer as sc, users as u 
  where sc.f_customer =$id_customer and 
  sc.f_supervisor_user = u.id_user 
  order by sc.date_assigned DESC 
  limit 1);";*/

	//EJECUTAMOS TODOS LOS QUERY
	$resultUsername = mysqli_query($connection, $QUERYuser) or trigger_error("Query Failed! SQL: $QUERYuser- Error: ". mysqli_error($connection), E_USER_ERROR);
	$result1 = mysqli_query($connection, $QUERYGetCustomers) or trigger_error("Query Failed! SQL: $QUERYGetCustomers - Error: ". mysqli_error($connection), E_USER_ERROR);
    $result2 = mysqli_query($connection, $QUERYGetActiveUser) or trigger_error("Query Failed! SQL: $QUERYGetActiveUser - Error: ". mysqli_error($connection), E_USER_ERROR);
    $result3 = mysqli_query($connection, $QUERYGetFirstProcLoad) or trigger_error("Query Failed! SQL: $QUERYGetFirstProcLoad - Error: ". mysqli_error($connection), E_USER_ERROR);
    $result4 = mysqli_query($connection, $QUERYGetUserID) or trigger_error("Query Failed! SQL: $QUERYGetUserID - Error: ". mysqli_error($connection), E_USER_ERROR);
	$result_QueryTodayProductions = mysqli_query($connection, $QueryTodayProductions) or trigger_error("Query Failed! SQL: $QueryTodayProductions - Error: ". mysqli_error($connection), E_USER_ERROR);
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
	        }
          
        }
      }
	  if(type == "procesos"){
      	xmlhttp.open("GET","list_process.php?opt="+str, true);
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
                        <h4 class="page-title">REPORTE DE PRODUCCION</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                       
                        <ol class="breadcrumb">
                            <li class="active"><a href="report-productivity.php">Reporte de Produccion</a></li>
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
                            <div class="panel-heading"> Reporte de Produccion</div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body">
                                    <form action="insert_productivity.go" method="POST">
                                        <div class="form-body">
                                            <h3 class="box-title">Ingrese la informacion solicitada para el corte de su produccion.</h3>
                                            <hr>
                                            <div class="row">                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Cliente</label>
                                                        <select class="form-control" name="customerbox" id="customerbox" onchange="update(this.value,'procesos')">
                                                            <?php
                                                            while($resc = mysqli_fetch_assoc($result1)){                                                
                                                                echo '<option value='.$resc["id_customer"].'>'.$resc["customer_name"].'</option>';
                                                               
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Proceso</label>
                                                        <select class="form-control" id="procesos" name="procesos">
	                                                        <?php
                                                            while($first_load_proc = mysqli_fetch_assoc($result3)){                                                
                                                                echo '<option value='.$first_load_proc["id_process"].'>'.$first_load_proc["name_process"].'</option>';
                                                            }
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
                                                        <label class="control-label">Produccion</label>
                                                        <input type="text" class="form-control" required="" placeholder="En unidades" id="produccion" name="produccion"> </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Tiempo</label>
                                                        <select class="form-control" id="tiempo" name="tiempo">
                                                            <option value="6:30 AM - 7:00 AM">6:30 AM - 7:00 AM</option>
															<option value="7:00 AM - 7:30 AM">7:00 AM - 7:30 AM</option>
                                                            <option value="7:30 AM - 8:00 AM">7:30 AM - 8:00 AM</option>
                                                            <option value="8:00 AM - 8:30 AM">8:00 AM - 8:30 AM</option>
															<option value="8:30 AM - 9:00 AM">8:30 AM - 9:00 AM</option>
															<option value="9:00 AM - 9:30 AM">9:00 AM - 9:30 AM</option>
                                                            <option value="9:30 AM - 10:00 AM">9:30 AM - 10:00 AM</option>
                                                            <option value="10:00 AM - 10:30 AM">10:00 AM - 10:30 AM</option>
                                                            <option value="10:30 AM - 11:00 AM">10:30 AM - 11:00 AM</option>
                                                            <option value="11:00 AM - 11:30 AM">11:00 AM - 11:30 AM</option>
                                                            <option value="11:30 AM - 12:00 MD">11:30 AM - 12:00 MD</option>
                                                            <option value="12:00 MD - 12:30 MD">12:00 MD - 12:30 MD</option>
                                                            <option value="12:30 MD - 1:00 PM">12:30 MD - 1:00 PM</option>
                                                            <option value="1:00 PM - 1:30 PM">1:00 PM - 1:30 PM</option>
                                                            <option value="1:30 PM - 2:00 PM">1:30 PM - 2:00 PM</option>
                                                            <option value="2:00 PM - 2:30 PM">2:00 PM - 2:30 PM</option>
                                                            <option value="2:30 PM - 3:00 PM">2:30 PM - 3:00 PM</option>
                                                            <option value="3:00 PM - 3:30 PM">3:00 PM - 3:30 PM</option>
                                                            <option value="3:30 PM - 4:00 PM">3:30 PM - 4:00 PM</option>
                                                            <option value="4:00 PM - 4:30 PM">4:00 PM - 4:30 PM</option>
                                                            <option value="4:30 PM - 5:00 PM">4:30 PM - 5:00 PM</option>
                                                            <option value="5:00 PM - 5:30 PM">5:00 PM - 5:30 PM</option>
                                                            <option value="5:30 PM - 6:00 PM">5:30 PM - 6:00 PM</option>
															<option value="6:00 PM - 6:30 PM">6:00 PM - 6:30 PM</option>
                                                            <option value="6:30 PM - 7:00 PM">6:30 PM - 7:00 PM</option>
                                                            <option value="7:00 PM - 7:30 PM">7:00 PM - 7:30 PM</option>
                                                            <option value="7:30 PM - 8:00 PM">7:30 PM - 8:00 PM</option>
                                                            <option value="8:00 PM - 8:30 PM">8:00 PM - 8:30 PM</option>
                                                            <option value="8:30 PM - 9:00 PM">8:30 PM - 9:00 PM</option>
                                                        </select> <span class="help-block"> Hora de Corte </span> </div>
                                                </div>
                                                <!--/span-->
                                                
                                            </div>
                                            <!--/row-->
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Reporte Hecho por</label>
                                                        <input type="text" class="form-control" value="<?php echo $user["name"]; ?>" readonly> 
                                                        <input type="hidden" value="<?php echo $user_id["id_user"];?>" name="usuario" id="usuario">
                                                                                                                </div>
                                                </div>
                                                <!--/span-->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label">Numero de Operarios</label>
                                                        <select class="form-control" id="operarios" name="operarios">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value="7">7</option>
                                                            <option value="8">8</option>
                                                            <option value="9">9</option>
                                                            <option value="10">10</option>
                                                            <option value="11">11</option>
                                                            <option value="12">12</option>
                                                            <option value="13">13</option>
                                                            <option value="14">14</option>
                                                            <option value="15">15</option>
                                                            <option value="16">16</option>
                                                            <option value="17">17</option>
                                                            <option value="18">18</option>
                                                            <option value="19">19</option>
                                                            <option value="20">20</option>
                                                        </select> <span class="help-block">Cantidad del Grupo</span> </div>
                                                </div>
                                                <div class="col-md-12 ">
                                                    <div class="form-group">
                                                        <label>Comentarios</label>
                                                        <textarea class="form-control" rows="4" cols="50" id="comments" name="comments"></textarea>
                                                    </div>
                                                        
                                                </div>
                                                <!--/span-->
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                        <button class="btn-danger btn-lg">Reportar</button>
                                        <input type="button" class="btn btn-default btn-lg" name="cancel" value="Cancelar" onClick="window.location='report-productivity.php';" />
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
                            <h3 class="box-title m-b-0">Producciones en Vivo</h3>
                            <p class="text-muted m-b-30">Exporte o Copie la informacion en CSV, Excel, PDF & Print</p>
                            <div class="table-responsive">
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Proceso</th>
                                            <th>Producto</th>
                                            <th>Numero de Operarios</th>
                                            <th>Produccion</th>
                                            <th>Meta</th>
                                            <th>Hora</th>
                                            <th>Reporta</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>Proceso</th>
                                            <th>Numero de Operarios</th>
                                            <th>Valor Unitaria</th>
                                            <th>Produccion</th>
                                            <th>Meta</th>
                                            <th>Hora</th>
                                            <th>Reporta</th>
                                        </tr>
                                    </tfoot>
                                    <tbody> 
                                    <?php 
                                            while($row = mysqli_fetch_assoc($result_QueryTodayProductions)){
                                                echo '<tr>';
                                                echo '<th>'.$row["customer_name"].'</th>';
                                                echo '<th>'.$row["name_process"].'</th>'; 
                                                echo '<th>'.$row["name_product"].'</th>'; 
                                                echo '<th>'.$row["staff"].'</th>';
                                                echo '<th>'.$row["production_count"].'</th>';
                                                echo '<th>'.$row["goal"].'</th>';
                                                echo '<th>'.$row["production_time"].'</th>';
                                                echo '<th>'.$row["reporter"].'</th>';
                                                echo '</tr>';
                                                
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
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
    
</body>

</html>